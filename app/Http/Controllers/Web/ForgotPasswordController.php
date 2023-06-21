<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Mail\ResetPasswordMail;

use App\Models\ForgotPassword;
use App\Models\User;
use App\Http\Requests\ForgotPassword\ResetPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request) {
        return view('user-page.misc.forgot-password');
    }

    public function post_forgot_password(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = $this->generateToken();

        $create = ForgotPassword::create([
            'email' => $request->email,
            'token' => $token
        ]);

        $send_mail = Mail::to($request->email)->send(new ResetPasswordMail($request->email, $token));

        if($create) {
            return redirect()->route('user.forgot_password.message');
        }
    }

    public function message() {
        return view('user-page.misc.forgot-password-message');
    }

    public function reset_password_form(Request $request) {
        $email = $request->email;
        $token = $request->verify_token;
        return view('user-page.misc.reset-password-form', compact('email', 'token'));
    }

    public function post_reset_password_form(ResetPasswordRequest $request) {
        $forgot_password = ForgotPassword::where('token', $request->verify_token)->delete();

        if($forgot_password) {
            $user_password =  User::where('email', $request->email)->update([
                'password' => Hash::make($request->new_password)
            ]);

            if($user_password) return redirect()->route('home')->with('success', 'User Password Reset Successfully.');
        }
    }

    public function generateToken() {
        $str = Str::random(20);
        return $str;
    }
}
