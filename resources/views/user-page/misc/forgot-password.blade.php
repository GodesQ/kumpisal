@extends('layouts.user-layout')

@section('title', 'Forgot Password')

@section('content')
    <main id="main" class="site-main p-2" style="height: 50vh;">
        <div class="site-content">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="forgot-password-container">
                    <div class="card">
                        <div class="card-body">
                            <h3>Forgot Password</h3>
                            <hr>
                            <form action="{{ route('user.forgot_password.post') }}" method="POST" class="member-profile form-underline">
                                @csrf
                                <div class="field-input">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" value="" id="email">
                                    <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
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
