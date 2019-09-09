@extends('layouts.master')
@section('style')

<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/mini-cart.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
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
    <div class="home-main-content">
        <div class="container">
            <div class="stores">
                <h2 class="heading-tittle">{{ __('messages.store') }}</h3>
                <ul class="list-tab">
                    <li class="tab-item">
                        <a href="#store-seller" class="item-link active">BestSeller</a>
                    </li>
                    <li class="tab-item">
                        <a href="#store-rating" class="item-link">Rating</a>
                    </li>
                </ul>

                <div class="store-content">
                    <div class="stores-wrapper is-selected" id="store-seller">
                        <div class="row">
                            @foreach( $storeSale as $store )
                            <div class="col-md-3 product-men">
                                <div class="store-item item-pro">
                                    <div class="men-thumb-item">
                                        <a href="/store/{{ $store->slug }}">
                                            @foreach ( $store->media->where( 'active', 1 ) as $logo )
                                            <img src="{{ $logo->image_path }}" alt="Image Product">
                                            @endforeach
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

                    <div class="stores-wrapper" id="store-rating">
                        <div class="row">
                            @foreach( $storeRating as $store )
                            <div class="col-md-3 product-men">
                                <div class="store-item item-pro">
                                    <div class="men-thumb-item">
                                        <a href="/store/{{ $store->slug }}">
                                            @foreach ( $store->media->where( 'active', 1 ) as $logo )
                                            <img src="{{ $logo->image_path }}" alt="Image Product">
                                            @endforeach
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


            </div>
            <div class="products">
                <div class="wrapper">
                    <div class="product-wrapper row">
                        <h3 class="heading-tittle col-md-12">{{ __('messages.new_product') }}</h3>

                            @foreach( $new as $product )
                            <div class="col-md-3 product-men">
                                <div class="men-pro-item item-pro">
                                    <div class="men-thumb-item">
                                        <a href="/products/{{ $product->slug }}">
                                            @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                            <img src="{{ $logo->image_path }}" alt="Image Product">
                                            @endforeach
                                        </a>
                                        <div class="add-to-cart-wrapper">
                                            <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                @guest
                                                <button class="user-login">{{ __('messages.add_to_cart') }}</button>
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
                                            <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}<span class="currency">$</span></span>
                                            <del>{{ $product->usd }}<span class="currency">$</span></del>
                                            @else
                                            <span class="item_price">{{ $product->usd }}<span class="currency">$</span></span>
                                            @endif
                                        </div>
                                        @endif
                                        @if( app()->getLocale() == 'vi' )
                                        <div class="info-product-price">
                                            @if( $product->on_sale != 0 )
                                            <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}<span class="currency">đ</span></span>
                                            <del>{{ $product->vnd }}<span class="currency">đ</span></del>
                                            @else
                                            <span class="item_price">{{ $product->vnd }}<span class="currency">đ</span></span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach

                    </div>

                    <div class="product-wrapper row">
                        <h3 class="heading-tittle col-md-12">{{ __('messages.bestseller') }}</h3>
                        @foreach( $bestSeller as $product )
                        <div class="col-md-3 product-men">
                            <div class="men-pro-item item-pro">
                                <div class="men-thumb-item">
                                    <a href="/products/{{ $product->slug }}">
                                    @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                    <img src="{{ $logo->image_path }}" alt="Image Product">
                                    @endforeach
                                    </a>
                                    <div class="add-to-cart-wrapper">
                                        <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                            <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                            <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                            @guest
                                            <button class="user-login">{{ __('messages.add_to_cart') }}</button>
                                            @else
                                            <button type="submit" class="button btn-add-to-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
                                            @endguest
                                        </form>
                                    </div>
                                </div>
                                <div class="item-info-product ">
                                    <h4 class="item-name">
                                    <a href="/products/{{ $product->slug }}">{{ $product->name }}</a>
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
                                        <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}<span class="currency">$</span></span>
                                        <del>{{ $product->usd }}<span class="currency">$</span></del>
                                        @else
                                        <span class="item_price">{{ $product->usd }}<span class="currency">$</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    @if( app()->getLocale() == 'vi' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}<span class="currency">đ</span></span>
                                        <del>{{ $product->vnd }}<span class="currency">đ</span></del>
                                        @else
                                        <span class="item_price">{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- //third section (oils) -->
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('js')
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/home/slider.js') }}"></script>
<script src="{{ asset('js/home/add-to-cart.js') }}"></script>
<script src="{{ asset('js/home/delete-cart.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
<script src="{{ asset('js/home/tab.js') }}"></script>
@endsection


