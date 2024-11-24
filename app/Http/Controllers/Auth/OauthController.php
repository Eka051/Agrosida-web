<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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
            $user = Socialite::driver('google')->user();
            $foundUser = User::where('gauth_id', $user->id)->first();

            if ($foundUser) {
                Auth::login($foundUser);
                if (Auth::check()) {
                    \Log::info('User successfully logged in: ' . Auth::user()->email);
                } else {
                    \Log::warning('User login failed');
                }

                if ($foundUser->hasRole('admin')) {
                    return redirect()->route('admin.dashboard');
                } elseif ($foundUser->hasRole('seller')) {
                    return redirect()->route('seller.dashboard');
                } else {
                    return redirect()->route('user.dashboard');
                }

            } else {
                $newUser = new User([
                    'user_id' => Str::uuid(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => bcrypt(Str::random(16)),
                ]);
                $newUser->assignRole('user');

                $newUser->save();

                DB::table('users_roles')->insert([
                    'user_id' => $newUser->user_id,
                    'role_id' => 2,
                ]);

                Auth::login($newUser);

                return redirect()->route('user.dashboard');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
