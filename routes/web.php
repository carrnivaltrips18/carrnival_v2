<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\NotificationController;
// use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin'],function(){


    // guast middleware for admin
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('login',[LoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');

    });



    // authenticate middleware for admin
    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
         // Profile edit routes
        Route::get('profile_edit/{id}', [LoginController::class, 'edit'])->name('admin.profile_edit');
        Route::post('update/{id}', [LoginController::class, 'update'])->name('admin.update');
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('notification',[DashboardController::class,'notification'])->name('notifications.index');
    });

    });


require __DIR__.'/auth.php';
