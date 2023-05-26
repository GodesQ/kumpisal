@extends('layouts.user-layout')

@section('title')
    {{ $church->name }}
@endsection

@section('content')
    <main id="main" class="site-main single single-02">
            <input type="hidden" id="latitude" value="{{ $church->latitude }}" >
            <input type="hidden" id="longitude" value="{{ $church->longitude }}" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 order-md-2">
                        <img class="mb-2" src="{{ asset('admin-assets/images/churches' . '/' . $church->church_image) }}" alt="slider-01" style="height: 450px; width: 100%; object-fit: cover;"></a>
                    </div>
                    <div class="col-lg-4 order-md-1">
                        <table class="open-table table">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid rgb(61, 61, 61) !important; text-align: center;" colspan="2">Confession Schedules</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']; ?>
                                @foreach ($days as $day)
                                    <tr>
                                        <td style="border: 1px solid rgb(61, 61, 61) !important;" align="center" class="day">
                                            {{ Str::ucfirst($day) }}
                                        </td>
                                        <td style="border: 1px solid rgb(61, 61, 61) !important;" align="center" class="time">
                                            @if(!$church->{'has_' . $day . '_sched'})
                                                Not Available
                                            @else
                                                <?php
                                                    $dayEntries = array_filter($church->schedules->toArray(), function ($schedule) use ($day) {
                                                        return $schedule['day'] === $day;
                                                    });

                                                    usort($dayEntries, function ($a, $b) {
                                                        return strtotime($a['start_time']) - strtotime($b['start_time']);
                                                    });
                                                ?>
                                                @forelse ($dayEntries as $sched)
                                                    <div>
                                                        {{ date_format(new DateTime($sched['start_time']), 'h:i A') . ' - ' . date_format(new DateTime($sched['end_time']), 'h:i A') }}
                                                    </div>
                                                @empty
                                                    Time Not Found
                                                @endforelse
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="place__left">
                            <div class="place__box--npd mt-3">
                                <h1>{{ $church->name }}</h1>
                            </div><!-- .place__box -->
                            <hr>
                            <div class="place__box place__box-overview">
                                <h3>Overview</h3>
                                <div class="place__desc">{{ $church->description }}</div><!-- .place__desc -->
                                <a href="#" class="show-more" title="Show More">Show More</a>
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
                        </div><!-- .place__left -->
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
                zoom: 16,
                mapId: 'ad277f0b2aef047a',
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
            };

            map = new google.maps.Map(document.querySelector("#map"), mapOptions);


            const user_icon_marker = {
                url: '../../../user-assets/images/icons/church.png',
                scaledSize: new google.maps.Size(35, 45)
            }

            if(latitude.value && longitude.value) {
                let my_marker = new google.maps.Marker({
                    position:  new google.maps.LatLng(new google.maps.LatLng( Number(latitude.value), Number(longitude.value) )),
                    map: map,
                    icon: user_icon_marker,
                    draggable: false,
                })
            }

        }
    </script>
@endpush
