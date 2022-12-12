<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\Comment;
use App\Models\File;
use App\Models\Group;
use App\Models\Like;
use App\Models\Note;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    // create a new group
    public function store(Request $request, int $id){

        $request->validate([
            'title' => ['integer', 'required'],
            'theme' => ['required', 'min:3'],
        ]);

        if ($request->title < 10) {
            $title = "GROUPE 0".$request->title;
        }else {
            $title = "GROUPE ".$request->title;
        }

        // check if group with same title exist in this class
        $groupExist = Group::where("classe_id", $id)->where("title", $title)->first();

        if ($groupExist != null) {
            return redirect()->route("student.classes.show", ['id' => $id])->with("fail", "Un groupe avec le même nom existe déjà...");
        }

        $group = Group::create([
            'classe_id' => $id,
            'title' => $title,
            'delegate' =>Auth::user()->student->id,
            'theme' => $request->theme,
            'description' => $request->description
        ]);

        StudentGroup::create([
            "group_id" => $group->id,
            "student_id" => Auth::user()->student->id,
        ]);

        return redirect()->route("student.classes.show", ['id' => $id])->with("success", "Vous avez créé votre groupe avec succès...");
    }

    // student show a group
    public function show(int $classe_id, int $id){

        $classe = Classe::find($classe_id);

        $group = Group::find($id);

        $gcs = StudentGroup::where("group_id", $id)->get();

        $notExist = Note::where("group_id", $id)->first();

        $groupStudents = [];

        $groupComments = [];

        $groupFiles = $group->files;

        count($group->comments) > 0 ? $comments = count($group->comments) : $comments = 0;

        count(Like::where("group_id", $id)->where("unliked", 0)->get()) > 0 ? $likes = count(Like::where("group_id", $id)->where("unliked", 0)->get()) : $likes = 0;

        Like::where("group_id", $id)->where("student_id", auth()->user()->student->id)->where("unliked", 0)->first() != null ? $liked = True : $liked = False;

        $files = [];

        foreach (Comment::where("group_id", $id)->latest()->get() as $comment) {
            $comment->user->teacher != null ? $isTeacher = True : $isTeacher = False;
            array_push($groupComments, ['comment' => $comment, 'user'=> $comment->user, 'isTeacher' => $isTeacher]);
        }

        foreach ($groupFiles as $file) {
            count($file->downloads) > 0 ? $downloads = count($file->downloads) : $downloads = 0;
            array_push($files, ['file' => $file, 'downloads' => $downloads]);
        }

        foreach ($gcs as $gc) {

            $iD = $gc->group->delegate == $gc->student->id;

            array_push($groupStudents, ['student' => $gc, 'status' => $iD]);
        }

        $isDelegate = $group->delegate == Auth::user()->student->id;
        $isInGroup = StudentGroup::where("group_id", $group->id)->where("student_id", Auth::user()->student->id)->first();
        
        if ($isInGroup != null) {
            $isInGroup = True;

        }else {
            $isInGroup = False;
        }
        
        return view(
            "student.groups.show", [
                'group' => $group,
                'classe' => $classe,
                'isInGroup' => $isInGroup,
                'isDelegate' => $isDelegate,
                'groupStudents' => $groupStudents,
                'groupFiles' => $files,
                'comments' => $comments,
                'likes' => $likes,
                'liked' => $liked,
                'groupComments' => $groupComments,
                'note' => $notExist,
            ]
        );
    }

    // teacher show a group
    public function teacherShow(int $classe_id, $id){
        $classe = Classe::find($classe_id);

        $group = Group::find($id);

        $gcs = StudentGroup::where("group_id", $id)->get();

        $groupStudents = [];

        $groupComments = [];

        $groupFiles = $group->files;

        $notExist = Note::where("group_id", $id)->where("teacher_id", Auth::user()->teacher->id)->first();

        count($group->comments) > 0 ? $comments = count($group->comments) : $comments = 0;

        count(Like::where("group_id", $id)->where("unliked", 0)->get()) > 0 ? $likes = count(Like::where("group_id", $id)->where("unliked", 0)->get()) : $likes = 0;

        $files = [];

        foreach (Comment::where("group_id", $id)->latest()->get() as $comment) {
            $comment->user->teacher != null ? $isTeacher = True : $isTeacher = False;
            array_push($groupComments, ['comment' => $comment, 'user'=> $comment->user, 'isTeacher' => $isTeacher]);
        }

        foreach ($groupFiles as $file) {
            count($file->downloads) > 0 ? $downloads = count($file->downloads) : $downloads = 0;
            array_push($files, ['file' => $file, 'downloads' => $downloads]);
        }

        foreach ($gcs as $gc) {

            $iD = $gc->group->delegate == $gc->student->id;

            array_push($groupStudents, ['student' => $gc, 'status' => $iD]);
        }

        return view(
            "teacher.groups.show", [
                'group' => $group,
                'classe' => $classe,
                'groupStudents' => $groupStudents,
                'groupFiles' => $files,
                'comments' => $comments,
                'likes' => $likes,
                'groupComments' => $groupComments,
                'note' => $notExist,
            ]
        );

    }

    // generate token
    public function generateLink(int $classe_id, int $id){
        $token = Str::random(25);
        $group = Group::find($id);

        while (count(Group::where('token', $token)->get()) > 0) {
            $token = Str::random(25);
        }

        $group->update(['token' => $token]);

        return redirect()->route("student.groups.show", ['id'=>$id, 'classe_id' => $classe_id])->with('success', 'Nouveau lien généré avec succès');
    }

    // update theme
    public function updateTheme(Request $request, int $id, int $classe_id){

        $request->validate([
            'theme' => ['required', 'min:3'],
        ]);

        $group = Group::find($classe_id);
        
        $group->update(['theme' => $request->theme]);

        return redirect()->route("student.groups.show", ['id' => $classe_id, 'classe_id' => $id])->with('success', 'Theme modifié avec succès...');
    }

    // join a group with link
    public function join(int $classe_id, string $token){ 

        $group = Group::where('token', $token)->first();
        $student = Student::where('user_id',Auth::user()->id)->first();

        if ($student == null) {
            abort(403);
        }
        
        $existInClass = ClassStudent::where('student_id', $student->id)->where('classe_id', $classe_id)->first() != null;
        $existInGroup = StudentGroup::where("student_id", $student->id)->where("group_id", $group->id)->first() != null;

        // if student is already in class and in group
        if ($existInClass && $existInGroup) {
            return redirect()->route('student.groups.show', ['id' => $group->id])->with('fail', 'Vous êtes déjà inscrit dans ce groupe...');
        }elseif(!$existInClass && !$existInGroup) { 
            // else if he is not in classe and not in group
            // put him into the class first
            ClassStudent::create([
                'classe_id' => $classe_id,
                'student_id' => Auth::user()->student->id
            ]);

            // put him into the group
            StudentGroup::create([
                "group_id" => $group->id,
                "student_id" => $student->id
            ]);
        }elseif ($existInClass && !$existInGroup) {
            // put him into the group
            StudentGroup::create([
                "group_id" => $group->id,
                "student_id" => $student->id
            ]);
        }

        return redirect()->route("student.groups.show", ['classe_id' => $classe_id,'id' => $group->id])->with('success', 'Vous avez integré le '.$group->title." avec succès");
        
    }

    // like a group
    public function like(int $classe_id, int $id){
        $group = Group::find($id);
        $student = Student::where('user_id', Auth::user()->id)->first();

        if ($student == null) {
            abort(403);
        }

        $exist = Like::where('group_id', $group->id)->where('student_id', $student->id)->first();

        if ($exist == null) {
            Like::create([
                'group_id' => $group->id,
                'student_id' => $student->id
            ]);
        }else {
            $exist->update(['unliked' => !$exist->unliked]);
        }

        return redirect()->back();
    }

    // comment a group
    public function comment(Request $request, int $classe_id, int $id){
        $request->validate([
            'comment' => ['required', 'min:3'],
        ]);

        $group = Group::find($id);

        Comment::create([
            'group_id' => $group->id,
            'user_id' => Auth::user()->id,
            'text' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès');
    }

    // note a group
    public function note(Request $request, int $classe_id, $id){
        $request->validate([
            'note' => ['required', 'numeric', 'min:0', 'max:20'],
        ]);

        $group = Group::find($id);
        
        Note::create([
            'group_id' => $group->id,
            'teacher_id' => Auth::user()->teacher->id,
            'value' => $request->note
        ]);

        return redirect()->back()->with('success', 'Note ajoutée avec succès');
    }

}
