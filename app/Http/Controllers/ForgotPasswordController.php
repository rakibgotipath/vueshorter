<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {

            //password rest token
            $passwordReset = DB::table('password_reset_tokens')->where('email', $request->email)->first();
            if ($passwordReset) {
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            }

            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);

            //send email
            $user = User::where('email', $request->email)->first();
            $user->notify(new ResetPasswordNotification($token));

        } catch (\Exception $e) {
            return back()->withError(['message' => $e->getMessage()]);
        }


        return back()->withSuccess(['message' => 'Password reset link has been sent to your email.']);
    }

    public function resetPasswordVerify($token)
    {
        $passwordReset = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$passwordReset) {
            return redirect()->route('forgot.password')->withError(['message' => 'Invalid token!']);
        }

        // expire token after 1 hour
        if (now()->diffInMinutes($passwordReset->created_at) > 60) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('forgot.password')->withError(['message' => 'Token expired!']);
        }

        return Inertia::render('Auth/ResetPassword', [
            'token' => $token
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $passwordReset = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if (!$passwordReset) {
            return back()->withError(['message' => 'Invalid token!']);
        }

        DB::table('users')->where('email', $passwordReset->email)->update([
            'password' => bcrypt($request->password)
        ]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return redirect()->route('login')->withSuccess(['message' => 'Password reset successfully!']);
    }
}
