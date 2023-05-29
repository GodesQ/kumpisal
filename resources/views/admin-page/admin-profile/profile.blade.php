@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>Edit Profile</h4>
                </div>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.profile.post', auth('admin')->user()->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" value="{{ auth('admin')->user()->username }}">
                                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ auth('admin')->user()->email }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ auth('admin')->user()->firstname }}">
                                        <span class="text-danger">@error('firstname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="middlename" class="form-label">Middlename</label>
                                        <input type="text" class="form-control" name="middlename" id="middlename" value="{{ auth('admin')->user()->middlename }}">
                                        <span class="text-danger">@error('middlename'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{ auth('admin')->user()->lastname }}">
                                        <span class="text-danger">@error('lastname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Change Password</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::get('old_password_incorrect'))
                            <div class="alert alert-danger">{{ Session::get('old_password_incorrect') }}</div>
                        @endif
                        <form action="{{ route("admin.change_password.post", auth('admin')->user()->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password">
                                        <span class="text-danger danger">@error('old_password'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password">
                                        <span class="text-danger danger">@error('new_password'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                        <span class="text-danger danger">@error('confirm_password'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_logout" name="is_logout" value="1" checked>
                                        <label class="form-label" for="is_logout">
                                            Logout after successfully changed?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary">Save Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if(Session::get('success'))
    @push('scripts')
        <script>
            toastr.success("{{ Session::get('success') }}", 'Successs');
        </script>
    @endpush
@endif
