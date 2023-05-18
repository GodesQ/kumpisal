<form action="#" class="filterForm" id="filterForm">
    <input type="hidden" name="page_count" id="page_count" value="1">
    <div class="filter-head">
        <h2>Filter</h2>
        <a href="#" class="clear-filter"><i class="fal fa-sync"></i>Clear all</a>
        <a href="#" class="close-filter"><i class="las la-times"></i></a>
    </div>
    <div class="filter-box">
        <div class="field-group field-input">
            <label for="church_name">Church Name</label>
            <input class="w-100 mt-1" type="text" id="church_name" placeholder="What the name of place"
                name="church_name">
        </div>
    </div>
    <div class="filter-box">
        <div class="field-group field-input">
            <label for="church_address">Church Address</label>
            <input class="w-100 mt-1" type="text" id="church_address" placeholder="What the name of place" name="church_address">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>
    </div>
    <div class="filter-box">
        <h3>Criteria</h3>
        <div class="filter-list">
            <div class="filter-group">
                <div class="field-check">
                    <label for="new_york">
                        <input type="checkbox" id="new_york" value="diocese" class="criteria">
                            Diocese
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="london">
                        <input type="checkbox" id="london" value="vicariate" class="criteria">
                            Vicariate
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
            </div>
            {{-- <a href="#" class="more open-more" data-close="Close" data-more="More">More</a> --}}
        </div>
    </div>
    <div class="align-center">
        <button class="btn" type="submit">Apply</button>
    </div>
</form>
<form action="#" class="sortForm" id="sortForm">
    <div class="filter-head">
        <h2>Sort</h2>
        <a href="#" class="clear-filter">Clear filter</a>
        <a href="#" class="close-filter"><i class="las la-times"></i></a>
    </div>
    <div class="filter-box">
        <h3>Sort by</h3>
        <div class="filter-list">
            <div class="field-check">
                <label for="newest">
                    <input type="checkbox" id="newest" value="">
                    Newest
                    <span class="checkmark"><i class="la la-check"></i></span>
                </label>
            </div>
            <div class="field-check">
                <label for="featured">
                    <input type="checkbox" id="featured" value="">
                    Featured
                    <span class="checkmark"><i class="la la-check"></i></span>
                </label>
            </div>
            {{-- <a href="#" class="more open-more" data-close="Close" data-more="More">More</a> --}}
        </div>
    </div>
    <div class="form-button align-center">
        <button class="btn" type="submit">Apply</button>
    </div>
</form>

@push('scripts')
    <script>
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
                    }
                });
            }

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
        }

        // window.addEventListener('load', () => {
        //     initialize();
        // })

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
