@extends('layouts.admin-layout')

@section('title', 'Create User')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title fw-semibold">Create User</h4>
                <a href="{{ route('admin.users.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="post">
                    @csrf
                    <div class="row border-bottom">
                        <div class="col-12">
                            <h3 class="mb-3">Account Information</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                                <span class="text-danger danger">@error('password'){{ $message }}@enderror</span>
                                <div id="passwordHelp" class="form-text">We'll never share your password with anyone else.</div>
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
                                <input type="text" class="form-control" id="firstname" name="firstname" name="firstname" aria-describedby="firstnameHelp">
                                <span class="danger text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="middlename" name="middlename" aria-describedby="middlenameHelp">
                                <span class="danger text-danger">@error('middlename'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp">
                                <span class="danger text-danger">@error('lastname'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp">
                                <span class="danger text-danger">@error('address'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="verify_email" name="is_verify" value="1">
                                <label class="form-label" for="verify_email">
                                    Verify Email <span style="font-size: 12px; font-weight: 400;">(If you check this box, It will not send a verification to email you registered.)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                                <label class="form-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
