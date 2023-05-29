<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Church;
use App\Models\User;
use App\Models\Admin;

use App\Http\Requests\Admin\SaveAdminProfileRequest;
use App\Http\Requests\Admin\ChangeAdminPasswordRequest;

class AdminController extends Controller
{
    public function dashboard() {
        $latest_users = User::latest()->limit(5)->get();
        $latest_churches = Church::latest()->limit(5)->get();
        return view('admin-page.dashboard', compact('latest_users', 'latest_churches'));
    }

    public function profile(Request $request) {
        return view('admin-page.admin-profile.profile');
    }

    public function saveProfile(SaveAdminProfileRequest $request) {
        $data = $request->validated();
        $admin = Admin::where('id', $request->id)->update($data);

        return back()->with('success', 'Save Profile Successfully');
    }

    public function changePassword(ChangeAdminPasswordRequest $request) {
        $data = $request->validated();
        $user = Auth::guard('admin')->user();

        if(!Hash::check($request->old_password, $user->password)) return back()->with('old_password_incorrect', 'Your old password is incorrect. Please Try Again.');
        $update_user = $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        if($request->has('is_logout') && $update_user) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('success', 'Your Password Updated Successfully. Login now with your new password.');
        } else {
            return back()->with('success', 'Your Password Updated Successfully.');
        }

        return back()->with('fail', 'Failed to update your password.');
    }
}
