<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsTeacher;
use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClasseController extends Controller
{
    // list all classes
    public function index(){
        $teacher = ['user' => Auth::user(), 'teacher' => Auth::user()->teacher];
        $student = ['user' => Auth::user(), 'student' => Auth::user()->student];
        $years = Year::all();
        $classes = [];
        foreach (Classe::where('teacher_id', $teacher['teacher']->id)->get() as $class) {
            $count = count(ClassStudent::where('classe_id', $class->id)->get());
            array_push($classes, ['classe' => $class, 'year' => $class->year->value, 'count' => $count]);
        }
        
        return view('teacher.classes.index', [
            'years' => $years, 
            'classes' => $classes,
            'teacher' => $teacher,
            'student' => $student
        ]);
    } 

    // ceate a new class
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'min:3'],
            'teacher_id' => ['required', 'integer'],
            'year_id' => ['required', 'integer']
        ]);

        Classe::create(
            $request->all()
        );

        return redirect()->route('teacher.classes.index');
    }

    // Teacher show class
    public function show(int $id){
        $classe = Classe::find($id);
        $classStudents = ClassStudent::where('classe_id', $id)->get();
        $cs = [];
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $isTeacher = $teacher != null;

        foreach ($classStudents as $class) {
            $student = Student::find($class->student_id);
            $user = $student->user;
            array_push($cs, ['student' => $student, 'user' => $user]);
        }

        if ($isTeacher) {
            return view('teacher.classes.show', ['classe' => $classe, 'classStudent' => $cs]);
        } else {
            return view('student.classes.show', ['classe' => $classe, 'teacher' => $classe->teacher->user->name]);
        }
           
    }

    // join a class with link
    public function join(Request $request, string $token){ 

        $class = Classe::where('token', $token)->first();
        $student = Student::where('user_id',Auth::user()->id)->first();

        if ($student == null) {
            abort(403);
        }
        
        $exist = ClassStudent::where('student_id', $student->id)->where('classe_id', $class->id)->first() != null;

        // if student is already in class
        if ($exist) {
            return redirect()->route('student.home')->with('fail', 'Vous êtes déjà inscrit à ce cours...');
        }
        if ($class  == null) {
            // class not found
            return redirect()->route('student.home')->with('fail', 'Impossible de rejoindre le cours, vérifez le lien et réesayez...');
        } else {
            // class found 
            ClassStudent::create([
                'classe_id' => $class->id,
                'student_id' => Auth::user()->student->id
            ]);
        }

        return view("teacher.classes.show", ['id' => $class->id])->with('success', 'Vous avez integré le cours'.$class->name." avec succès");
        
    }

    // update name
    public function updateName(Request $request, int $id){
        $request->validate([
            'name' => ['required', 'min:3'],
        ]);

        $class = Classe::find($id);
        
        $class->update(['name' => $request->name]);

        return redirect()->route("teacher.classes.show", ['id' => $id])->with('success', 'Cours modifié avec succès');
    }

    // generate token
    public function generateLink(int $id){
        $token = Str::random(25);
        $class = Classe::find($id);

        while (count(Classe::where('token', $token)->get()) > 0) {
            $token = Str::random(25);
        }

        $class->update(['token' => $token]);

        return redirect()->route("teacher.classes.show", ['id'=>$id])->with('success', 'Nouveau lien généré avec succès');
    }

}
