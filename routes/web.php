<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::get('oauth/google', [AuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('oauth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/', [AuthController::class, 'logout'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
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