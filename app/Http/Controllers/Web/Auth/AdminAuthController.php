<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests\AdminAuth\AdminLoginRequest;

use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login(Request $request) {
        // check if you are currently login
        if(Auth::guard('admin')->check()) return back()->with('authenticated-but-login', 'You are currently login. Please logout first to continue.');

        return view('admin-page.auth.login');
    }

    public function saveLogin(AdminLoginRequest $request) {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt(array_merge($credentials, ['is_verify' => true]))) {
            return redirect()->route('admin.dashboard')->with('login-success', 'Login Successfully');
        } else {
            return back()->with('login-auth-failed', 'Invalid Credentials.');
        }
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');
    }
}
