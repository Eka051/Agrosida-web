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

    Route::get('register', [RegisterController::class, 'registerUser'])->name('register');
    Route::post('register/user', [RegisterController::class, 'store'])->name('register.storeUser');
    Route::post('register/seller', [RegisterController::class, 'storeSeller'])->name('register.storeSeller');
    Route::get('forgot-password', [PasswordResetController::class, 'index'])->name('forgot.password');
});
Route::post('forgot-password/send', [PasswordResetController::class, 'sendVerificationCode'])->name('password.sendCode')->middleware('json.response');
Route::get('forgot-password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verifyCode')->middleware('json.response');
Route::post('forgot-password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset')->middleware('json.response');

Route::middleware('auth')->group(function () {
    Route::post('logout', action: [AuthController::class, 'logout'])->name('logout');
});

// Route::post('/password/sendCode', [PasswordResetController::class, 'sendVer'])->name('password.sendCode')->middleware('json.response');

// Route::post('/password/verifyCode', 'PasswordController@verifyCode')->name('password.verifyCode')->middleware('json.response');

// Route::post('/password/reset', 'PasswordController@reset')->name('password.reset')->middleware('json.response');
