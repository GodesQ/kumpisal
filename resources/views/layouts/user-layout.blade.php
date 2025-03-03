<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Discover and manage confession schedules of churches across Luzon, Visayas, and Mindanao with Kumpisalan. This web app helps you find nearby churches, making it easier than ever to plan your confessions. Stay connected to your faith and explore spiritual opportunities effortlessly with Kumpisalan." />
    <meta name="author" content="GODESQ DIGITAL MARKERTING SERVICES" />
    <meta name="generator" content="KUMPISALAN" />
    <meta name="keywords"
        content="confession schedules, churches, Luzon, Visayas, Mindanao, Kumpisalan, nearby churches, faith, spiritual opportunities">
    <link rel="shortcut icon" href="{{ URL::asset('user-assets/images/assets/favicon.ico') }}" type="image/x-icon">
    <meta name="theme-color" content="#331f14">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('user-assets/fonts/jost/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/fontawesome-pro/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/quilljs/css/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/quilljs/css/quill.core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/quilljs/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/chosen/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/datetimepicker/jquery.datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('user-assets/libs/venobox/venobox.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('user-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('user-assets/css/responsive.css') }}" />

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/icons/tabler-icons/tabler-icons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    @stack('styles')

</head>

<body>
    <div id="wrapper">
        <header id="header" class="site-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-8">
                        <div class="site">
                            <div class="site__menu">
                                <a title="Menu Icon" href="#" class="site__menu__icon">
                                    <i class="las la-bars la-24-black"></i>
                                </a>
                                <div class="popup-background"></div>
                                <div class="popup popup--left">
                                    <a title="Close" href="#" class="popup__close">
                                        <i class="las la-times la-24-black"></i>
                                    </a><!-- .popup__close -->
                                    <div class="popup__content">
                                        <div class="popup__user popup__box open-form">
                                            @if (!auth()->check())
                                                <a title="Login" href="#" class="open-login">Login</a>
                                                <a title="Sign Up" href="#" class="open-signup">Sign Up</a>
                                            @endif
                                        </div><!-- .popup__user -->
                                        <div class="popup__menu popup__box">
                                            <ul class="menu-arrow">
                                                <li>
                                                    <a href="{{ route('home') }}" title="Home">Home</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('churches.searchPage') }}"
                                                        title="Churches">Churches</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('about-us') }}" title="About Us">About Us</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contact-us') }}" title="Contact Us">Contact
                                                        Us</a>
                                                </li>
                                            </ul>
                                        </div><!-- .popup__menu -->
                                    </div><!-- .popup__content -->
                                </div><!-- .popup -->
                            </div><!-- .site__menu -->
                            <div class="site__brand">
                                <a title="Logo" href="/" class="site__brand__logo">
                                    <img src="{{ asset('user-assets/images/assets/dark-kumpisalan.png') }}"
                                        alt="Kumpisalan" style="max-width: 150px !important;">
                                </a>
                            </div><!-- .site__brand -->

                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="right-header align-right">
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('home') }}" title="Home">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('churches.searchPage') }}" title="Churches">Churches</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about-us') }}" title="About Us">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact-us') }}" title="Contact Us">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                            @if (!auth()->check())
                                <div class="right-header__login">
                                    <a title="Login" class="open-login" href="#">Login</a>
                                </div>
                            @endif

                            <!-- .popup-form -->
                            <div class="popup popup-form">
                                <a title="Close" href="#" class="popup__close">
                                    <i class="las la-times la-24-black"></i>
                                </a><!-- .popup__close -->
                                <ul class="choose-form">
                                    <li class="nav-signup"><a title="Sign Up" href="#signup">Sign Up</a></li>
                                    <li class="nav-login"><a title="Log In" href="#login">Log In</a></li>
                                </ul>
                                <div class="popup-content">
                                    @include('user-page.auth.register')
                                    @include('user-page.auth.login')
                                </div>
                            </div><!-- .popup-form -->

                            @auth
                                <div class="dropdown">
                                    @if (auth()->user()->user_image)
                                        <img src="{{ asset('user-assets/images/avatars/' . auth()->user()->user_image) }}"
                                            onclick="handleUserDropdown()" alt=""
                                            style="width: 35px; height: 35px; object-fit: cover; border: 1px solid #331f14;"
                                            class="rounded-circle user-drop-btn">
                                    @else
                                        <img src="{{ asset('admin-assets/images/profile/' . 'user-1.jpg') }}"
                                            onclick="handleUserDropdown()" alt="" width="35" height="35"
                                            class="rounded-circle user-drop-btn">
                                    @endif
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ auth()->user()->is_admin_generated ? route('representative.dashboard') : route('user.dashboard') }}"
                                            title="Dashboard"> <i class="ti ti-dashboard text-primary mr-3"></i>
                                            Dashboard</a>
                                        <a href="{{ auth()->user()->is_admin_generated ? route('representative.profile') : route('user.profile') }}"
                                            title="My Profile"> <i class="ti ti-user text-primary mr-3"></i> My
                                            Profile</a>
                                        <a>
                                            <form action="{{ route('user.logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="w-100 rounded mt-2 logout-btn">
                                                    <i class="ti ti-logout text-primary mr-3"></i>Logout
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div><!-- .right-header -->
                    </div>
                </div><!-- .row -->
            </div><!-- .container-fluid -->
        </header><!-- .site-header -->
        @yield('content')
        <footer id="footer" class="footer">
            <div class="container">
                <div class="footer__top">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer__top__info">
                                <a title="Logo" href="{{ route('home') }}" class="">
                                    <img src="{{ asset('user-assets/images/assets/dark-kumpisalan.png') }}"
                                        alt="Kumpisalan Logo" width="200">
                                </a>

                                <p class="footer__top__info__desc mt-3">Journey Inward: Unveiling the Depths <br>
                                    Within - A
                                    Soulful Quest for Self-Understanding</p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <aside class="footer__top__nav">
                                <h3>Quick Links</h3>
                                <ul>
                                    <li><a title="Home" href="{{ route('home') }}">Home</a></li>
                                    <li><a title="Churches" href="{{ route('churches.searchPage') }}">Churches</a>
                                    </li>
                                    <li><a title="About Us" href="{{ route('about-us') }}">About Us</a></li>
                                    <li><a title="Contact Us" href="{{ route('contact-us') }}">Contact Us</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2">
                            <aside class="footer__top__nav">
                                <h3>Support</h3>
                                <ul>
                                    <li><a title="Get in Touch" href="{{ route('contact-us') }}">Get in Touch</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-3">
                            <aside class="footer__top__nav footer__top__nav--contact">
                                <h3>Contact Us</h3>
                                <p>Email: <a href="mailto:info@kumpisalan.com">info@kumpisalan.com</a></p>
                                <p>Phone: <a href="tel:09458426538">09458426538</a></p>
                                <ul>
                                    <li class="facebook">
                                        <a title="Facebook"
                                            href="https://www.facebook.com/profile.php?id=100093120504740"
                                            target="_blank">
                                            <i class="la la-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a title="Instagram" href="#">
                                            <i class="la la-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div><!-- .top-footer -->
                <div class="footer__bottom d-flex justify-content-around align-items-center">
                    <p class="footer__bottom__copyright">2023 &copy; <a title="Uxper Team"
                            href="#">kumpisalan</a>. All rights reserved.</p>
                    <p class="footer__bottom__copyright">Design & Developed by <a href="https://godesq.com/"
                            target="_blank">GodesQ Digital Marketing
                            Services</a></p>
                </div><!-- .top-footer -->
            </div><!-- .container -->
        </footer><!-- site-footer -->
    </div><!-- #wrapper -->



    <script src="{{ asset('user-assets/js/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('user-assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('user-assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/slick/slick.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/slick/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/quilljs/js/quill.core.js') }}"></script>
    <script src="{{ asset('user-assets/libs/quilljs/js/quill.js') }}"></script>
    <script src="{{ asset('user-assets/libs/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('user-assets/libs/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEmTK1XpJ2VJuylKczq2-49A6_WuUlfe4&libraries=places&callback=initialize">
    </script>

    @if ($errors->any())
        @if (old('type_form') == 'login')
            <script type="text/javascript">
                $('.popup--left').removeClass('open');
                $('.nav-login').addClass('active');
                $('.form-log').fadeIn(0);
                $('.nav-signup').removeClass('active');
                $('.form-sign').fadeOut(0);
                $('.popup-background').fadeIn(0);
                $('.popup-form').toggleClass('open');
            </script>
        @elseif (old('type_form') == 'register')
            <script>
                $('.popup--left').removeClass('open');
                $('.nav-signup').addClass('active');
                $('.form-sign').fadeIn(0);
                $('.nav-login').removeClass('active');
                $('.form-log').fadeOut(0);
                $('.popup-background').fadeIn(0);
                $('.popup-form').toggleClass('open');
            </script>
        @endif
    @endif

    <script>
        function initialize() {
            let address = document.querySelector('.site__search__input');
            let latitude = document.querySelector('#mob_latitude');
            let longitude = document.querySelector('#mob_longitude');

            // for search
            let searchBox = new google.maps.places.SearchBox(address);

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces(),
                    bounds = new google.maps.LatLngBounds(),
                    i, place, lat, long, resultArray, address = places[0].formatted_address;
                lat = places[0].geometry.location.lat()
                long = places[0].geometry.location.lng();
                latitude.value = lat;
                longitude.value = long;
                resultArray = places[0].address_components;
            });
        }

        $(document).ready(function() {
            $('#church_address').keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.site__search__input').keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        $('.search__save').click(function() {
            $('.site__search__form').submit();
        })
    </script>

    @stack('scripts')

    @if (Session::get('fail'))
        <script>
            toastr.options = {
                closeButton: true, // Add close button
                timeOut: 2000
            };
            toastr.error("{{ Session::get('fail') }}", 'Fail');
        </script>
    @endif

    @if (Session::get('success'))
        <script>
            toastr.options = {
                closeButton: true, // Add close button
                timeOut: 2000
            };
            toastr.success("{{ Session::get('success') }}", 'Success');
        </script>
    @endif

</body>

</html>
