<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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
            $findUser = User::where('gauth_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);

                if ($findUser->role->name == 'admin') {
                    return redirect('admin/dashboard');
                } elseif ($findUser->name == 'seller') {
                    return redirect('seller/dashboard');
                } else {
                    return redirect('user/dashboard');
                }

            } else {
                $newUser = new User([
                    'user_id' => Str::uuid(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => bcrypt('password'),
                    'role_id' => $user->role_id,
                ]);

                $newUser->save();

                Auth::login($newUser);

                return redirect('user/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
