@extends('layouts.user-layout')

@section('title', 'Kumpisalan - Contact Us')

@section('content')
<main id="main" class="site-main contact-main">
    <div class="page-title page-title--small align-left" style="background-image: url(user-assets/images/bg/bg-about.png);">
        <div class="container">
            <div class="page-title__content">
                <h1 class="page-title__name">Contact Us</h1>
                <p class="page-title__slogan">We want to hear from you.</p>
            </div>
        </div>
    </div><!-- .page-title -->
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-text">
                        <h2>Our Offices</h2>
                        <div class="contact-box">
                            <h3>London (HQ)</h3>
                            <p>Unit TAP.E, 80 Long Lane, London, SE1 4GT</p>
                            <p>+44 (0)34 5312 3505</p>
                            <a href="#" title="Get Direction">Get Direction</a>
                        </div>
                        <div class="contact-box">
                            <h3>Paris</h3>
                            <p>Station F, 2 Parvis Alan Turing, 8742, Paris France</p>
                            <p>+44 (0)34 5312 3505</p>
                            <a href="#" title="Get Direction">Get Direction</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <h3>Get in touch with us</h3>
                        <br>
                        <form action="{{ route('contact-message.store') }}" method="POST" class="form-underline">
                            @csrf
                            <div class="field-input">
                                <input type="text" name="firstname" value="" placeholder="First Name">
                                <span class="text-danger">@error('firstname'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-input">
                                <input type="text" name="lastname" value="" placeholder="Last Name">
                                <span class="text-danger">@error('lastname'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-input">
                                <input type="email" name="email" value="" placeholder="Email">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-input">
                                <input type="tel" name="contact_no" value="" placeholder="Phone Number">
                                <span class="text-danger">@error('contact_no'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-textarea">
                                <textarea name="message" placeholder="Message"></textarea>
                                <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                            </div>
                            <div class="field-submit mt-3">
                                <button class="btn btn-primary">Save Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .site-content -->
</main><!-- .site-main -->
@endsection
