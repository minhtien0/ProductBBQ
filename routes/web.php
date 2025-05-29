<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\HomeAdminController;
use App\Http\Controllers\AdminController\User;
use App\Http\Controllers\AdminController\Rate;
use App\Http\Controllers\AdminController\Staff\StaffController;
use App\Http\Controllers\AdminController\Blog;
use App\Http\Controllers\AdminController\VoucherController;
use App\Http\Controllers\AdminController\HelpController;
use App\Http\Controllers\AdminController\BookTable;
use App\Http\Controllers\AdminController\CompanyController;
use App\Http\Controllers\StaffController\Dashboard;
use App\Http\Controllers\AdminController\Product\Category;
use App\Http\Controllers\AdminController\Product\Combo;

//Đa ngôn ngữ
Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');
//Đăng nhập
Route::match(['get', 'post'], '/login', [HomeController::class, 'login'])->name('login');
//Đăng xuất
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

//Layout User
Route::get('/', function () {
    return view('index');
});
//Order
Route::get('order', [HomeController::class, 'order'])->name('views.qrorder');
//Home
Route::get('index', [HomeController::class, 'index'])->name('views.index');
//About
Route::get('about', [HomeController::class, 'about'])->name('views.about');
//Menu
Route::get('menu', [HomeController::class, 'menu'])->name('views.menu');
//Blog
Route::get('blog', [HomeController::class, 'blog'])->name('views.blog');
//Contact
Route::get('contact', [HomeController::class, 'contact'])->name('views.contact');

//huydong test layout quản lí bàn
Route::get('/deskmanage', [HomeController::class, 'deskmanage'])->name('views.deskmanage');


//Group Admin
Route::prefix('admin')->middleware([\App\Http\Middleware\Locale::class, \App\Http\Middleware\CheckAdminRole::class])->group(function () {
    Route::get('/', [HomeAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [HomeAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/rate', [Rate::class, 'index'])->name('admin.rate');
    Route::prefix('voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('admin.voucher');
        Route::get('/create', [VoucherController::class, 'create'])->name('admin.voucher.create');
        Route::post('/add', [VoucherController::class, 'add'])->name('admin.voucher.add');
        Route::delete('/delete', [VoucherController::class, 'delete'])->name('admin.voucher.delete');
        Route::get('/edit/{id}', [VoucherController::class, 'edit'])->name('admin.voucher.edit');
        Route::post('/update/{id}', [VoucherController::class, 'update'])->name('admin.voucher.update');
    });
    Route::get('/help', [HelpController::class, 'index'])->name('admin.help');
    Route::get('/help/reply/{id}', [HelpController::class, 'showReplyForm'])->name('help.replyForm');
    Route::post('/help/reply/{id}', [HelpController::class, 'sendReply'])->name('help.sendReply');

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
        Route::delete('/delete', [StaffController::class, 'delete'])->name('admin.staff.delete');
        Route::get('/export-excel', [StaffController::class, 'exportExcel'])->name('admin.staff.exportExcel');
        Route::get('/exportTemplate', [StaffController::class, 'exportTemplateExcel'])->name('admin.staff.exportTemplateExcel');
        Route::post('/import-excel', [StaffController::class, 'importExcel'])->name('admin.staff.importExcel');


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
