<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Admin\UserManagementController;

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/', [CalculatorController::class, 'landing']);

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
    Route::delete('admin/category/delete/{id}', [CategoryController::class,'delete'])->name('admin.delete-category');
    Route::put('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.edit-product');
    Route::post('admin/product/category', [CategoryController::class, 'store'])->name('admin.add-category');

    Route::get('admin/profile', [AdminController::class, 'profileAdmin'])->name('profile-admin');
    Route::get('admin/profile/edit/{user_id}', [AdminController::class, 'editProfileAdmin'])->name('admin.profile.edit');
    Route::put('admin/profile/update/{user_id}', [AdminController::class, 'updateProfileAdmin'])->name('admin.profile.update');

    // detection
    Route::get('detect', [DetectionController::class, 'showForm'])->name('detect.form');
    Route::post('detect', [DetectionController::class, 'uploadImage'])->name('detect.upload');
    // Calculator
    Route::get('pesticide', [CalculatorController::class, 'showForm'])->name('pesticide.form');
    Route::post('pesticide', [CalculatorController::class, 'addPesticide'])->name('addPesticide');
    Route::post('plant', [CalculatorController::class, 'addPlant'])->name('addPlant');
    Route::post('dosage', [CalculatorController::class, 'addDosage'])->name('addDosage');
    Route::delete('pesticide{id}', [CalculatorController::class, 'deletePesticide'])->name('admin.deletePesticide');
    Route::delete('plant{id}', [CalculatorController::class, 'deletePlant'])->name('admin.deletePlant');
    Route::delete('dosage{id}', [CalculatorController::class, 'deleteDosage'])->name('admin.deleteDosage');
    Route::get('dosage/{id}', [CalculatorController::class, 'getPlant_by_Pesticide'])->name('getPlant_by_Pesticide');
    Route::get('editPlant{id}', [CalculatorController::class, 'editPlant'])->name('admin.editPlant');
    Route::put('updatePlant{id}', [CalculatorController::class, 'updatePlant'])->name('admin.updatePlant');
    Route::get('editPesticide{id}', [CalculatorController::class, 'editPesticide'])->name('admin.editPesticide');
    Route::put('updatePesticide{id}', [CalculatorController::class, 'updatePesticide'])->name('admin.updatePesticide');
    Route::get('editDosage{id}', [CalculatorController::class, 'editDosage'])->name('admin.editDosage');
    Route::put('updateDosage{id}', [CalculatorController::class, 'updateDosage'])->name('admin.updateDosage');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');

    // Product
    Route::get('seller/product/view', [ProductController::class, 'viewProduct'])->name('seller.view-product');
    Route::get('seller/product/create', [ProductController::class, 'addProduct'])->name('seller.add-product');
    Route::post('seller/product/save', [ProductController::class, 'store'])->name('seller.save-product');
    Route::get('seller/edit-product/{id}', [ProductController::class, 'editProduk'])->name('seller.edit-product');
    Route::put('seller/product/update/{id}', [ProductController::class, 'update'])->name('seller.update-product');
    Route::delete('seller/product/delete/{id}', [ProductController::class, 'discontinue'])->name('seller.delete-product');

    // Order
    Route::get('seller/order', [OrderController::class, 'showOrderFromUser'])->name('seller.view-order');
    Route::get('seller/order-detail/{id}', [OrderController::class, 'showOrderDetail'])->name('seller.view-order-detail');
    Route::get('seller/transaction', [TransactionController::class, 'showTransactionFromUser'])->name('seller.view-transaction');
    
    
    // Address
    Route::get('seller/address/edit/{id}', [AddressController::class, 'editAddressSeller'])->name('seller.address.edit');
    Route::post('seller/address/save', [AddressController::class, 'storeAdressSeller'])->name('seller.address.save');
    
    // Profile
    Route::get('seller/profile/address', [AddressController::class, 'indexAddressSeller'])->name('profile-seller');
    Route::get('seller/profile/edit/{user_id}', [SellerController::class, 'editProfileSeller'])->name('seller.profile.edit');
    Route::put('seller/profile/update/{user_id}', [SellerController::class, 'updateProfileSeller'])->name('seller.profile.update');

    // Shipment and order
    Route::put('seller/order/confirm/{order_id}', [ShipmentController::class, 'confirmShipment'])->name('seller.shipment.confirm');
    Route::put('seller/order/cancel/{order_id}', [OrderController::class, 'cancelOrder'])->name('seller.order.cancel');
    // calculator
    Route::get('seller/pesticide-calculator', [CalculatorController::class, 'showFormSeller'])->name('seller.kalkulasipestisida');

    // detection
    Route::get('seller/detect', [DetectionController::class, 'DetectionSeller'])->name('seller.detect.form');
    Route::post('seller/detect', [DetectionController::class, 'uploadImage'])->name('seller.detect.upload');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('user/order/{id}', [OrderController::class, 'order'])->name('user.order');

    // cart
    Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('user/cart/add/{product_id}', [CartController::class, 'add'])->name('user.cart.add');
    Route::delete('user/cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('user/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::put('cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('cart/clear/{user_id}', [CartController::class, 'clearCartAfterPayment'])->name('cart.clear');
    
    // order
    Route::post('user/order/payment', [OrderController::class, 'store'])->name('user.order.payment');
    Route::post('user/cart/payment', [PaymentController::class, 'cartPayment'])->name('cart.payment');
    Route::get('user/history', action: [OrderController::class, 'history'])->name('user.history');
    Route::post('payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('payment/pending/{order_id}', [PaymentController::class, 'payPendingOrder'])->name('payment.pending');
    Route::get('user/order-detail/{id}', [OrderController::class, 'orderDetail'])->name('user.order-detail');
    Route::put('user/order/confirm/{order_id}', [OrderController::class, 'confirmOrder'])->name('user.order.confirm');
    Route::put('seller/order/cancel/{order_id}', [OrderController::class, 'cancelOrder'])->name('user.order.cancel');

    // address
    Route::get('user/address/add', [AddressController::class, 'index'])->name('user.add-address');
    Route::post('user/address/save', [AddressController::class, 'saveAddress'])->name('user.address.store');
    Route::get('user/address/edit/{id}', [AddressController::class, 'editAddress'])->name('user.address.edit');
    Route::put('user/address/update', [AddressController::class, 'updateAddress'])->name('user.address.update');
    Route::delete('user/address/delete/{id}', [AddressController::class, 'deleteAddress'])->name('user.address.delete');
    
    // profile
    Route::get('user/profile', [UserController::class, 'profileUser'])->name('profile-user');
    Route::get('user/profile/edit/{user_id}', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('user/profile/update/{user_id}', [UserController::class, 'updateProfileUser'])->name('user.profile.update');

    // calculator
    Route::get('pesticideUser', [CalculatorController::class, 'showFormUser'])->name('user.kalkulasipestisida');

    // detection
    Route::get('user/detect', [DetectionController::class, 'DetectionUser'])->name('user.detect.form');
    Route::post('user/detect', [DetectionController::class, 'uploadImage'])->name('user.detect.upload');

});

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/send-code', [PasswordResetController::class, 'sendVerificationCode'])->name('password.sendCode');
Route::post('/verify-code', [PasswordResetController::class, 'verifyCode'])->name('password.verifyCode');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.reset');
Route::get('dosage/{id}', [CalculatorController::class, 'getPlant_by_Pesticide'])->name('getPlant_by_Pesticide');

// product
Route::get('product/detail/{product_id}', [ProductController::class, 'detailProduct'])->name('product.detail');

Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
    echo 'optimize clear';
});