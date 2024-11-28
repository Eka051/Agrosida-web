<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/user-management', [UserManagementController::class, 'index'])->name('admin.userManagement');
    Route::get('admin/product-management', [ProductController::class, 'index'])->name('admin.productManagement');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('seller/product', [ProductController::class, 'product'])->name('seller.product');
    Route::get('seller/product/create', [ProductController::class, 'addProduct'])->name('seller.product.create');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});



Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
    echo 'optimize clear';
});

require __DIR__ . '/auth.php';