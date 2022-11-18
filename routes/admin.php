<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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

Route::middleware(['auth', 'isAdmin', 'isActive'])->prefix("admin/")->group(function () {
    // Dashboard
    Route::controller(AdminDashboardController::class)->group(function(){
        Route::get("dashboard", "dashboard")->name("admin.dashboard");
    });
    
});

