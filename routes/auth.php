<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;



Route::middleware('guest')->group(function () {
    Route::get('oauth/google', [OauthController::class, 'redirectToGoogle'])->name('oauth.google');
    Route::get('oauth/google/callback', [OauthController::class, 'handleGoogleCallback'])->name('oauth.google.callback');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::get('register', [RegisterController::class, 'registerUser'])->name('register-user');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('register', [RegisterController::class, 'registerSeller'])->name('register-seller');
    Route::post('register', [RegisterController::class, 'storeSeller'])->name('register.storeSeller');
    Route::get('forgot-password', [PasswordResetController::class, 'index'])->name('forgot.password');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


