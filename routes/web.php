<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*================= Students routes ==============================*/
Route::middleware(['auth', 'isStudent', 'isActive'])->prefix("student/")->group(function () {
    // home
    Route::controller(StudentController::class)->group(function(){
        Route::get("home", "home")->name("student.home");
    });
    
});

/*================= Teachers routes ==============================*/
Route::middleware(['auth', 'isTeacher', 'isActive'])->prefix("teacher/")->group(function () {
    // home
    Route::controller(TeacherController::class)->group(function(){
        Route::get("home", "home")->name("teacher.home");
    });

    // classes
    Route::controller(ClasseController::class)->group(function(){
        Route::get("classes", 'index')->name('classes.index');
        Route::get("classes/{id}", 'show')->name("classes.show");
        Route::get('classes/join/inimini/{token}', 'join')->name('classes.join');
        Route::get("classes/generate/link/{id}", 'generateLink')->name("classes.generate.link");
        Route::post("classes/store", 'store')->name("classes.store");
        Route::post("classes/{id}", 'updateName')->name("classes.update.name");
        
    });
    
});


require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
