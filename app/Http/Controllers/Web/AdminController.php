<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Church;
use App\Models\User;
use App\Models\Admin;

use App\Http\Requests\Admin\SaveAdminProfileRequest;

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
}
