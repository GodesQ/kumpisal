@extends('layouts.user-layout')

@section('title', 'Kumpisalan')

@section('content')
    <main id="main" class="site-main overflow">
        <div class="site-banner" style="background-image: url(user-assets/images/bg/top-banner.png);">
            <div class="container">
                <div class="site-banner__content">
                    <h1 class="site-banner__title">Explore the world</h1>
                    <form action="#" class="site-banner__search layout-02">
                        <div class="field-input">
                            <label for="s">Find</label>
                            <input class="site-banner__search__input open-suggestion" id="s" type="text"
                                name="s" placeholder="Ex: fastfood, beer" autocomplete="off">
                            <div class="search-suggestions name-suggestions">
                                <ul>
                                    <li><a href="#"><i class="las la-utensils"></i><span>Restaurant</span></a></li>
                                    <li><a href="#"><i class="las la-spa"></i><span>Beauty</span></a></li>
                                    <li><a href="#"><i class="las la-dumbbell"></i><span>Fitness</span></a></li>
                                    <li><a href="#"><i class="las la-cocktail"></i><span>Nightlight</span></a></li>
                                    <li><a href="#"><i class="las la-shopping-bag"></i><span>Shopping</span></a></li>
                                    <li><a href="#"><i class="las la-film"></i><span>Cinema</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-input">
                            <label for="loca">Where</label>
                            <input class="site-banner__search__input open-suggestion" id="loca" type="text"
                                name="where" placeholder="Your city" autocomplete="off">
                            <div class="search-suggestions location-suggestions">
                                <ul>
                                    <li><a href="#"><i class="las la-location-arrow"></i><span>Current
                                                location</span></a></li>
                                    <li><a href="#"><span>San Francisco, CA</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .site-banner__search__input -->
                        <div class="field-submit">
                            <button><i class="las la-search la-24-black"></i></button>
                        </div>
                    </form><!-- .site-banner__search -->
                    <p class="site-banner__meta">
                        <span>Popular:</span>
                        <a title="London" href="city-details-1.html">London</a>
                        <a title="Paris" href="city-details-1.html">Paris</a>
                        <a title="Chicago" href="city-details-1.html">Chicago</a>
                    </p><!-- .site-banner__meta -->
                </div><!-- .site-banner__content -->
            </div>
        </div><!-- .site-banner -->
        <div class="cities">
            <div class="container">
                <h2 class="cities__title title offset-item">Popular cities</h2>
                <div class="cities__content offset-item">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="London" href="city-details-3.html">
                                        <img src="/user-assets/images/city/tokyo.jpeg" alt="Tokyo">
                                    </a>
                                </div>
                                <h4 class="cities__name">Japan</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Tokyo</h3>
                                    <p class="cities__number">80 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="Barca" href="city-details-3.html">
                                        <img src="/user-assets/images/city/barca.jpeg" alt="Barca">
                                    </a>
                                </div>
                                <h4 class="cities__name">Spain</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Barca</h3>
                                    <p class="cities__number">92 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="New York" href="city-details-3.html">
                                        <img src="/user-assets/images/city/newyork.jpg" alt="New York">
                                    </a>
                                </div>
                                <h4 class="cities__name">United States</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">New York</h3>
                                    <p class="cities__number">64 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="Paris" href="city-details-3.html">
                                        <img src="/user-assets/images/city/paris.jpg" alt="Paris">
                                    </a>
                                </div>
                                <h4 class="cities__name">France</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Paris</h3>
                                    <p class="cities__number">23 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="Amsterdam" href="city-details-3.html">
                                        <img src="/user-assets/images/city/amsterdam.jpg" alt="Amsterdam">
                                    </a>
                                </div>
                                <h4 class="cities__name">Netherlands</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Amsterdam</h3>
                                    <p class="cities__number">44 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="Singapo" href="city-details-3.html">
                                        <img src="/user-assets/images/city/singapo.jpg" alt="Singapo">
                                    </a>
                                </div>
                                <h4 class="cities__name">Singapo</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Singapo</h3>
                                    <p class="cities__number">60 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="Sydney" href="city-details-3.html">
                                        <img src="/user-assets/images/city/sydney.jpg" alt="Sydney">
                                    </a>
                                </div>
                                <h4 class="cities__name">Australia</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Sydney</h3>
                                    <p class="cities__number">36 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="cities__item hover__box">
                                <div class="cities__thumb hover__box__thumb">
                                    <a title="angeles" href="city-details-3.html">
                                        <img src="/user-assets/images/city/angeles.jpeg" alt="angeles">
                                    </a>
                                </div>
                                <h4 class="cities__name">United States</h4>
                                <div class="cities__info">
                                    <h3 class="cities__capital">Angeles</h3>
                                    <p class="cities__number">44 places</p>
                                </div>
                            </div><!-- .cities__item -->
                        </div>

                    </div>
                </div><!-- .cities__content -->
            </div>
        </div><!-- .cities -->
        <div class="banner-apps" style="background-image: url(images/bg/bg-app-1.jpg);">
            <div class="container">
                <div class="banner-apps__content">
                    <h2 class="banner-apps__title offset-item">Get the App</h2>
                    <p class="banner-apps__desc offset-item">Download the app and go to travel the world.</p>
                    <div class="banner-apps__download offset-item">
                        <a title="App Store" href="#" class="banner-apps__download__iphone"><img
                                src="images/assets/app-store.png" alt="App Store"></a>
                        <a title="Google Play" href="#" class="banner-apps__download__android"><img
                                src="images/assets/google-play.png" alt="Google Play"></a>
                    </div>
                </div>
            </div>
        </div><!-- .banner-apps -->
        <div class="news">
            <div class="container">
                <h2 class="news__title title title--more offset-item">
                    Related stories
                    <a title="View more" href="#">
                        View more
                        <i class="la la-angle-right"></i>
                    </a>
                </h2>
                <div class="news__content offset-item">
                    <div class="row">
                        <div class="col-md-4">
                            <article class="post hover__box">
                                <div class="post__thumb hover__box__thumb">
                                    <a title="The 8 Most Affordable Michelin Restaurants in Paris"
                                        href="blog-detail.html"><img src="images/blog/thumb-01.jpg"
                                            alt="The 8 Most Affordable Michelin Restaurants in Paris"></a>
                                </div>
                                <div class="post__info">
                                    <ul class="post__category">
                                        <li><a title="Paris" href="02_city-details_1.html">Paris</a></li>
                                        <li><a title="Food" href="02_city-details_1.html">Food</a></li>
                                    </ul>
                                    <h3 class="post__title"><a title="The 8 Most Affordable Michelin Restaurants in Paris"
                                            href="blog-detail.html">The 8 Most Affordable Michelin Restaurants in Paris</a>
                                    </h3>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-4">
                            <article class="post hover__box">
                                <div class="post__thumb hover__box__thumb">
                                    <a title="The 7 Best Restaurants to Try Kobe Beef in London"
                                        href="blog-detail.html"><img src="images/blog/thumb-05.jpg"
                                            alt="The 7 Best Restaurants to Try Kobe Beef in London"></a>
                                </div>
                                <div class="post__info">
                                    <ul class="post__category">
                                        <li><a title="London" href="02_city-details_1.html">London</a></li>
                                        <li><a title="Art & Decor" href="02_city-details_1.html">Art & Decor</a></li>
                                    </ul>
                                    <h3 class="post__title"><a title="The 7 Best Restaurants to Try Kobe Beef in London"
                                            href="blog-detail.html">The 7 Best Restaurants to Try Kobe Beef in London</a>
                                    </h3>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-4">
                            <article class="post hover__box">
                                <div class="post__thumb hover__box__thumb">
                                    <a title="The 8 Most Affordable Michelin Restaurants in Paris"
                                        href="blog-detail.html"><img src="images/blog/thumb-08.jpg"
                                            alt="The 8 Most Affordable Michelin Restaurants in Paris"></a>
                                </div>
                                <div class="post__info">
                                    <ul class="post__category">
                                        <li><a title="Paris" href="02_city-details_1.html">Paris</a></li>
                                        <li><a title="Stay" href="02_city-details_1.html">Stay</a></li>
                                    </ul>
                                    <h3 class="post__title"><a title="The 8 Most Affordable Michelin Restaurants in Paris"
                                            href="blog-detail.html">The 9 Best Cheap Hotels in New York City</a></h3>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .news -->
    </main><!-- .site-main -->
@endsection
