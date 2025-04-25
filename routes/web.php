<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\User;

//Đa ngôn ngữ
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
//Đăng nhập
Route::get('/login', function () {
    return view('login');
});
//Group Admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/index', [HomeController::class, 'index'])->middleware(\App\Http\Middleware\Locale::class);
    

    Route::prefix('/user')->group(function () {
        Route::get('/list', [User::class, 'index'])->name('user.list');
        Route::get('/detail', [User::class, 'detail'])->name('user.detail');
        
    });

});
