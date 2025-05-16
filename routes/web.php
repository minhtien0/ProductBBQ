<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\User;
use App\Http\Controllers\AdminController\Rate;
use App\Http\Controllers\AdminController\Staff;
use App\Http\Controllers\StaffController\Dashboard;

//Đa ngôn ngữ
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
//Đăng nhập
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [HomeController::class, 'login']);
//Group Admin
Route::prefix('admin')->middleware([ \App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/index', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/rate', [Rate::class, 'index'])->name('admin.rate');

    Route::prefix('/user')->group(function () {
        Route::get('/list', [User::class, 'index'])->name('user.list');
        Route::get('/detail', [User::class, 'detail'])->name('user.detail');
        
    });

    Route::prefix('/staff')->group(function () {
        Route::get('/job', [Staff::class, 'viewJob'])->name('admin.staff.job');
        Route::get('/registerjob', [Staff::class, 'viewRegisterJob'])->name('admin.staff.registerjob');
        Route::get('/timekeeping', [Staff::class, 'viewTimeKeeping'])->name('admin.staff.timekeeping');
        Route::get('/tip', [Staff::class, 'viewTip'])->name('admin.staff.tip');
        Route::get('/ot', [Staff::class, 'viewOT'])->name('admin.staff.ot');
        Route::get('/off', [Staff::class, 'viewOff'])->name('admin.staff.off');
        Route::get('/salary', [Staff::class, 'viewSalary'])->name('admin.staff.salary');
    });

});

//Group Nhân Viên Staff
Route::prefix('staff')->middleware([\App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/index', [Dashboard::class, 'index'])->name('staff.dashboard');

});
