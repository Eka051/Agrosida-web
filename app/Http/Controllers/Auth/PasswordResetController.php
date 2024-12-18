<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.password-reset');
    }

    public function sendVerificationCode(Request $request)
    {
        // Log::info('Send Verification Code Called', [
        //     'email' => $request->email,
        //     'full_request' => $request->all()
        // ]);
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // $user = User::where('email', $request->email)->first();
        
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $request->session()->put('password_reset_email', $request->email);
        $request->session()->put('verification_code', $verificationCode);
        $request->session()->put('verification_code_expires_at', now()->addMinutes(5));

        Mail::send('emails.verification-code', ['code' => $verificationCode], function($message) use ($request) {
            $message->to($request->email)->subject('Password Reset Verification Code');
        });

        return response()->json(['success' => true]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric'
        ]);

        $storedCode = session('verification_code');
        $codeExpiry = session('verification_code_expires_at');

        if ($request->verification_code == $storedCode && now()->lessThan($codeExpiry)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $email = session('password_reset_email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            $request->session()->forget(['password_reset_email', 'verification_code', 'verification_code_expires_at']);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}