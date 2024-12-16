<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.password-reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Password berhasil diubah');
        }

        return back()->with('error', 'Email tidak ditemukan');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $verificationCode = sprintf('%04d', rand(0, 9999));
            $user->update([
                'verification_code' => $verificationCode,
            ]);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            $user->update([
                'verification_code' => $verificationCode,
                'verification_code_expired_at' => now()->addMinutes(5),
            ]);

            return redirect()->route('password.reset')->with('success', 'Kode verifikasi telah dikirim ke email');
        }

        return back()->with('error', 'Email tidak ditemukan');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|min:6|max:6',
        ]);

        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();

        if ($user) {
            return redirect()->route('password.reset')->with('success', 'Kode verifikasi benar');
        }

        return back()->with('error', 'Kode verifikasi salah');
    }

    
}
