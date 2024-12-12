<?php

use App\Http\Controllers\PesticideDosage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\KalkulasiDosisPestisida;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', [KalkulasiDosisPestisida::class, 'landing']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/user-management', [UserManagementController::class, 'index'])->name('admin.userManagement');
    Route::delete('admin/user-management/delete/{user_id}', [UserManagementController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('admin/kategori', [CategoryController::class, 'index'])->name('admin.kategori');
    Route::put('admin/edit-kategori', [CategoryController::class, 'edit'])->name('admin.edit-kategori');
    Route::get('admin/product', [ProductController::class, 'index'])->name('admin.view-product');
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.view-category');
    Route::get('admin/search-product', [ProductController::class, 'search'])->name('admin.search-product');
    Route::delete('admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.delete-product');
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.delete-category');
    Route::put('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.edit-product');
    Route::post('admin/product/category', [CategoryController::class, 'store'])->name('admin.add-category');

    Route::get('detect', [DetectionController::class, 'showForm'])->name('detect.form');
    Route::post('detect', [DetectionController::class, 'uploadImage'])->name('detect.upload');
    Route::get('pesticide', [KalkulasiDosisPestisida::class, 'showForm'])->name('pesticide.form');
    Route::post('pesticide', [KalkulasiDosisPestisida::class, 'addPesticide'])->name('addPesticide');
    Route::post('plant', [KalkulasiDosisPestisida::class, 'addPlant'])->name('addPlant');
    Route::post('dosage', [KalkulasiDosisPestisida::class, 'addDosage'])->name('addDosage');
    Route::delete('pesticide{id}', [KalkulasiDosisPestisida::class, 'deletePesticide'])->name('admin.deletePesticide');
    Route::delete('plant{id}', [KalkulasiDosisPestisida::class, 'deletePlant'])->name('admin.deletePlant');
    Route::delete('dosage{id}', [KalkulasiDosisPestisida::class, 'deleteDosage'])->name('admin.deleteDosage');
    Route::get('dosage/{id}', [KalkulasiDosisPestisida::class, 'getPlant_by_Pesticide'])->name('getPlant_by_Pesticide');
    Route::get('editPlant{id}', [KalkulasiDosisPestisida::class, 'editPlant'])->name('admin.editPlant');
    Route::put('updatePlant{id}', [KalkulasiDosisPestisida::class, 'updatePlant'])->name('admin.updatePlant');
    Route::get('editPesticide{id}', [KalkulasiDosisPestisida::class, 'editPesticide'])->name('admin.editPesticide');
    Route::put('updatePesticide{id}', [KalkulasiDosisPestisida::class, 'updatePesticide'])->name('admin.updatePesticide');
    Route::get('editDosage{id}', [KalkulasiDosisPestisida::class, 'editDosage'])->name('admin.editDosage');
    Route::put('updateDosage{id}', [KalkulasiDosisPestisida::class, 'updateDosage'])->name('admin.updateDosage');

});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('seller/product', [ProductController::class, 'product'])->name('seller.product');
    Route::get('seller/product/create', [ProductController::class, 'addProduct'])->name('seller.product.create');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('user/order/{id}', [OrderController::class, 'order'])->name('user.order');
    Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('user/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    Route::delete('user/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::post('user/cart/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');
    Route::post('user/order/payment', [OrderController::class, 'store'])->name('user.order.payment');
    Route::post('user/transaction/notification', [TransactionController::class, 'notificationHandler'])->name('user.transaction.notification');
    Route::get('user/address/add', [AddressController::class, 'index'])->name('user.add-address');
    Route::post('user/address/save', [AddressController::class, 'saveAddress'])->name('user.address.store');
    Route::get('/get-cities/{provinceId}', [AddressController::class, 'getCities']);
    Route::get('/get-districts/{cityId}', [AddressController::class, 'getDistricts']);
    Route::get('/get-villages/{districtId}', [AddressController::class, 'getVillages']);

    Route::post('payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
    Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::get('payment/error', [PaymentController::class, 'error'])->name('payment.error');
});

Route::get('test', [KalkulasiDosisPestisida::class, 'getDose_by_Plant']);

Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
    echo 'optimize clear';
});



// require __DIR__ . '/auth.php';
