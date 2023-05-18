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
                            <li><a class="mb-sort mb-open" href="#sortForm">Sort</a></li>
                        </ul>
                        {{-- <div class="mb-maps"><a class="mb-maps" href="#"><i class="las la-map-marked-alt"></i></a>
                        </div> --}}
                    </div>
                    <div class="top-area top-area-filter">
                        <div class="filter-left">
                            <span class="result-count"><span class="count">{{ $churches->count() }}</span> results</span>
                            <a href="#" class="clear">Clear filter</a>
                        </div>
                        <div class="filter-center">
                            <div class="place-layout">
                                <a class="active" href="#" data-layout="layout-grid"><i
                                        class="las la-border-all icon-large"></i></a>
                                <a class="" href="#" data-layout="layout-list"><i
                                        class="las la-list icon-large"></i></a>
                            </div>
                        </div>
                        <div class="filter-right">
                            <div class="select-box">
                                <select name="sort_by" class="sort-by">
                                    <option value="">Sort by</option>
                                    <option value="newest">Newest</option>
                                    <option value="rating">Average rating</option>
                                    <option value="featured">Featured</option>
                                </select>
                                <div class="filter-control" tabindex="0">
                                    <span class="current">Sort by</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected focus">Sort by</li>
                                        <li data-value="newest" class="option">Newest</li>
                                        <li data-value="rating" class="option">Average rating</li>
                                        <li data-value="featured" class="option">Featured</li>
                                    </ul>
                                </div>
                            </div>
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
        var map, address;
        function initialize() {
            let church_address = document.querySelector('#church_address');
            let latitude = document.querySelector('#latitude');
            let longitude = document.querySelector('#longitude');

            $(document).on('click', '.pagination .page-item a', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $('#page_count').val(page);
                filterChurches(page);
            })

            $(document).on('submit', '.filterForm', function(event) {
                event.preventDefault();
                filterChurches(1);
            });

            function filterChurches(page) {
                let selected_criterias = [];

                // get all checked skills
                $.each($(".criteria:checked"), function() {
                    selected_criterias.push($(this).val());
                });

                selected_criterias = encodeURIComponent(JSON.stringify(selected_criterias));
                let filter_parameters = `church_name=${$('#church_name').val()}&church_address=${$('#church_address').val()}&latitude=${latitude.value}&longitude=${longitude.value}&criterias=${selected_criterias}`;
                $.ajax({
                    url: "churches/fetch?page="+page+'&'+filter_parameters,
                    success: function (data) {
                        $('#churches-list').html(data.view_data);
                        if(data.churches.data.length > 0) {
                            setLocations(data.churches);
                        }
                    }
                });
            }

            var mapOptions = {
                center: new google.maps.LatLng( 14.5995124, 120.9842195 ),
                zoom: 15,
                mapId: 'ad277f0b2aef047a',
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
            };

            map = new google.maps.Map(document.querySelector("#place-map-filter"), mapOptions);
            infoWindow = new google.maps.InfoWindow({
                maxWidth: 200,
            });

            let my_marker = new google.maps.Marker({
                position:  new google.maps.LatLng(Number(14.5995124), Number(120.9842195) ),
                map: map,
                draggable: true,
            })

            // for search
            let searchBox = new google.maps.places.SearchBox( church_address );

            google.maps.event.addListener( searchBox, 'places_changed', function () {
                var places = searchBox.getPlaces(), bounds = new google.maps.LatLngBounds(), i, place, lat, long, resultArray, address = places[0].formatted_address;
                lat = places[0].geometry.location.lat()
                long = places[0].geometry.location.lng();
                latitude.value = lat;
                longitude.value = long;
                resultArray =  places[0].address_components;
            });

            google.maps.event.addListener( my_marker, "dragend", function ( event ) {
                var lat, long, address, resultArray;
                var addressEl = document.querySelector( '#church_address' );
                var latEl = document.querySelector( '#latitude' );
                var longEl = document.querySelector( '#longitude' );

                lat = my_marker.getPosition().lat();
                long = my_marker.getPosition().lng();

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { latLng: my_marker.getPosition() }, function ( result, status ) {
                    if ( 'OK' === status ) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                        address = result[0].formatted_address;
                        resultArray =  result[0].address_components;
                        addressEl.value = address;
                        latEl.value = lat;
                        longEl.value = long;
                        filterChurches(1);
                    } else {
                        console.log( 'Geocode was not successful for the following reason: ' + status );
                    }

                    // Closes the previous info window if it already exists
                    if ( infoWindow ) {
                        infoWindow.close();
                    }

                    infoWindow = new google.maps.InfoWindow({
                        content: address
                    });

                    infoWindow.open( map );
                });
            });

            function setLocations(churches) {
                var mapOptions = {
                    center: new google.maps.LatLng( latitude.value, longitude.value ),
                    zoom: 13,
                    mapId: 'ad277f0b2aef047a',
                    disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                    scrollWheel: true, // If set to false disables the scrolling on the map.
                    draggable: true, // If set to false , you cannot move the map around.
                };

                map = new google.maps.Map(document.querySelector("#place-map-filter"), mapOptions);

                my_marker = new google.maps.Marker({
                    position:  new google.maps.LatLng(Number(latitude.value), Number(longitude.value) ),
                    map: map,
                    draggable: true,
                })

                google.maps.event.addListener( my_marker, "dragend", function ( event ) {
                    var lat, long, address, resultArray;
                    var addressEl = document.querySelector( '#church_address' );
                    var latEl = document.querySelector( '#latitude' );
                    var longEl = document.querySelector( '#longitude' );

                    lat = my_marker.getPosition().lat();
                    long = my_marker.getPosition().lng();


                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode( { latLng: my_marker.getPosition() }, function ( result, status ) {
                        if ( 'OK' === status ) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                            address = result[0].formatted_address;
                            resultArray =  result[0].address_components;
                            addressEl.value = address;
                            latEl.value = lat;
                            longEl.value = long;
                            filterChurches(1);
                        } else {
                            console.log( 'Geocode was not successful for the following reason: ' + status );
                        }

                        // Closes the previous info window if it already exists
                        if ( infoWindow ) {
                            infoWindow.close();
                        }

                        infoWindow = new google.maps.InfoWindow({
                            content: address
                        });
                        infoWindow.open( map );
                    });
                });

                if(churches.data.length === 0) return false;

                let total_churches = churches.data.length;
                let marker;

                for (i = 0; i <= total_churches; i++) {

                    var data = churches.data[i];
                    var myLatlng = new google.maps.LatLng(data?.latitude, data?.longitude);

                    marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        labelContent: data?.name,
                        labelAnchor: new google.maps.Point(7, 30),
                        labelClass: "labels",
                        labelInBackground: true
                    });

                    (function (marker, data) {
                            google.maps.event.addListener(marker, "click", function (e) {
                            infoWindow.setContent(`${data?.name}`);
                            infoWindow.open(map, marker);
                            });
                    })(marker, data);
                }

                if ( infoWindow ) {
                    infoWindow.close();
                }

                /**
                    * Creates the info Window at the top of the marker
                */
                // infoWindow = new google.maps.InfoWindow({
                //     content: address,
                // });

                // infoWindow.open( map, marker );
            }



        }

        // remove enter functionality in address input
        $(document).ready(function() {
            $('#church_address').keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });

    </script>
@endpush
