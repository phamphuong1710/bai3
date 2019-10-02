@extends('layouts.master')
@section('style')

<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="font-page page-content">

    <section class="slideshow" id="slideshow">
        <div class="slider-content slider-hero" id="slider-hero">
        @foreach( $slider as $slide )

            <div class="slider-item" style="background-image: url({{$slide->media->image_path}});">

                <div class="caption container">
                    <span class="caption-title">{{ $slide->store->name }}</span>
                    <a href="/store/{{ $slide->store->slug }}" class="btn-watch">

                        <span class="btn-default">{{ __('messages.shop_now') }}</span>
                        <span class="text-hover">{{ __('messages.shop_now') }}</span>
                        <span class="btn-hover"></span>
                    </a>
                </div>
            </div>

        @endforeach
        </div>


        <span class="btn-slide-prev">
            <span class="default ion-ios-arrow-back"></span>
            <span class="hover ion-ios-arrow-back"></span>
        </span>
        <span class="btn-slide-next">
            <span class="default ion-ios-arrow-forward"></span>
            <span class="hover ion-ios-arrow-forward"></span>
        </span>

    </section>
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
                                20%
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="20">
                                    <span class="filter-label"></span>
                                </a>
                            </li>
                            <li class="discount-item item-filter">
                                30%
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="30">
                                <span class="filter-label"></span>
                            </li>
                            <li class="discount-item item-filter">
                                40%
                                <input type="checkbox" name="discount" class="discount-sidebar-input" value="40">
                                    <span class="filter-label"></span>
                            </li>
                            <li class="discount-item item-filter">
                                50%
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
                        <ul class="list-tab">
                            <li class="tab-item">
                                <a href="#store-seller" class="item-link active">{{ __('messages.rating') }}</a>
                            </li>
                            <li class="tab-item">
                                <a href="#store-rating" class="item-link">{{ __('messages.bestseller') }}</a>
                            </li>
                        </ul>

                        <div class="store-content">
                            <div class="stores-wrapper is-selected" id="store-seller">
                                <div class="row">
                                    @foreach( $storeSale as $store )
                                    <div class="col-md-4 product-men">
                                        <div class="store-item item-pro">
                                            <div class="men-thumb-item">
                                                <a href="/store/{{ $store->slug }}">
                                                    <img src="{{ $store->logo->image_path }}" alt="{{ $store->name }}">
                                                </a>
                                            </div>
                                            <div class="item-info-store ">
                                                <h4 class="item-name">
                                                <a href="/store/{{ $store->slug }}">{{ Str::words($store->name, 3) }}</a>
                                                </h4>
                                                <span class="store-address">
                                                    {{  Str::words($store->address->address, 4) }}
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

                            <div class="stores-wrapper" id="store-rating">
                                <div class="row">
                                    @foreach( $storeRating as $store )
                                    <div class="col-md-4 product-men">
                                        <div class="store-item item-pro">
                                            <div class="men-thumb-item">
                                                <a href="/store/{{ $store->slug }}">
                                                    <img src="{{ $store->logo->image_path }}" alt="{{ $store->name }}">
                                                </a>
                                            </div>
                                            <div class="item-info-product ">
                                                <h4 class="item-name">
                                                <a href="/store/{{ $store->slug }}">{{ Str::words($store->name, 3) }}</a>
                                                </h4>
                                                <span class="store-address">
                                                    {{  Str::words($store->address->address, 4) }}
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

                        <a href="{{ route( 'all-store' ) }}" class="btn-all-store">
                            {{ __('messages.all_store') }}
                        </a>
                    </div>
                        <div class="products">
                            <div class="wrapper">
                                <div class="container">
                                    <div class="product-wrapper row">
                                        <h3 class="heading-tittle col-md-12">{{ __('messages.new_product') }}</h3>

                                            @foreach( $new as $product )
                                            <div class="col-md-4 product-men">
                                                <div class="men-pro-item item-pro">
                                                    <div class="men-thumb-item">
                                                        <a href="/products/{{ $product->slug }}">

                                                            <img src="{{ $product->logo->image_path }}" alt="{{ $product->name }}">
                                                        </a>
                                                        <?php if ( $product->on_sale != 0 ): ?>
                                                            <span class="product-discount">{{ $product->on_sale . '%' }}</span>
                                                        <?php endif ?>

                                                        <div class="add-to-cart-wrapper">
                                                            <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                                @guest
                                                                <button class="user-login btn-add-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
                                                                @else
                                                                <button type="submit" class="button btn-add-to-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
                                                                @endguest
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="item-info-product ">
                                                        <h4 class="item-name">
                                                        <a href="/products/{{ $product->slug }}">{{ Str::words($product->name, 3) }}</a>
                                                        </h4>
                                                        @php
                                                            $avg = $product->rating_average;
                                                            $p = ( $avg / 5 ) * 100;
                                                        @endphp
                                                        <div class="wt-star-rating">
                                                            <span class="star-reviewed" style="width: {{ $p }}%">
                                                            </span>
                                                        </div>
                                                        @if( app()->getLocale() == 'en' )
                                                        <div class="info-product-price">

                                                            @if( $product->on_sale != 0 )
                                                                @php
                                                                    $price = $product->usd - ( $product->on_sale / 100 * $product->usd )
                                                                @endphp
                                                            <del>
                                                                <span class="currency">$</span>{{ number_format($product->usd,2,'.','.') }}
                                                            </del>
                                                            <span class="item_price item-sale">
                                                                <span class="currency">$</span>{{ number_format($price,2,'.','.') }}
                                                            </span>

                                                            @else
                                                            <span class="item_price">
                                                                <span class="currency">$</span>{{ number_format($product->usd,2,'.','.') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if( app()->getLocale() == 'vi' )
                                                        <div class="info-product-price">
                                                            @if( $product->on_sale != 0 )
                                                                @php
                                                                    $price = $product->vnd - ( $product->on_sale / 100 * $product->vnd )
                                                                @endphp
                                                            <span class="item_price">
                                                                <span class="currency">đ</span>{{ number_format($price,0,'.','.') }}
                                                            </span>
                                                            <del>
                                                                <span class="currency">đ</span>{{ number_format($product->vnd,0,'.','.') }}
                                                            </del>
                                                            @else
                                                            <span class="item_price">
                                                                <span class="currency">đ</span>{{ number_format($product->vnd,0,'.','.') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                    </div>
                                </div>

                                <div class="section-support">
                                    <div class="container">
                                        <div class="support-wrapper">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="support-item">
                                                        <img src="{{ asset('images/freeship.png') }}" alt="Track Order">
                                                        <h5 class="support-title">Track Your Order</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="support-item">
                                                        <img src="{{ asset('images/spencial.png') }}" alt="Track Order">
                                                        <h5 class="support-title">SPECIAL DISSCOUNT</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="support-item">
                                                        <img src="{{ asset('images/support.png') }}" alt="Track Order">
                                                        <h5 class="support-title">SUPPORT CUSTOMER</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">

                                    <div class="product-wrapper row">
                                        <h3 class="heading-tittle col-md-12">{{ __('messages.bestseller') }}</h3>
                                        @foreach( $bestSeller as $product )
                                            <div class="col-md-4 product-men">
                                                <div class="men-pro-item item-pro">
                                                    <div class="men-thumb-item">
                                                        <a href="/products/{{ $product->slug }}">

                                                            <img src="{{ $product->logo->image_path }}" alt="{{ $product->name }}">
                                                        </a>
                                                        <?php if ( $product->on_sale != 0 ): ?>
                                                            <span class="product-discount">{{ $product->on_sale . '%' }}</span>
                                                        <?php endif ?>

                                                        <div class="add-to-cart-wrapper">
                                                            <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                                @guest
                                                                <button class="user-login btn-add-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
                                                                @else
                                                                <button type="submit" class="button btn-add-to-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
                                                                @endguest
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="item-info-product ">
                                                        <h4 class="item-name">
                                                        <a href="/products/{{ $product->slug }}">{{ Str::words($product->name, 3) }}</a>
                                                        </h4>
                                                        @php
                                                            $avg = $product->rating_average;
                                                            $p = ( $avg / 5 ) * 100;
                                                        @endphp
                                                        <div class="wt-star-rating">
                                                            <span class="star-reviewed" style="width: {{ $p }}%">
                                                            </span>
                                                        </div>
                                                        @if( app()->getLocale() == 'en' )
                                                        <div class="info-product-price">

                                                            @if( $product->on_sale != 0 )
                                                                @php
                                                                    $price = $product->usd - ( $product->on_sale / 100 * $product->usd )
                                                                @endphp
                                                                <del>
                                                                <span class="currency">$</span>{{ number_format($product->usd,2,'.','.') }}</del>
                                                                <span class="item_price">
                                                                    <span class="currency">$</span>{{ number_format($price,2,'.','.') }}
                                                                </span>

                                                            @else
                                                            <span class="item_price">
                                                                <span class="currency">$</span>{{ number_format($product->usd,2,'.','.') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if( app()->getLocale() == 'vi' )
                                                        <div class="info-product-price">
                                                            @if( $product->on_sale != 0 )
                                                                @php
                                                                    $price = $product->vnd - ( $product->on_sale / 100 * $product->vnd )
                                                                @endphp
                                                            <del>
                                                                <span class="currency">đ</span>{{ number_format($product->vnd,0,'.','.') }}
                                                            </del>
                                                            <span class="item_price item-sale">
                                                                <span class="currency">đ</span>{{ number_format($price,0,'.','.') }}
                                                            </span>

                                                            @else
                                                            <span class="item_price">
                                                                <span class="currency">đ</span>{{ number_format($product->vnd,0,'.','.') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- //third section (oils) -->
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
@endsection


