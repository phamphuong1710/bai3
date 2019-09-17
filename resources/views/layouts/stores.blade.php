@extends('layouts.master')
@section('style')

<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="font-page page-content">

    <section class="home-main-content">
        <div class="container">
            <div class="row">
                <div class="sidebar col-md-3">
                    <div class="search-product sidebar-widget">
                        <h3 class="widget-title">{{ __('messages.search_product') }}</h3>
                        <form action="/search/product" method="post" class="form-search-sidebar">
                            @csrf
                            <input type="search" placeholder="Product name..." name="search" required class="input-search-sidebar">
                            <button type="submit" class="btn btn-search ion-android-search" aria-label="Left Align">
                            </button>
                        </form>
                    </div>

                    <!-- reviews -->
                    <div class="customer-rev left-side sidebar-widget">
                        <h3 class="widget-title">{{ __('messages.store_rating') }}</h3>
                        <ul class="list-rating">
                            <li class="item-filter">
                                <div class="filter-star">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                </div>
                                <input type="checkbox" name="rating" class="rating-sidebar-input" value="5">
                                <span class="filter-label"></span>
                            </li>
                            <li class="item-filter">
                                <div class="filter-star">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                </div>
                                <input type="checkbox" name="rating" class="rating-sidebar-input" value="4">
                                <span class="filter-label"></span>
                            </li>

                            <li class="item-filter">
                                <div class="filter-star">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                </div>
                                <input type="checkbox" name="rating" class="rating-sidebar-input" value="3">
                                <span class="filter-label"></span>
                            </li>
                            <li class="item-filter">
                                <div class="filter-star">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                </div>
                                <input type="checkbox" name="rating" class="rating-sidebar-input" value="2">
                                <span class="filter-label"></span>
                            </li>
                        </ul>
                    </div>
                    <!-- //reviews -->
                    <!-- discounts -->
                    <div class="left-side  sidebar-widget">
                        <h3 class="widget-title">{{ __('messages.discount') }}</h3>
                        <ul class="list-discount">

                            <li class="discount-item item-filter">
                                20% or More
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="20">
                                    <span class="filter-label"></span>
                                </a>
                            </li>
                            <li class="discount-item item-filter">
                                30% or More
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="30">
                                <span class="filter-label"></span>
                            </li>
                            <li class="discount-item item-filter">
                                40% or More
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="40">
                                    <span class="filter-label"></span>
                            </li>
                            <li class="discount-item item-filter">
                                50% or More
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="50">
                                    <span class="filter-label"></span>
                            </li>

                        </ul>
                    </div>
                    <!-- //discounts -->


                    <!-- //deals -->
                </div>
                <div id="primary" class="content-page col-md-9">
                    <div class="stores">
                        <h2 class="heading-tittle">{{ __('messages.store') }}</h2>

                        <div class="store-content">
                                <div class="row ajax-store-scroll justify-content-center">
                                    @foreach( $stores as $store )
                                    <div class="col-md-4 product-men">
                                        <div class="store-item item-pro">
                                            <div class="men-thumb-item">
                                                <a href="/store/{{ $store->slug }}">
                                                    <img src="{{ $store->logo }}" alt="{{ $store->name }}">
                                                </a>
                                            </div>
                                            <div class="item-info-store ">
                                                <h4 class="item-name">
                                                <a href="/store/{{ $store->slug }}">{{ Str::words($store->name, 3) }}</a>
                                                </h4>
                                                <span class="store-address">
                                                    {{  Str::words($store->address, 4) }}
                                                </span>
                                                @php
                                                    $avg = $store->rating_average;
                                                    $p = ( $avg / 5 ) * 100;
                                                @endphp
                                                <div class="wt-star-rating">
                                                    <span class="star-reviewed" style="width: {{ $p }}%">
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

</div>



@endsection
@section('js')
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/home/slider.js') }}"></script>
<script src="{{ asset('js/home/add-to-cart.js') }}"></script>
<script src="{{ asset('js/home/delete-cart.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
<script src="{{ asset('js/home/tab.js') }}"></script>
<script src="{{ asset('js/home/filter-discount.js') }}"></script>
<script src="{{ asset('js/home/filter-rating.js') }}"></script>
<script src="{{ asset('js/home/load-more-store.js') }}"></script>
@endsection

