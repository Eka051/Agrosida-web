<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::prefix('seller')->name('seller.')->group(function () {
    Route::get('/beranda', function () {
        return view('seller/sellerDashboard');
    })->name('beranda');
    Route::get('/pesanan', function () {
        return view('seller/pesananSeller');
    })->name('pesanan');
    Route::get('/transaksi', function () {
        return view('seller/transaksiSeller');
    })->name('transaksi');
    Route::get('/kalkulasipestisida', function () {
        return view('seller/kalkulasiPestisida');
    })->name('kalkulasipestisida');
    Route::get('/tambahproduk', function () {
        return view('seller/tambahProduk');
    })->name('tambahproduk');
    Route::get('/editproduk', function () {
        return view('seller/editproduk');
    })->name('editproduk');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/beranda', function () {
        return view('user/userDashboard');
    })->name('beranda');
    Route::get('/keranjang', function () {
        return view('user/keranjang');
    })->name('keranjang');
    Route::get('/checkout', function () {
        return view('user/checkout');
    })->name('checkout');
    Route::get('/riwayatpesanan', function () {
        return view('user/riwayatPesananUser');
    })->name('riwayatpesanan');
    Route::get('/kalkulasipestisida', function () {
        return view('user/kalkulasiPestisidaUser');
    })->name('kalkulasipestisida');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/beranda', function () {
        return view('admin/adminDashboard');
    })->name('beranda');
    Route::get('/kelolapengguna', function () {
        return view('admin/kelolaPengguna');
    })->name('kelolapengguna');
    Route::get('/editpengguna', function () {
        return view('admin/editKelolaPengguna');
    })->name('editpengguna');
    Route::get('/pesanan', function () {
        return view('admin/lihatSemuaPesanan');
    })->name('pesanan');
    Route::get('/prosespesanan', function () {
        return view('admin/memprosesPesanan');
    })->name('prosespesanan');
    Route::get('/kategori', function () {
        return view('admin/mengelolaKategori');
    })->name('kategori');
    Route::get('/editkategori', function () {
        return view('admin/editKategoriProduk');
    })->name('editkategori');
    Route::get('/produk', function () {
        return view('admin/mengelolaProduk');
    })->name('produk');
    Route::get('/editproduk', function () {
        return view('admin/editKelolaProduk');
    })->name('editproduk');
    Route::get('/transaksi', function () {
        return view('admin/mengelolaTransaksi');
    })->name('transaksi');
    Route::get('/kalkulasipestisida', function () {
        return view('admin/kalkulasiPestisidaAdmin');
    })->name('kalkulasipestisida');
});


// Route::get('/admin', function () {
//     return view('adminDashboard');
// })->name('admin.dashboard');
// Route::get('/user', function () {
//     return view('userDashboard');
// })->name('user.dashboard');

Route::post('/confirm-password', function (Request $request) {
    if (! Hash::check($request->password, $request->user()->password)) {
        return back()->withErrors([
            'password' => ['The provided password does not match our records.']
        ]);
    }
    $request->session()->passwordConfirmed();
    return redirect()->intended('/dashboard');
})->middleware(['auth', 'throttle:6,1']);
