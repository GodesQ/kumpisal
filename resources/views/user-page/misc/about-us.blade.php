@extends('layouts.user-layout')

@section('title', 'Kumpisalan - About Us')

@section('content')
    <main id="main" class="site-main">
        <div class="page-title page-title--small align-left" style="background-image: url(user-assets/images/bg/bg-about.png);">
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
                    <img src="{{ URL::asset('user-assets/images/about-2.jpeg') }}" alt="Our Company">
                    <div class="ci-content">
                        <h3>Mission statement</h3>
                        <p>
                            The project's main goal is to encourage and promote the practice of confession as a regular part
                            of Catholic spiritual life. Through Kumpisalan, we aim to provide a reliable and up-to-date
                            source of information that will make it easier for Catholics to participate in this important
                            sacrament.
                            <br><br>
                            While the primary source of income for the project will be through donations, we believe that
                            the potential market for Kumpisalan is significant, given the large Catholic population in the
                            Philippines and the growing interest in online directories. However, there are also risks
                            involved, such as the challenge of obtaining accurate and timely information from parishes, as
                            well as potential technical issues that may arise during development and maintenance.
                            <br><br>
                            To mitigate these risks, we have developed a contingency plan that includes measures such as
                            regular communication with parishes, backup data storage, and continuous monitoring and updating
                            of the platform.
                            <br><br>
                            Overall, Kumpisalan seeks to serve the needs of the Catholic community by providing a valuable
                            resource for spiritual growth and practice. We believe that this project has the potential to
                            make a significant impact, and we look forward to its successful implementation and growth.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
