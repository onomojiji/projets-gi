<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\Group;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    //
    public function home(){

        $teacher = ['user' => Auth::user(), 'teacher' => Auth::user()->teacher];
        $student = ['user' => Auth::user(), 'student' => Auth::user()->student];
        $years = Year::all();
        $classes = [];
        foreach (Classe::where('teacher_id', $teacher['teacher']->id)->limit(3)->latest()->get() as $class) {
            $count = count(ClassStudent::where('classe_id', $class->id)->get());
            array_push($classes, ['classe' => $class, 'year' => $class->year->value, 'count' => $count]);
        }

        return view('teacher.home', [
            'years' => $years, 
            'classes' => $classes,
            'teacher' => $teacher,
            'student' => $student
        ]);
    }

    // teacher search a project
    public function search(Request $request){

        $request->validate([
            'word' => 'required'
        ]);

        $groups = Group::where("theme", "LIKE", "%".$request->word."%")->get();

        $projects = [];

        foreach ($groups as $group) {

            $group->note == null ? $note = "Non noté" : $note = $group->note->value."/20";
            
            array_push($projects, ['project' => $group, 'note' => $note, 'classe' => $group->classe->id]);
        }

        return view('teacher.search', ['projects' => $projects, 'word' => $request->word]);

    }
}
