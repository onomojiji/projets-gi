<?php

namespace App\Http\Controllers;

use App\Models\ClassStudent;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function home(){
        $years = Year::all();
        $cl = ClassStudent::where('student_id', Auth::user()->student->id)->get();
        $classes = [];

        foreach ($cl as $class) {
            array_push($classes, ["classe" => $class->classe, "year" => $class->classe->year->value]);
        }

        return view('student.home', ["classes" => $classes, "years" => $years]);
    }

    // 
}
