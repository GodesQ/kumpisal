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
                            {{-- <div class="show-map">
                                <span>Maps</span>
                                <a href="#" class="icon-toggle"></a>
                            </div><!-- .show-map --> --}}
                        </div>
                    </div>
                    <div id="churches-list">
                        @include('user-page.church-listing.church-data')
                    </div>
                </div><!-- .main-primary -->
            </div><!-- .col-left -->
            {{-- <div class="col-right">
                <div class="filter-head">
                    <h2>Maps</h2>
                    <a href="#" class="close-maps">Close</a>
                </div>
                <div class="entry-map">
                    <div id="place-map-filter"></div>
                </div>
            </div> --}}
        </div><!-- .archive-city -->
    </main><!-- .site-main -->
@endsection
