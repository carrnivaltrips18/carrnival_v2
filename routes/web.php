<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserloginController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\MasterSettingController;
use App\Http\Controllers\admin\HeaderContentController;
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

Route::group(['prefix' => 'admin'], function () {


    // guast middleware for admin
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');
    });



    // authenticate middleware for admin
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
        // Profile edit routes
        Route::get('profile_edit/{id}', [LoginController::class, 'edit'])->name('admin.profile_edit');
        Route::post('update/{id}', [LoginController::class, 'update'])->name('admin.update');
        Route::get('notification_list', [LoginController::class, 'list'])->name('admin.notification_list');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('notification', [DashboardController::class, 'notification'])->name('notifications.index');
        Route::get('users_list', [UserloginController::class, 'index'])->name('admin.users.list');
        Route::get('users_list', [UserloginController::class, 'index'])->name('admin.users.list');
        Route::get('users_list', [UserloginController::class, 'index'])->name('admin.users.list');
        Route::get('users/csv', [UserloginController::class, 'exportCsv'])->name('admin.users.csv');
        Route::post('users/upload_csv', [UserloginController::class, 'uploadCsv'])->name('admin.users.upload_csv');
        Route::get('status_active_deactive/', [UserloginController::class, 'status_active_deactive'])->name('admin.status_active_deactive');
        Route::get('master_setting',[MasterSettingController::class,'index'])->name('admin.master_setting');
        Route::post('master_setting',[MasterSettingController::class,'store'])->name('admin.master_setting');
        Route::get('header_content',[HeaderContentController::class,'index'])->name('admin.header_content');
        Route::post('header_content',[HeaderContentController::class,'create'])->name('admin.header_content');
        Route::get('header_content_list',[HeaderContentController::class,'list'])->name('admin.header_content_list');
        Route::patch('/header_content_list/{id}/toggleStatus', [HeaderContentController::class, 'toggleStatus'])->name('admin.header_content_list.toggleStatus');
        Route::get('header_content_edit/{id}',[HeaderContentController::class,'edit'])->name('admin.header_content_edit');
        Route::put('header_content/update/{id}',[HeaderContentController::class,'update'])->name('admin.header_content_update');
        Route::get('download',[UserloginController::class,'downloadSampleCsv'])->name('admin.downloadcsv');

    });
});


require __DIR__ . '/auth.php';
