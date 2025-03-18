<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [ProductController::class, 'home'])->name('home');

// Liên hệ
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Blog
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// Giới thiệu
Route::get('/about', function () {
    return view('about');
})->name('about');

// Sản phẩm
Route::get('/productItem', function () {
    return view('productItem');
});

Route::get('/product', [ProductController::class, 'product'])->name('product.index');
Route::get('/productItem/{id}', [ProductController::class, 'showProductDetails'])->name('productItem');

// Trang đăng nhập
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route cho form quên mật khẩu
Route::get('password/forgot', [AuthenticatedSessionController::class, 'showForgotPasswordForm'])->name('password.forgot');

// Route xử lý yêu cầu reset mật khẩu
Route::post('password/forgot', [AuthenticatedSessionController::class, 'sendResetLink'])->name('password.email');

// Route cho form nhập mật khẩu mới
Route::get('password/reset/{token}', [AuthenticatedSessionController::class, 'showResetPasswordForm'])->name('password.reset');

// Route xử lý reset mật khẩu
Route::post('password/reset', [AuthenticatedSessionController::class, 'resetPassword'])->name('password.update');


// Trang đăng ký
Route::get('/create-account', [RegisteredUserController::class, 'create']);
Route::post('/create-account', [RegisteredUserController::class, 'store'])->name('create-account');
Route::get('/verify-email', [RegisteredUserController::class, 'verifyEmail'])->name('verify.email');

// Nhóm các route yêu cầu đăng nhập

Route::middleware(['role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['role:admin|staff'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


    Route::get('customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customers_create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customers_store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customers_edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customers_update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('customers_destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

    // Route cho khuyến mãi
    Route::resource('promotions', PromotionController::class);

    // Route cho đơn hàng
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::match(['post', 'put'], '/{order}/update', [OrderController::class, 'update'])->name('update');
        Route::get('/{id}/invoice', [OrderController::class, 'printInvoice'])->name('printInvoice');
    });

    // Báo cáo doanh thu
    Route::get('/reports/revenue', [ReportController::class, 'revenueReport'])->name('reports.revenue');

    // Báo cáo sản phẩm bán chạy
    Route::get('/reports/products', [ReportController::class, 'productReport'])->name('reports.products');
});

// Trang khách hàng - chỉ khách hàng mới vào được
Route::middleware('auth:customer')->group(function () {
    Route::get('/product', [ProductController::class, 'product']);
});


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Thanh toán
Route::prefix('checkout')
    ->name('checkout.')
    ->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('process', [CheckoutController::class, 'processCheckout'])->name('process');
        Route::post('update-default-address', [CheckoutController::class, 'updateDefaultAddress'])->name('updateDefaultAddress');
        Route::post('add-address', [CheckoutController::class, 'addAddress'])->name('add-address');
    });

Route::get('/order/confirmation/{orderId}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::post('/set-default-address', [CheckoutController::class, 'setDefaultAddress'])->name('checkout.setDefaultAddress');
