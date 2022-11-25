<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\Group;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    // create a new group
    public function store(Request $request, int $classe_id){

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
        $groupExist = Group::where("classe_id", $classe_id)->where("title", $title)->first();

        if ($groupExist != null) {
            return redirect()->route("student.classes.show", ['id' => $classe_id])->with("fail", "Un groupe avec le même nom existe déjà...");
        }

        $group = Group::create([
            'classe_id' => $classe_id,
            'title' => $title,
            'delegate' =>Auth::user()->student->id,
            'theme' => $request->theme,
            'description' => $request->description
        ]);

        StudentGroup::create([
            "group_id" => $group->id,
            "student_id" => Auth::user()->student->id,
        ]);

        return redirect()->route("student.classes.show", ['id' => $classe_id])->with("success", "Vous avez créé votre groupe avec succès...");
    }

    // show a group
    public function show(int $classe_id, int $id){

        $classe = Classe::find($classe_id);

        $group = Group::find($id);

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
                'isDelegate' => $isDelegate
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

        $group = Group::find($id);
        
        $group->update(['theme' => $request->theme]);

        return redirect()->route("student.groups.show", ['id' => $id, 'classe_id' => $classe_id])->with('success', 'Theme modifié avec succès...');
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

        return view("student.groups.show", ['id' => $group->id])->with('success', 'Vous avez integré le '.$group->title." avec succès");
        
    }
}
