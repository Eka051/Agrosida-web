<?php

use Symfony\Component\Routing\Route;
use App\Http\Controllers\AuthController;

Route::get('oauth/google', [AuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('oauth/google/callback', [AuthController::class, 'handleGoogleCallback']);