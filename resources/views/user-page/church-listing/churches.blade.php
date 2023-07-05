@extends('layouts.user-layout')

@section('title', 'Churches')

@section('content')
    <main id="main" class="site-main">
        <div class="archive-city">
            <div class="col-left">
                <div class="archive-filter">
                    @include('user-page.church-listing.church-filter-form')
                </div><!-- .archive-fillter -->
                <div class="main-primary">
                    <div class="filter-mobile">
                        <ul>
                            <li><a class="mb-filter mb-open" href="#filterForm">Filter</a></li>
                        </ul>
                        <div class="mb-maps"><a class="mb-maps" href="#"><i class="las la-map-marked-alt"></i></a>
                        </div>
                    </div>
                    <div class="top-area top-area-filter">

                        <div class="filter-center">
                            <div class="place-layout">
                                <a class="active" href="#" data-layout="layout-grid">
                                    <i class="las la-border-all icon-large"></i></a>
                                <a class="" href="#" data-layout="layout-list"><i
                                        class="las la-list icon-large"></i></a>
                            </div>
                        </div>
                        <div class="filter-right">
                            <div class="show-map">
                                <span>Maps</span>
                                <a href="#" class="icon-toggle"></a>
                            </div>
                        </div>
                    </div>
                    <div id="churches-list">
                        @include('user-page.church-listing.church-data')
                    </div>
                </div><!-- .main-primary -->
            </div><!-- .col-left -->
            <div class="col-right">
                <div class="filter-head">
                    <h2>Maps</h2>
                    <a href="#" class="close-maps">Close</a>
                </div>
                <div class="entry-map">
                    <div id="place-map-filter"></div>
                </div>
            </div>
        </div><!-- .archive-city -->
    </main><!-- .site-main -->
@endsection

@push('scripts')
    <script>
        var map, address, my_marker;
        let church_address = document.querySelector('#church_address');
        let latitude = document.querySelector('#latitude');
        let longitude = document.querySelector('#longitude');

        function initialize() {

            function scrollToTop() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

            $(document).on('click', '.pagination .page-item a', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $('#page_count').val(page);
                filterChurches(page);
                scrollToTop();
            })

            $(document).on('click', '#filter-btn', function(event) {
                event.preventDefault();
                filterChurches(1);
            })

            $(document).ready(function() {
                filterChurches(1)
            });

            function filterChurches(page) {
                $('#churches-list').html('<h3 class="text-center">Searching...</h3>');
                let selected_criterias = [];
                let selected_days = [];



                // get all checked days
                $.each($(".day:checked"), function() {
                    selected_days.push($(this).val());
                });

                selected_days = encodeURIComponent(JSON.stringify(selected_days));

                let filter_parameters =
                    `church_name=${$('#church_name').val()}&church_address=${$('#church_address').val()}&latitude=${latitude.value}&longitude=${longitude.value}&days=${selected_days}`;
                $.ajax({
                    url: "churches/fetch?page=" + page + '&' + filter_parameters,
                    success: function(data) {
                        $('#churches-list').html(data.view_data);
                        if (latitude.value && longitude.value && church_address.value) {
                            setLocations(data.churches);
                        }
                    }
                });
            }

            var mapOptions = {
                center: new google.maps.LatLng(14.5995124, 120.9842195),
                zoom: 15,
                mapId: 'ad277f0b2aef047a',
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
            };

            map = new google.maps.Map(document.querySelector("#place-map-filter"), mapOptions);

            const user_icon_marker = {
                url: '../../../user-assets/images/icons/user-marker.png',
                scaledSize: new google.maps.Size(35, 45)
            }

            my_marker = new google.maps.Marker({
                position: new google.maps.LatLng(14.5995124, 120.9842195),
                map: map,
                icon: user_icon_marker,
                draggable: true,
            })

            // for search
            let searchBox = new google.maps.places.SearchBox(church_address);

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces(),
                    bounds = new google.maps.LatLngBounds(),
                    i, place, lat, long, resultArray, address = places[0].formatted_address;

                for (i = 0; place = places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    my_marker.setPosition(place.geometry.location); // Set my_marker position new.
                }

                map.fitBounds(bounds); // Fit to the bound
                map.setZoom(15); // This function sets the zoom to 15, meaning zooms to level 15.

                lat = places[0].geometry.location.lat()
                long = places[0].geometry.location.lng()
                latitude.value = lat;
                longitude.value = long;
                resultArray = places[0].address_components;
            });

            setMarkerDraggable(my_marker);

            function setLocations(churches) {

                var mapOptions = {
                    center: new google.maps.LatLng(latitude.value, longitude.value),
                    zoom: 14,
                    mapId: 'ad277f0b2aef047a',
                    disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                    scrollWheel: true, // If set to false disables the scrolling on the map.
                    draggable: true, // If set to false , you cannot move the map around.
                }

                map = new google.maps.Map(document.querySelector("#place-map-filter"), mapOptions);

                const user_icon_marker = {
                    url: '../../../user-assets/images/icons/user-marker.png',
                    scaledSize: new google.maps.Size(35, 45)
                }

                my_marker = new google.maps.Marker({
                    position: new google.maps.LatLng(Number(latitude.value), Number(longitude.value)),
                    icon: user_icon_marker,
                    map: map,
                    draggable: true,
                })

                setMarkerDraggable(my_marker);

                if (churches.data.length === 0) return false;

                let total_churches = churches.data.length;
                let marker;
                for (i = 0; i <= total_churches; i++) {

                    var data = churches.data[i];
                    var myLatlng = new google.maps.LatLng(data?.latitude, data?.longitude);

                    const churches_icon = {
                        url: '../../../user-assets/images/icons/church.png',
                        scaledSize: new google.maps.Size(35, 45)
                    }

                    marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        icon: churches_icon,
                        labelContent: data?.name,
                        labelAnchor: new google.maps.Point(7, 30),
                        labelClass: "labels",
                        labelInBackground: true
                    });

                    (function(marker, data) {
                        google.maps.event.addListener(marker, "click", function(e) {
                            infoWindow.setContent(`${data?.name}`);
                            infoWindow.open(map, marker);
                        });
                    })(marker, data);

                }
            }

            function setMarkerDraggable(my_marker) {
                google.maps.event.addListener(my_marker, "dragend", function(event) {
                    var lat, long, address, resultArray;
                    var addressEl = document.querySelector('#church_address');
                    var latEl = document.querySelector('#latitude');
                    var longEl = document.querySelector('#longitude');

                    lat = my_marker.getPosition().lat();
                    long = my_marker.getPosition().lng();


                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        latLng: my_marker.getPosition()
                    }, function(result, status) {
                        if ('OK' ===
                            status
                        ) { // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                            address = result[0].formatted_address;
                            resultArray = result[0].address_components;
                            addressEl.value = address;
                            latEl.value = lat;
                            longEl.value = long;
                            filterChurches(1);
                        } else {
                            console.log('Geocode was not successful for the following reason: ' +
                                status);
                        }
                    });

                    $('.close-maps').click();
                });
            }
        }

        initialize()

        // remove enter functionality in address input
        $(document).ready(function() {
            $('#church_address').keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endpush
