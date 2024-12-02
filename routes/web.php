<?php

use App\Http\Controllers\User\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    return view('info-product');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/user-management', [UserManagementController::class, 'index'])->name('admin.userManagement');
    Route::delete('admin/user-management/delete/{user_id}', [UserManagementController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('admin/kategori', [CategoryController::class, 'index'])->name('admin.kategori');
    Route::put('admin/edit-kategori', [CategoryController::class, 'edit'])->name('admin.edit-kategori');
    Route::get('admin/product', [ProductController::class, 'index'])->name('admin.view-product');
    // Route::delete('admin/product/delete/{product_id}', [ProductController::class, 'delete'])->name('admin.delete-product');
    Route::put('admin/product/edit/{product_id}', [ProductController::class, 'edit'])->name('admin.edit-product');
    Route::post('admin/product/category', [CategoryController::class, 'store'])->name('admin.add-category');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('seller/product/create', [ProductController::class, 'addProduct'])->name('seller.add-product');
    Route::post('seller/product/save', [ProductController::class, 'store'])->name('seller.save-product');
    Route::get('seller/edit-product/{id}', [ProductController::class, 'editProduk'])->name('seller.edit-product');
    Route::put('seller/product/update/{id}', [ProductController::class, 'update'])->name('seller.update-product');

    Route::post('seller/product/delete/{id}', [ProductController::class, 'discontinue'])->name('seller.delete-product');

    Route::get('seller/order', [OrderController::class, 'showOrderFromUser'])->name('seller.view-order');
    Route::get('seller/transaction', [TransactionController::class, 'showTransactionFromUser'])->name('seller.view-transaction');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('user/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    Route::delete('user/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::get('user/transaction', [TransactionController::class, 'index'])->name('user.transaction.index');
    Route::post('user/transaction/process', [TransactionController::class, 'processPayment'])->name('user.transaction.process');
    Route::post('user/transaction/notification', [TransactionController::class, 'notificationHandler'])->name('user.transaction.notification');
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

// require __DIR__ . '/auth.php';