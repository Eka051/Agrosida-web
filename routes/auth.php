<?php

use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('oauth/google', [OauthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('oauth/google/callback', [OauthController::class, 'handleGoogleCallback']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('forgot/password', [PasswordResetController::class, 'index'])->name('forgot.password');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('admin/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

