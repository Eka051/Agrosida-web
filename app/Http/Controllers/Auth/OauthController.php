<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\DB;

class OauthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $foundUser = User::where('gauth_id', $googleUser->id)
                            ->where('gauth_type', 'google')
                            ->first();

            if ($foundUser) {
                Auth::login($foundUser);
                \Log::info("User masuk dengan email: {$foundUser->email}");

                if ($foundUser->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                } elseif ($foundUser->hasRole('seller')) {
                    return redirect()->route('seller.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }
            } else {
                DB::beginTransaction();
                try {
                    $newUser = User::create([
                        'user_id' => Str::uuid(),
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'gauth_id' => $googleUser->id,
                        'gauth_type' => 'google',
                        'password' => bcrypt(Str::random(16)),
                    ]);

                    $newUser->assignRole('user');

                    DB::commit();

                    Auth::login($newUser);
                    \Log::info("User baru, masuk via Google: {$newUser->email}");

                    return redirect()->route('user.dashboard')->with('success', 'Selamat datang!' . auth()->user()->name);
                } catch (Exception $e) {
                    DB::rollBack();
                    \Log::error('Error membuat user baru: ' . $e->getMessage());
                    throw $e;
                }
            }
        } catch (Exception $e) {
            \Log::error('Google OAuth error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi.');
        }
    }
}