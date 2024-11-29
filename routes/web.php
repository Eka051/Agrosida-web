<?php

use App\Http\Controllers\CategoryController;
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
    Route::delete('admin/user-management/delete/{user_id}', [UserManagementController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('admin/kategori', [CategoryController::class, 'index'])->name('admin.kategori');
    Route::put('admin/edit-kategori', [CategoryController::class, 'edit'])->name('admin.edit-kategori');
    Route::get('admin/product', [ProductController::class, 'index'])->name('admin.view-product');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('seller/product', [ProductController::class, 'addProduct'])->name('seller.product');
    Route::post('seller/product/create', [ProductController::class, 'store'])->name('seller.add-product');
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
