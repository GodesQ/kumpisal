@extends('layouts.admin-layout')

@section('title', 'Create Admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title fw-semibold">Edit Admin</h4>
                <a href="{{ route('admin.admins.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('admin.update', $admin->id) }}" method="post">
                    @csrf
                    <div class="row border-bottom">
                        <div class="col-12">
                            <h3 class="mb-3">Account Information</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ $admin->email }}">
                                <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="{{ $admin->username }}">
                                <span class="text-danger danger">@error('username'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 border-bottom pb-2">
                        <div class="col-12">
                            <h3 class="mb-3">General Information</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" name="firstname" value="{{ $admin->firstname }}" aria-describedby="firstnameHelp">
                                <span class="danger text-danger">@error('firstname'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="middlename" name="middlename" aria-describedby="middlenameHelp" value="{{ $admin->middlename }}">
                                <span class="danger text-danger">@error('middlename'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp" value="{{ $admin->lastname }}">
                                <span class="danger text-danger">@error('lastname'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position" aria-describedby="positionHelp" value="{{ $admin->position }}">
                                <span class="danger text-danger">@error('position'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role" aria-describedby="roleHelp" value="{{ $admin->role }}">
                                <span class="danger text-danger">@error('role'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="verify_email" name="is_verify" value="1" {{ $admin->is_verify ? 'checked' : null }}>
                                <label class="form-label" for="verify_email">
                                    Verify Email <span style="font-size: 12px; font-weight: 400;">(If you check this box, It will not send a verification to email you registered.)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $admin->is_active ? 'checked' : null }}>
                                <label class="form-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
