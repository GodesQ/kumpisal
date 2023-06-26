<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Gate;

use DataTables;
use App\Models\User;
use App\Models\Church;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\SaveUserProfileRequest;
use App\Http\Requests\User\ChangeUserPasswordRequest;

use App\Repositories\AdminLogRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(AdminLogRepository $adminLogRepository, UserRepository $userRepository) {
        $this->title_create_log = 'Create User';
        $this->title_update_log = 'Update User';
        $this->AdminLogRepository = $adminLogRepository;
        $this->UserRepository = $userRepository;
    }

    public function dashboard(Request $request) {
        $user = Auth::user();

        $near_churches = Church::select('*')
        ->active(1)
        ->when($user->latitude and $user->longitude && $user->address, function ($q) use ($user) {
            return $q->addSelect(DB::raw('6371 * acos(cos(radians(' . $user->latitude ."))
                    * cos(radians(churches.latitude)) * cos(radians(churches.longitude) - radians(" .  $user->longitude . ")) + sin(radians(" .  $user->latitude . "))
                    * sin(radians(churches.latitude))) AS distance"))
                ->having('distance', '<=', '2')
                ->orderBy('distance', 'asc');
        })
        ->limit(10)
        ->get();

        return view('user-page.user-dashboard.dashboard', compact('near_churches'));
    }

    public function profile(Request $request) {
        return view('user-page.user-dashboard.user-profile');
    }

    public function saveProfile(SaveUserProfileRequest $request) {
        $data = $request->validated();
        $user_image = $request->old_user_image;

        if($request->hasFile('member_avatar')) {
            $old_upload_image = public_path('/user-assets/images/avatars/') . $request->old_user_image;
            $remove_image = @unlink($old_upload_image);

            $file = $request->file('member_avatar');
            $user_image = $request->uuid . '.' . $file->getClientOriginalExtension();
            // save to folder
            $save_file = $file->move(public_path().'/user-assets/images/avatars', $user_image);
        }

        $prefer_days = null;
        if($request->has('prefer_days')) {
            $prefer_days = implode('|', $request->prefer_days);
        }

        $user = User::where('user_uuid', $request->uuid)->first();
        $update_user = $user->update(array_merge($data, [
            'user_image' => $user_image,
            'prefer_days' => $prefer_days,
        ]));

        if($update_user) return back()->with('success', 'User Profile Successfully Saved.');
        return back()->with('fail', 'Failed to update user profile.');
    }

    public function changePassword(ChangeUserPasswordRequest $request) {
        $data = $request->validated();
        $user = Auth::user();

        if(!Hash::check($request->password, $user->password)) return back()->with('fail', 'Your old password is incorrect. Please Try Again.');

        $update_user = $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        if($request->has('is_logout') && $update_user) {
            Auth::logout();
            return redirect()->route('home')->with('success', 'Your Password Updated Successfully. Login now with your new password.');
        } else {
            return back()->with('success', 'Your Password Updated Successfully.');
        }

        return back()->with('fail', 'Failed to update your password.');
    }

    public function lists(Request $request) {
        if($request->ajax()) {
            $users = User::where('is_admin_generated', 0)
                        ->isNotDeleted()
                        ->get();

            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('verified', function($row) {
                        if($row->is_verify) {
                            $badge = '<span class="badge bg-success rounded-3 fw-semibold">Verified</span>';
                        } else {
                            $badge = '<span class="badge bg-warning rounded-3 fw-semibold">Not Verify</span>';
                        }
                        return $badge;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/user/edit/' .$row->user_uuid. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a> ';
                        if(Gate::allows('delete_user')) {
                            $btn .= '<a id="' .$row->user_uuid. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'verified'])
                    ->make(true);
        }

        return view('admin-page.users.list');
    }

    public function create(Request $request) {
        return view('admin-page.users.create');
    }

    public function store(CreateUserRequest $request) {
        $data = $request->except('_token', 'password');
        $save_user = $this->UserRepository->store($request, $data);

        if($save_user) return redirect()->route('admin.users.list')->with('success', 'Create User Successfully');
        abort(500);
    }

    public function edit(Request $request) {
        $user = User::where('user_uuid', $request->uuid)->firstOrFail();
        return view('admin-page.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request) {
        $data = $request->validated();
        $update_user = $this->UserRepository->update($request, $data);

        if($update_user) return back()->with('success', 'Update User Successfully');
        abort(500);
    }

    public function delete(Request $request) {
        $user = User::where('user_uuid', $request->user_uuid)->firstOr(function () {
            return response([
                'status' =>  'User not found'
            ], 404);
        });

        $remove_user = $user->update([
            'is_delete' => true
        ]);

        if($remove_user) {
            return response()->json([
                'status' => 'Removed',
                'message' => 'Removed Successfully'
            ], 200);
        }
    }
}
