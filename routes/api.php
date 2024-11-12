<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PaymentController;

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/midtrans/webhook', [PaymentController::class, 'handleWebHook'])->name('midtrans.webhook');