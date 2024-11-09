<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
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
