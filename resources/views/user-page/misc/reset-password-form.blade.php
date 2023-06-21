@extends('layouts.user-layout')

@section('title', 'RESET PASSWORD FORM')

@section('content')
<main id="main" class="site-main p-2" style="height: 50vh;">
    <div class="site-content">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="forgot-password-container">
                <div class="card">
                    <div class="card-body">
                        <h3>Forgot Password</h3>
                        <hr>
                        <form action="{{ route('user.reset_password_form.post') }}" method="POST" class="member-profile form-underline">
                            @csrf
                            <input type="hidden" name="verify_token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="field-input">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" value="" id="new_password">
                                <span class="text-danger danger">@error('new_password'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-input">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" value="" id="confirm_password">
                                <span class="text-danger danger">@error('confirm_password'){{ $message }}@enderror</span>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
