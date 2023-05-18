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
