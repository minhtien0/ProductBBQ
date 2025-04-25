<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;


Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', [HomeController::class, 'index'])->middleware(\App\Http\Middleware\Locale::class);

Route::get('/login', function () {
    return view('login');
});