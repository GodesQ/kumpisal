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

        $send_mail = Mail::to($request->email)->send(ResetPasswordMail($request->email, $token));

        if($send_mail && $create) {
            return view('');
        }
    }

    public function forgot_message() {

    }

    public function reset_password_form(Request $request) {

    }

    public function post_reset_password_form(Request $request) {

    }

    public function generateToken() {
        $str = Str::random(20);
        return $str;
    }
}
