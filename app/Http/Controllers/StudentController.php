<?php

namespace App\Http\Controllers;

use App\Models\ClassStudent;
use App\Models\Group;
use App\Models\StudentGroup;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function home(){
        $years = Year::all();
        $cl = ClassStudent::where('student_id', Auth::user()->student->id)->orderBy("created_at", "desc")->get();
        $classes = [];

        $projects = [];

        $groups = Group::orderBy("theme", 'asc')->get();

        $myGroups = auth()->user()->student->student_groups;

        $allMyGroups = [];

        foreach ($myGroups as $mg) {
            array_push($allMyGroups, ['group' => $mg->group, 'classe' => $mg->group->classe, 'year' => $mg->group->classe->year->value]);
        }

        foreach ($groups as $group) {

            $group->note == null ? $note = "Non noté" : $note = $group->note->value."/20";
            
            array_push($projects, ['project' => $group, 'note' => $note, 'classe' => $group->classe->id]);
        }

        foreach ($cl as $class) {
            array_push($classes, ["classe" => $class->classe, "year" => $class->classe->year->value]);
        }

        return view(
            'student.home', 
            [
                "classes" => $classes, 
                "years" => $years,
                'projects' => $projects,
                'myGroups' => $allMyGroups,
            ]
        );
    }

    // 
}
