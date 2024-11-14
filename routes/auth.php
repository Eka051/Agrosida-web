<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('auth/google', [OauthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('auth/google/callback', [OauthController::class, 'handleGoogleCallback'])->name('oauth.google.callback');

Route::middleware('web')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot/password', [PasswordResetController::class, 'index'])->name('forgot.password');