@extends('layouts.user-layout')

@section('title', 'FORGOT PASSWORD MESSAGE')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="height: 40vh;">
    <div class="d-flex justify-content-center align-items-center bg-white border-success-3 my-2 p-5 flex-column verify-box" style="border: 2px solid #303030;">
        <img class="brand-logo my-2" alt="kumpisalan" src="{{ URL::asset('user-assets/images/assets/dark-kumpisalan.png') }}" width="200">
        <h2 class="text-center">Password Reset in <span class="text-primary">KUMPISALAN</span>!</h2>
        <h4 class="text-center">We have sent an forgot password email to your email address.</h4>
        <p class="text-center">Just click on the link in that email to change your password.</p>
    </div>
</div>
@endsection


