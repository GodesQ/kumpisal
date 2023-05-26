<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserAuth\UserLoginRequest;
use App\Http\Requests\UserAuth\UserRegisterRequest;

use App\Models\User;
use App\Mail\UserEmailVerification;

use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function saveLogin(UserLoginRequest $request) {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if(!$user->is_verify) {
                Auth::logout();
                return redirect()->route('home')->with('fail', 'Please verify your email to continue.');
            }
            return redirect()->route('user.dashboard')->with('login-success', 'Login Successfully');
        } else {
            return back()->with('fail', 'Invalid Credentials.');
        }
    }

    public function saveRegister(UserRegisterRequest $request) {
        if($request->missing('accept_terms_condition')) return back()->with('fail', 'Fail to Register. Please Accept Terms and Conditions');

        $credentials = $request->validated();

        $user = User::create(array_merge($credentials, [
            'name' => $request->firstname . ' ' . $request->lastname,
            'password' => Hash::make($request->password),
            'user_uuid' => Str::orderedUuid()
        ]));

        # details for sending email to worker
        $details = [
            'title' => 'Verification Email from Kumpisalan App',
            'email' => $user->email,
            'name' => $user->name,
        ];

        // SEND EMAIL FOR VERIFICATION
        Mail::to($user->email)->send(new UserEmailVerification($details));

        return redirect()->route('home')->with('success', 'Register Successfully');
    }

    public function verifyEmail(Request $request) {
        $user = User::where('email', $request->email)->first();
        $user->is_verify = true;
        $user->email_verified_at = Carbon::now();
        $user_save = $user->save();

        return redirect()->route('home')->with('success', 'Email Verify Successfully');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Successfully');
    }


}
