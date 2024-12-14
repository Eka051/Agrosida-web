<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PaymentController;


Route::post('/webhook/midtrans', [PaymentController::class, 'handleMidtransWebhook']);
Route::get('/cities', [AddressController::class, 'fetchCities'])->name('get-cities');
Route::post('order/cost', [OrderController::class, 'getShippingCost'])->name('user.order.cost');
Route::post('order/get-courier', [OrderController::class, 'getCourier'])->name('user.order.courier');