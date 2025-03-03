<form action="#" class="filterForm" id="filterForm">
    <input type="hidden" name="page_count" id="page_count" value="1">
    <div class="filter-head">
        <h2>Filter</h2>
        <a href="#" class="clear-filter"><i class="fal fa-sync"></i>Clear all</a>
        <a href="#" class="close-filter"><i class="las la-times"></i></a>
    </div>
    <div class="filter-box">
        <a href="{{ route('churches.searchPage') }}" class="btn btn-primary">Clear Filter</a>
    </div>
    <div class="filter-box">
        <div class="field-group field-input">
            <label for="church_name">Church Name</label>
            <input class="w-100 mt-1" type="text" id="church_name" placeholder="Ex. Saint Paul, Saint Peter"
                name="church_name">
        </div>
        <div class="suggested-churches active"></div>
    </div>
    <div class="filter-box">
        <div class="field-group field-input">
            <div class="d-flex justify-content-between align-items-center my-2">
                <label for="church_address">Church Address</label>
            </div>
            <input class="w-100 mt-1" type="text" id="church_address" placeholder="Address" name="church_address" value="{{ $queries ? $queries['address'] : null }}">
            <input type="hidden" name="latitude" id="latitude" value="{{ $queries ? $queries['latitude'] : null }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $queries ? $queries['longitude'] : null }}">
        </div>
    </div>

    <div class="filter-box">
        <div class="field-group field-select">
            <label for="radius">Radius</label>
            <select name="radius" id="radius" class="form-select" style="border: 1px solid #331f14">
                <option value="5">5km</option>
                <option value="10">10km</option>
                <option value="20">20km</option>
            </select>
        </div>
    </div>

    <div class="filter-box">
        <h3>Day</h3>
        <div class="filter-list">
            <div class="filter-group">
                <div class="field-check">
                    <label for="monday_checkbox">
                        <input type="checkbox" id="monday_checkbox" value="monday" class="day">
                            Monday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="tuesday_checkbox">
                        <input type="checkbox" id="tuesday_checkbox" value="tuesday" class="day">
                            Tuesday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="wednesday_checkbox">
                        <input type="checkbox" id="wednesday_checkbox" value="wednesday" class="day">
                            Wednesday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="thursday_checkbox">
                        <input type="checkbox" id="thursday_checkbox" value="thursday" class="day">
                            Thursday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="friday_checkbox">
                        <input type="checkbox" id="friday_checkbox" value="friday" class="day">
                            Friday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="saturday_checkbox">
                        <input type="checkbox" id="saturday_checkbox" value="saturday" class="day">
                            Saturday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
                <div class="field-check">
                    <label for="sunday_checkbox">
                        <input type="checkbox" id="sunday_checkbox" value="sunday" class="day">
                            Sunday
                        <span class="checkmark"><i class="la la-check"></i></span>
                    </label>
                </div>
            </div>
            {{-- <a href="#" class="more open-more" data-close="Close" data-more="More">More</a> --}}
        </div>
    </div>
    <div class="align-center">
        <button class="btn" type="submit" id="filter-btn">Apply</button>
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
        <button class="btn" type="submit" id="sort-btn">Apply</button>
    </div>
</form>
