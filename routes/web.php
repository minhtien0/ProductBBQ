<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\User;
use App\Http\Controllers\AdminController\Rate;
use App\Http\Controllers\AdminController\Staff\StaffController;
use App\Http\Controllers\AdminController\Blog;
use App\Http\Controllers\AdminController\Voucher;
use App\Http\Controllers\AdminController\Help;
use App\Http\Controllers\AdminController\BookTable;
use App\Http\Controllers\AdminController\CompanyController;
use App\Http\Controllers\StaffController\Dashboard;
use App\Http\Controllers\AdminController\Product\Category;
use App\Http\Controllers\AdminController\Product\Combo;

//Đa ngôn ngữ
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
//Đăng nhập
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [HomeController::class, 'login']);

Route::get('/', function () {
    return view('index');
});

Route::get('order', [HomeController::class, 'order'])->name('views.qrorder');
//Group Admin
Route::prefix('admin')->middleware([ \App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/index', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/rate', [Rate::class, 'index'])->name('admin.rate');
    Route::get('/voucher', [Voucher::class, 'index'])->name('admin.voucher');
    Route::get('/help', [Help::class, 'index'])->name('admin.help');
    Route::get('/booktable', [BookTable::class, 'index'])->name('admin.booktable');
    Route::get('/info', [CompanyController::class, 'index'])->name('admin.info');

    Route::prefix('/user')->group(function () {
        Route::get('/list', [User::class, 'index'])->name('user.list');
        Route::get('/detail', [User::class, 'detail'])->name('user.detail');
        
    });

    Route::prefix('/staff')->group(function () {
        //Staff
        Route::get('/', [StaffController::class, 'index'])->name('admin.staff');
        Route::get('/detail/{id}', [StaffController::class, 'detail'])->name('admin.staff.detail');
        Route::post('/update/{id}', [StaffController::class, 'update'])->name('admin.staff.update');
        Route::get('/create', [StaffController::class, 'create'])->name('admin.staff.create');
        Route::post('/add', [StaffController::class, 'add'])->name('admin.staff.add');
        Route::get('export-excel', [StaffController::class, 'exportExcel'])->name('admin.staff.exportExcel');

        //Job
        Route::get('/job', [Staff::class, 'viewJob'])->name('admin.staff.job');
        //Đăng Kí Ca Làm
        Route::get('/registerjob', [Staff::class, 'viewRegisterJob'])->name('admin.staff.registerjob');
        //Chấm Công
        Route::get('/timekeeping', [Staff::class, 'viewTimeKeeping'])->name('admin.staff.timekeeping');
        //Tiền Tip
        Route::get('/tip', [Staff::class, 'viewTip'])->name('admin.staff.tip');
        //Tăng CA
        Route::get('/ot', [Staff::class, 'viewOT'])->name('admin.staff.ot');
        //Nghỉ Phép
        Route::get('/off', [Staff::class, 'viewOff'])->name('admin.staff.off');
        //Lương
        Route::get('/salary', [Staff::class, 'viewSalary'])->name('admin.staff.salary');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [User::class, 'index'])->name('user.list');
        Route::get('/category', [Category::class, 'index'])->name('admin.product.category.index');
        Route::get('/combo', [Combo::class, 'index'])->name('admin.product.combo.index');
        
    });

    Route::prefix('/blog')->group(function () {
        Route::get('/', [Blog::class, 'index'])->name('admin.blog');
        Route::get('/detail', [User::class, 'detail'])->name('user.detail');
        
    });

});



//Group Nhân Viên Staff
Route::prefix('staff')->middleware([\App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/index', [Dashboard::class, 'index'])->name('staff.dashboard');

});
