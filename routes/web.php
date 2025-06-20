<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController\HomeAdminController;
use App\Http\Controllers\AdminController\UserController;
use App\Http\Controllers\AdminController\BlogController;
use App\Http\Controllers\AdminController\Rate;
use App\Http\Controllers\AdminController\Staff\StaffController;
use App\Http\Controllers\AdminController\Blog;
use App\Http\Controllers\AdminController\VoucherController;
use App\Http\Controllers\AdminController\HelpController;
use App\Http\Controllers\AdminController\BookTable;
use App\Http\Controllers\AdminController\CompanyController;
use App\Http\Controllers\AdminController\OrderController;
use App\Http\Controllers\StaffController\Dashboard;
//Product
use App\Http\Controllers\AdminController\Product\CategoryController;
use App\Http\Controllers\AdminController\Product\ComboController;
use App\Http\Controllers\AdminController\Product\ProductController;

//Đăng nhập
Route::match(['get', 'post'], '/login', [HomeController::class, 'login'])->name('login');
//Đăng xuất
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// Xử lý đăng ký
Route::post('/register', [HomeController::class, 'register'])->name('register');

// Xử lý xác nhận email
Route::get('/verify-email/{token}', [HomeController::class, 'verifyEmail'])->name('verify.email');
//Order
Route::get('order', [HomeController::class, 'order'])->name('views.qrorder');
//Home
Route::get('/', [HomeController::class, 'index'])->name('views.index');
Route::get('/search-food', [HomeController::class, 'searchFood'])->name('food.search');
//About
Route::get('about', [HomeController::class, 'about'])->name('views.about');
//Menu
Route::get('menu', [HomeController::class, 'menu'])->name('views.menu');
//Blog
Route::get('blog', [HomeController::class, 'blog'])->name('views.blog');

//Contact
Route::get('contact', [HomeController::class, 'contact'])->name('views.contact');
Route::post('/contact/add', [HomeController::class, 'addContact'])->name('help.add');
//BookingTable
Route::post('/booking', [HomeController::class, 'storeBookingTable'])->name('booking.store');

//MenuDetail
Route::get('menudetail/{id}/{slug}', [HomeController::class, 'menudetail'])->name('views.menudetail');
//BlogDetail
Route::get('blogdetail/{id}/{slug}', [HomeController::class, 'blogdetail'])->name('views.blogdetail');
Route::get('/ajax-search-blog', [HomeController::class, 'ajaxSearchBlog'])->name('ajax.search.blog');

//UserDetail
Route::get('userdetail', [HomeController::class, 'userdetail'])->middleware([ \App\Http\Middleware\CheckLoggedIn::class])->name('views.userdetail');
Route::post('/user/update-profile', [HomeController::class, 'updateProfile'])->name('user.update-profile');
Route::post('/user/add-address', [HomeController::class, 'addAddress'])->name('user.add-address');
Route::delete('/user/deleteAddress/{id}', [HomeController::class, 'deleteAddress'])->name('user.destroyAddress');
Route::post('/user/edit-address', [HomeController::class, 'editAddress'])->name('user.edit-address');
Route::post('/user/change-password', [HomeController::class, 'changePassword'])->name('user.change-password');
Route::get('/order-detail/{id}', [HomeController::class, 'ajaxDetailOrder'])->name('order.detail.ajax');



//Cart
Route::get('/cart', [HomeController::class, 'cart']) ->middleware([\App\Http\Middleware\CheckLoggedIn::class])->name('views.cart');
Route::post('/cart', [HomeController::class, 'storeCart'])->name('cart.add');
Route::post('/favorite', [HomeController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::patch('/cart/{id}', [HomeController::class, 'updateQuantityCart'])->name('cart.updateQuantity');
Route::delete('/cart/{id}', [HomeController::class, 'destroyCart'])->name('cart.destroy');
Route::post('/order/add', [HomeController::class, 'storeOrder'])->name('order.store');
// vnpay return
Route::get('/vnpay/return', [HomeController::class,'vnpayReturn'])->name('vnpay.return');
// Hủy đơn hàng của chính user
Route::patch('/orders/{order}/cancel', [HomeController::class, 'cancelOrder'])->name('orders.cancel'); 
//Đánh giá đơn hàng
Route::post('/reviews', [HomeController::class, 'rateOrder'])->name('reviews.store');




//huydong test layout quản lí bàn
Route::get('/deskmanage', [HomeController::class, 'deskmanage'])->name('views.deskmanage');


//Group Admin
Route::prefix('admin')->middleware([ \App\Http\Middleware\CheckAdminRole::class])->group(function () {
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
    //thông tin công ty
    Route::get('/info', [CompanyController::class, 'index'])->name('admin.info');
    Route::post('/info/update/{id}', [CompanyController::class, 'update'])->name('admin.info.update');


    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.list');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('admin.user.detail');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::delete('/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/export', [UserController::class, 'export'])->name('admin.user.export');

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
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
        //Menu
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.product.category.index');
        //Combo
        Route::get('/combo', [ComboController::class, 'index'])->name('admin.product.combo.index');
        Route::get('/food-combo/add', [ComboController::class, 'showAddForm'])->name('admin.product.food_combo.addForm');
        Route::post('/food-combo/add', [ComboController::class, 'add'])->name('admin.product.food_combo.add');
        Route::get('/food/search', [ComboController::class, 'ajaxSearch'])->name('admin.food.search');
        Route::get('/food_combo/{id}/edit', [ComboController::class, 'edit'])->name('admin.food_combo.edit');
        Route::put('/food_combo/{id}', [ComboController::class, 'update'])->name('admin.food_combo.update');
        Route::delete('/delete/combo', [ComboController::class, 'delete'])->name('admin.product.combo.delete');
    });

    Route::prefix('/blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::delete('/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::post('/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');

    });

    Route::prefix('/order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order');
        //Mang Về
        Route::get('/bringback', [OrderController::class, 'bringBack'])->name('admin.order.bringback');
        Route::get('detail/{order}', [OrderController::class, 'showOrder'])->name('admin.order.show');
        Route::post('{order}/status', [OrderController::class, 'updateStatusBringBack'])->name('admin.order.updateStatusBringBack');
        //Tại Quán
        Route::get('/onsite', [OrderController::class, 'onSite'])->name('admin.order.onsite');
        
    });

});



//Group Nhân Viên Staff
Route::prefix('staff')->middleware([\App\Http\Middleware\Locale::class])->group(function () {
    Route::get('/index', [Dashboard::class, 'index'])->name('staff.dashboard');

});




