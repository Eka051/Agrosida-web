<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    return view('landing');
});

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

    Route::get('admin/profile', [AdminController::class, 'profile'])->name('profile-admin');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');

    // Product
    Route::get('seller/product/view', [ProductController::class, 'viewProduct'])->name('seller.view-product');
    Route::get('seller/product/create', [ProductController::class, 'addProduct'])->name('seller.add-product');
    Route::post('seller/product/save', [ProductController::class, 'store'])->name('seller.save-product');
    Route::get('seller/edit-product/{id}', [ProductController::class, 'editProduk'])->name('seller.edit-product');
    Route::put('seller/product/update/{id}', [ProductController::class, 'update'])->name('seller.update-product');
    Route::post('seller/product/delete/{id}', [ProductController::class, 'discontinue'])->name('seller.delete-product');

    // Order
    Route::get('seller/order', [OrderController::class, 'showOrderFromUser'])->name('seller.view-order');
    Route::get('seller/order-detail/{id}', [OrderController::class, 'showOrderDetail'])->name('seller.view-order-detail');
    Route::get('seller/transaction', [TransactionController::class, 'showTransactionFromUser'])->name('seller.view-transaction');
    Route::put('seller/order/confirm', [OrderController::class, 'confirmOrder'])->name('seller.order.confirm');
    
    // Address
    Route::get('seller/address/edit/{id}', [AddressController::class, 'editAddressSeller'])->name('seller.address.edit');
    Route::post('seller/address/save', [AddressController::class, 'storeAdressSeller'])->name('seller.address.save');
    
    // Profile
    Route::get('seller/profile', [AddressController::class, 'indexAddressSeller'])->name('profile-seller');
    Route::get('seller/profile/edit', [AddressController::class, 'editProfileSeller'])->name('seller.profile.edit');
    Route::put('seller/profile/update', [SellerController::class, 'updateProfileSeller'])->name('seller.profile.update');

    // Shipment and order
    Route::put('seller/order/confirm/{order_id}', [ShipmentController::class, 'confirmShipment'])->name('seller.shipment.confirm');
    Route::put('seller/order/cancel/{order_id}', [OrderController::class, 'cancelOrder'])->name('seller.order.cancel');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('user/order/{id}', [OrderController::class, 'order'])->name('user.order');

    Route::get('user/cart', [CartController::class, 'index'])->name('user.cart');
    Route::post('user/cart/add/{product_id}', [CartController::class, 'add'])->name('user.cart.add');
    Route::delete('user/cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
    // cart
    Route::get('user/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::put('cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    Route::delete('cart/clear/{user_id}', [CartController::class, 'clearCartAfterPayment'])->name('cart.clear');
    
    // order
    Route::post('user/order/payment', [OrderController::class, 'store'])->name('user.order.payment');
    Route::post('user/cart/payment', [PaymentController::class, 'cartPayment'])->name('cart.payment');
    Route::get('user/history', [OrderController::class, 'history'])->name('user.history');
    Route::post('payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('payment/pending/{order_id}', [PaymentController::class, 'payPendingOrder'])->name('payment.pending');
    Route::get('user/order-detail/{id}', [OrderController::class, 'orderDetail'])->name('user.order-detail');

    // address
    Route::get('user/address/add', [AddressController::class, 'index'])->name('user.add-address');
    Route::post('user/address/save', [AddressController::class, 'saveAddress'])->name('user.address.store');
    Route::get('user/address/edit/{id}', [AddressController::class, 'editAddress'])->name('user.address.edit');
    Route::put('user/address/update', [AddressController::class, 'updateAddress'])->name('user.address.update');
    Route::delete('user/address/delete/{id}', [AddressController::class, 'deleteAddress'])->name('user.address.delete');
    
    // profile
    Route::get('user/profile', [UserController::class, 'profile'])->name('profile-user');
    Route::get('user/profile/edit/{user_id}', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('user/profile/update/{user_id}', [UserController::class, 'updateProfile'])->name('user.profile.edit');

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