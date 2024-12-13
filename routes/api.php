<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\PaymentController;


Route::post('/webhook/midtrans', [PaymentController::class, 'handleMidtransWebhook']);
Route::get('/get-cities', [AddressController::class, 'getCities'])->name('get-cities');