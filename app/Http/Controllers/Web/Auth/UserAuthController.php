<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserAuth\UserLoginRequest;
use App\Http\Requests\UserAuth\UserRegisterRequest;

use App\Models\User;

class UserAuthController extends Controller
{
    public function saveLogin(UserLoginRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard')->with('login-success', 'Login Successfully');
        } else {
            return back()->with('fail', 'Invalid Credentials.');
        }
    }

    public function saveRegister(UserRegisterRequest $request) {
        if($request->missing('accept_terms_condition')) return back()->with('fail', 'Fail to Register. Please Accept Terms and Conditions');

        $credentials = $request->validated();
        $store = User::create(array_merge($credentials, [
            'name' => $request->firstname . ' ' . $request->lastname,
            'password' => Hash::make($request->password),
            'user_uuid' => Str::orderedUuid()
        ]));

        return redirect()->route('home')->with('success', 'Register Successfully');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Successfully');
    }


}
