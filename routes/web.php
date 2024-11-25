<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register')->name('register');
});

Route::get('/test', function () {
    return view('simulate');
});


Route::post('/confirm-password', function (Request $request) {
    if (! Hash::check($request->password, $request->user()->password)) {
        return back()->withErrors([
            'password' => ['The provided password does not match our records.']
        ]);
    }
    $request->session()->passwordConfirmed();
    return redirect()->intended('/dashboard');
})->middleware(['auth', 'throttle:6,1']);
