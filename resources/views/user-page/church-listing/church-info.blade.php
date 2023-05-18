@extends('layouts.user-layout')

@section('title')
    {{ $church->name }}
@endsection

@section('content')
    <main id="main" class="site-main single single-02">
        <div class="place">
            {{-- <div class="slick-sliders">
                <div class="slick-slider" data-item="1" data-arrows="true" data-itemscroll="1" data-dots="true"
                    data-infinite="true" data-centermode="true" data-centerpadding="418px" data-tabletitem="1"
                    data-tabletscroll="1" data-tabletpadding="70px" data-mobileitem="1" data-mobilescroll="1"
                    data-mobilepadding="30px">
                    <div class="place-slider__item bd"><a title="Place Slider Image" href="#">

                    </div>
                </div><!-- .page-title --> --}}
            </div><!-- .place-slider -->
            <div class="container">
                <img src="{{ asset('admin-assets/images/churches' . '/' . $church->church_image) }}" alt="slider-01" style="height: 400px; width: 100%; object-fit: cover;"></a>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="place__left">
                            <div class="place__box place__box--npd mt-3">
                                <h1>{{ $church->name }}</h1>
                            </div><!-- .place__box -->
                            <hr>
                            <div class="place__box place__box-overview">
                                <h3>Overview</h3>
                                <div class="place__desc">{{ $church->description }}</div><!-- .place__desc -->
                                <a href="#" class="show-more" title="Show More">Show more</a>
                            </div>
                            <div class="place__box place__box-map">
                                <h3 class="place__title--additional">
                                    Location & Maps
                                </h3>
                                <div class="maps">
                                    <div id="map"></div>
                                </div>
                                <div class="address">
                                    <i class="la la-map-marker"></i>
                                    1906 Market St San Francisco 94102
                                    <a href="#" title="Direction">(Direction)</a>
                                </div>
                            </div><!-- .place__box -->
                            <div class="place__box">
                                <h3>Contact Info</h3>
                                <ul class="place__contact">
                                    <li>
                                        <i class="la la-phone"></i>
                                        <a title="00 343 7859" href="tel:003437859">00 343 7859</a>
                                    </li>
                                    <li>
                                        <i class="la la-globe"></i>
                                        <a title="www.abcsite.com" href="www.abcsite.com">www.abcsite.com</a>
                                    </li>
                                    <li>
                                        <i class="la la-facebook-f"></i>
                                        <a title="fb.com/abc" href="fb.com/abc">facebook.com/getgolo</a>
                                    </li>
                                    <li>
                                        <i class="la la-instagram"></i>
                                        <a title="instagram.com/abc" href="instagram.com/abc">instagram.com/getgolo</a>
                                    </li>
                                </ul>
                            </div><!-- .place__box -->
                            <div class="place__box place__box-open">
                                <h3 class="place__title--additional">
                                    Opening Hours
                                </h3>
                                <table class="open-table">
                                    <tbody>
                                        <tr>
                                            <td class="day">Monday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Tuesday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Wednesday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Thursday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Friday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Saturday</td>
                                            <td class="time">8:00 am - 10:00 pm</td>
                                        </tr>
                                        <tr>
                                            <td class="day">Sunday</td>
                                            <td class="time">Close</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- .place__box -->
                        </div><!-- .place__left -->
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar sidebar--shop sidebar--border">
                            <div class="widget-reservation-mini">
                                <h3>Make a reservation</h3>
                                <a href="#" class="open-wg btn">Request</a>
                            </div>
                            <aside class="widget widget-shadow widget-reservation">
                                <h3>Make a reservation</h3>
                                <form action="#" method="POST" class="form-underline">
                                    <div class="field-select has-sub field-guest">
                                        <span class="sl-icon"><i class="la la-user-friends"></i></span>
                                        <input type="text" placeholder="Guest" readonly>
                                        <i class="la la-angle-down"></i>
                                        <div class="field-sub">
                                            <ul>
                                                <li>
                                                    <span>Adults</span>
                                                    <div class="shop-details__quantity">
                                                        <span class="minus">
                                                            <i class="la la-minus"></i>
                                                        </span>
                                                        <input type="number" name="quantity" value="0"
                                                            class="qty number_adults">
                                                        <span class="plus">
                                                            <i class="la la-plus"></i>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>Childrens</span>
                                                    <div class="shop-details__quantity">
                                                        <span class="minus">
                                                            <i class="la la-minus"></i>
                                                        </span>
                                                        <input type="number" name="quantity" value="0"
                                                            class="qty number_childrens">
                                                        <span class="plus">
                                                            <i class="la la-plus"></i>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field-select field-date">
                                        <span class="sl-icon"><i class="la la-calendar-alt"></i></span>
                                        <input type="text" placeholder="Date" class="datepicker">
                                        <i class="la la-angle-down"></i>
                                    </div>
                                    <div class="field-select has-sub field-time">
                                        <span class="sl-icon"><i class="la la-clock"></i></span>
                                        <input type="text" placeholder="Time" readonly>
                                        <i class="la la-angle-down"></i>
                                        <div class="field-sub">
                                            <ul>
                                                <li><a href="#">12:00 AM</a></li>
                                                <li><a href="#">12:30 AM</a></li>
                                                <li><a href="#">1:00 AM</a></li>
                                                <li><a href="#">1:30 AM</a></li>
                                                <li><a href="#">2:00 AM</a></li>
                                                <li><a href="#">2:30 AM</a></li>
                                                <li><a href="#">3:00 AM</a></li>
                                                <li><a href="#">3:30 AM</a></li>
                                                <li><a href="#">4:00 AM</a></li>
                                                <li><a href="#">4:30 AM</a></li>
                                                <li><a href="#">5:00 AM</a></li>
                                                <li><a href="#">5:30 AM</a></li>
                                                <li><a href="#">6:00 AM</a></li>
                                                <li><a href="#">6:30 AM</a></li>
                                                <li><a href="#">7:00 AM</a></li>
                                                <li><a href="#">7:30 AM</a></li>
                                                <li><a href="#">8:00 AM</a></li>
                                                <li><a href="#">8:30 AM</a></li>
                                                <li><a href="#">9:00 AM</a></li>
                                                <li><a href="#">9:30 AM</a></li>
                                                <li><a href="#">10:00 AM</a></li>
                                                <li><a href="#">10:30 AM</a></li>
                                                <li><a href="#">11:00 AM</a></li>
                                                <li><a href="#">11:30 AM</a></li>
                                                <li><a href="#">12:00 PM</a></li>
                                                <li><a href="#">12:30 PM</a></li>
                                                <li><a href="#">1:00 PM</a></li>
                                                <li><a href="#">1:30 PM</a></li>
                                                <li><a href="#">2:00 PM</a></li>
                                                <li><a href="#">2:30 PM</a></li>
                                                <li><a href="#">3:00 PM</a></li>
                                                <li><a href="#">3:30 PM</a></li>
                                                <li><a href="#">4:00 PM</a></li>
                                                <li><a href="#">4:30 PM</a></li>
                                                <li><a href="#">5:00 PM</a></li>
                                                <li><a href="#">5:30 PM</a></li>
                                                <li><a href="#">6:00 PM</a></li>
                                                <li><a href="#">6:30 PM</a></li>
                                                <li><a href="#">7:00 PM</a></li>
                                                <li><a href="#">7:30 PM</a></li>
                                                <li><a href="#">8:00 PM</a></li>
                                                <li><a href="#">8:30 PM</a></li>
                                                <li><a href="#">9:00 PM</a></li>
                                                <li><a href="#">9:30 PM</a></li>
                                                <li><a href="#">10:00 PM</a></li>
                                                <li><a href="#">10:30 PM</a></li>
                                                <li><a href="#">11:00 PM</a></li>
                                                <li><a href="#">11:30 PM</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="submit" name="submit" value="Request a book">
                                    <p class="note">You won't be charged yet</p>
                                </form>
                            </aside><!-- .widget-reservation -->
                        </div><!-- .sidebar -->
                    </div>
                </div>
            </div>
        </div><!-- .place -->
    </main><!-- .site-main -->
@endsection
