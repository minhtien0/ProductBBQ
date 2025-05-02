<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\User;
use App\Http\Controllers\StaffController\Dashboard;

//Đa ngôn ngữ
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
//Đăng nhập
Route::get('/login', function () {
    return view('login');
});
//Group Admin
Route::prefix('admin')->middleware([ \App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/index', [HomeController::class, 'index']);
    

    Route::prefix('/user')->group(function () {
        Route::get('/list', [User::class, 'index'])->name('user.list');
        Route::get('/detail', [User::class, 'detail'])->name('user.detail');
        
    });

});
Route::prefix('staff')->middleware([\App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/index', [Dashboard::class, 'index'])->name('staff.dashboard');

});
