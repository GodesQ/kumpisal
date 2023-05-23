@extends('layouts.user-layout')

@section('title')
    {{ $church->name }}
@endsection

@section('content')
    <main id="main" class="site-main single single-02">
            <input type="hidden" id="latitude" value="{{ $church->latitude }}" >
            <input type="hidden" id="longitude" value="{{ $church->longitude }}" >
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
                                    {{ $church->address }}
                                    {{-- <a href="#" title="Direction">(Direction)</a> --}}
                                </div>
                            </div><!-- .place__box -->
                            <div class="place__box">
                                <h3>Contact Info</h3>
                                <ul class="place__contact">
                                    <li>
                                        @if($church->contact_number)
                                            <i class="la la-phone"></i>
                                            <a title="{{ $church->contact_number }}" href="tel:{{$church->contact_number}}">{{ $church->contact_number }}</a>
                                        @endif
                                    </li>
                                    {{-- <li>
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
                                    </li> --}}
                                </ul>
                            </div><!-- .place__box -->
                            <div class="place__box place__box-open">
                                <h3 class="place__title--additional">
                                    Confession Schedules
                                </h3>
                                <table class="open-table">
                                    <tbody>
                                        @forelse ($church->schedules as $schedule)
                                            <tr>
                                                <td class="day">{{ date_format(new DateTime($schedule->schedule_time), 'F d, Y') }}</td>
                                                <td class="time">{{ date_format(new DateTime($schedule->started_time), 'g:i A') }} - {{ date_format(new DateTime($schedule->end_time), 'g:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No Schedules Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div><!-- .place__box -->
                        </div><!-- .place__left -->
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar sidebar--shop sidebar--border">
                            <div class="widget-reservation-mini">
                                <h3>Make a Schedule</h3>
                                <a href="#" class="open-wg btn">Request</a>
                            </div>
                            <aside class="widget widget-shadow widget-reservation">
                                <h3>Make a Schedule</h3>
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
                                </form>
                            </aside><!-- .widget-reservation -->
                        </div><!-- .sidebar -->
                    </div>
                </div>
            </div>
        </div><!-- .place -->
    </main><!-- .site-main -->
@endsection

@push('scripts')
    <script>
        function initialize() {
            let latitude = document.querySelector('#latitude');
            let longitude = document.querySelector('#longitude');
            var mapOptions = {
                center: latitude.value && longitude.value ? new google.maps.LatLng( latitude.value, longitude.value ) : new google.maps.LatLng( 14.5995124, 120.9842195 ),
                zoom: 14,
                mapId: 'ad277f0b2aef047a',
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
            };

            map = new google.maps.Map(document.querySelector("#map"), mapOptions);
            infoWindow = new google.maps.InfoWindow({
                maxWidth: 200,
            });

            const user_icon_marker = {
                url: '../../../user-assets/images/icons/user-marker.png',
                scaledSize: new google.maps.Size(35, 45)
            }

            if(latitude.value && longitude.value) {
                let my_marker = new google.maps.Marker({
                    position:  new google.maps.LatLng(new google.maps.LatLng( Number(latitude.value), Number(longitude.value) )),
                    map: map,
                    icon: user_icon_marker,
                    draggable: true,
                })
            }

        }
    </script>
@endpush
