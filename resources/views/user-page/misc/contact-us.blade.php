@extends('layouts.user-layout')

@section('title', 'Kumpisalan - Contact Us')

@section('content')
<main id="main" class="site-main contact-main">
    <div class="page-title page-title--small align-left" style="background-image: url(user-assets/images/bg/about-us-bg.jpg); width: 100%; background-size: cover; background-position: center center;">
        <div class="container">
            <div class="page-title__content">
                <h1 class="page-title__name">Contact Us</h1>
                <p class="page-title__slogan">We want to hear from you.</p>
            </div>
        </div>
    </div><!-- .page-title -->
    <div class="">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-form py-2">
                        <h3>Get in touch with us</h3>
                        <br>
                        <form action="{{ route('contact-message.store') }}" method="POST" class="form-underline">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="field-input" style="width: 100% !important;">
                                        <input type="text" name="firstname" value="" placeholder="First Name">
                                        <span class="text-danger">@error('firstname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-input">
                                        <input type="text" name="lastname" value="" placeholder="Last Name">
                                        <span class="text-danger">@error('lastname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="field-input">
                                        <input type="email" name="email" value="" placeholder="Email">
                                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-input">
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div style="border: 2px solid #2d2d2d; border-right: none; height: 100%; padding: 6.5px 10px;">+63</div>
                                            <input type="tel" name="contact_no" value="" placeholder="" class="px-2" max="9" style="margin-bottom: 0px; border: 2px solid #2d2d2d !important;">
                                        </div>
                                        <span class="text-danger">@error('contact_no'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="field-textarea">
                                <textarea name="message" placeholder="Message (Max: 500 characters)"></textarea>
                                <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-submit mt-3">
                                <button class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .site-content -->
</main><!-- .site-main -->
@endsection
