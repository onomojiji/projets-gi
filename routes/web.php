<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupController;
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

    // classes
    Route::controller(ClasseController::class)->group(function(){
        Route::get("classes/{id}", 'show')->name("student.classes.show");
        Route::get('classes/join/inimini/{token}', 'join')->name('student.classes.join');
    });

    // groups
    Route::controller(GroupController::class)->group(function(){
        Route::get("classes/{classe_id}/groups/{id}", 'show')->name("student.groups.show");
        Route::get("classes/{classe_id}/groups/generate/link/{id}", 'generateLink')->name("student.groups.generate.link");
        Route::post("groups/{id}/store", 'store')->name("student.groups.store");
        Route::post("classes/{classe_id}/groups/{id}", 'updateTheme')->name("student.groups.update.theme");
        Route::get('classes/{classe_id}/groups/join/inimini/{token}', 'join')->name('student.groups.join');
        Route::get("classes/{classe_id}/groups/{id}/like", 'like')->name("student.groups.like");
        Route::post("classes/{classe_id}/groups/{id}/comment", 'comment')->name("student.groups.comment");
    });

    // files
    Route::controller(FileController::class)->group(function () {
        Route::post("groups/{group_id}/file/update", "upload")->name("student.upload.file");
        Route::get("group/{group_id}/file/{id}/download", "download")->name("student.download.file");
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
        Route::get("classes", 'index')->name('teacher.classes.index');
        Route::get("classes/{id}", 'show')->name("teacher.classes.show");
        Route::get("classes/generate/link/{id}", 'generateLink')->name("teacher.classes.generate.link");
        Route::post("classes/store", 'store')->name("teacher.classes.store");
        Route::post("classes/{id}", 'updateName')->name("teacher.classes.update.name");
    });
    
});


require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
