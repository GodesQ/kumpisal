@extends('layouts.user-layout')

@section('title', 'Kumpisalan - About Us')

@section('content')
    <main id="main" class="site-main">
        <div class="page-title page-title--small align-left"
            style="background-image: url(user-assets/images/bg/bg-about.png);">
            <div class="container">
                <div class="page-title__content">
                    <h1 class="page-title__name">About Us</h1>
                    <p class="page-title__slogan">Tell you about us</p>
                </div>
            </div>
        </div><!-- .page-title -->
        <div class="site-content">
            <div class="container">
                <div class="company-info flex-inline my-4">
                    <img src="{{ URL::asset('user-assets/images/about-us.png') }}" alt="Our Company">
                    <div class="ci-content">
                        <h3>Mission statement</h3>
                        <p>
                            Our primary objective is to promote and encourage the practice of confession within the Catholic
                            spiritual life through the Kumpisalan app. We strive to offer an accurate and reliable source of
                            information that will facilitate Catholics in participating in this essential sacrament.
                            <br><br>
                            While donations will be the main source of income for the project, we recognize the significant
                            market potential for Kumpisalan, given the substantial Catholic population in the Philippines
                            and the increasing interest in online directories. However, we acknowledge the associated risks,
                            such as the difficulty in obtaining precise and timely information from parishes, as well as
                            potential technical challenges during development and maintenance.
                            <br><br>
                            To address these risks, we have devised a contingency plan that involves maintaining regular
                            communication with parishes, implementing backup data storage, and continuously monitoring and
                            updating the platform to ensure its smooth operation.
                            <br><br>
                            In essence, Kumpisalan aims to cater to the needs of the Catholic community by providing a
                            valuable resource for spiritual growth and practice. We strongly believe that this project has
                            the capacity to create a meaningful impact and we eagerly anticipate its successful
                            implementation and expansion.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
