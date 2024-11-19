<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Seller\SellerController;

Route::get('/', function () {
    return view('landing');
});


// Route::middleware(['auth'])->group(function () {
//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     });

//     Route::middleware(['role:seller'])->group(function () {
//         Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
//     });

//     Route::middleware(['role:user'])->group(function () {
//         Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
//     });
// });

Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
    echo 'optimize clear';
});