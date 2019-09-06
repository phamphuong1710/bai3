@extends('layouts.master')
@section('style')
<link href="{{ asset('css/ionicon.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/store.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/comment.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/mini-cart.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="single-product">
    <div class="single-page-header">
        <div class="breadcrumb-app">
            <div class="container">
                <ul class="breadcrumb-nav">
                    <li class="crumb">
                        <a href="/">{{ __('messages.home') }}</a>
                    </li>

                    <li class="crumb">
                        <span>{{ $store->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

        <div class="wrapper store-wrapper">

            <div class="container">
                <div class="logo-wrapper">
                    <img src="{{ url('/').$store->media->where('active', 1)->first()->image_path }}" alt="">
                </div>
                <div class="store-summary">
                    <h1 class="title store-name">{{ $store->name }}</h1>
                    <span class="store-address">{{ $store->address->address }}</span>
                    <span class="store-phone">{{ $store->phone }}</span>
                        @if( Auth::id() && $store->user_rating === false )
                        <div class="rating-star">
                            <form action="/rating-store" id="form-rating" method="POST">

                            <ul id='stars' class="rating">
                                @for( $i=1; $i<6 ; $i++ )
                                 <li class="item-star">
                                    <input type="radio" value="{{ $i }}" name="star">
                                    <span class="ion-android-star"></span>
                                  </li>
                                  @endfor
                            </ul>
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            </form>
                        </div>
                        @endif
                        @if( Auth::id() && $store->user_rating !== false )
                        <div class="rating-star">
                            <ul id='stars' class="rating">
                                @for( $i=0; $i < $store->user_rating->star ; $i++ )
                                 <li class="star selected">
                                    <span class="ion-android-star"></span>
                                  </li>
                                @endfor
                                @for( $i=0; $i < ( 5 - $store->user_rating->star) ; $i++ )
                                 <li class="star">
                                    <span class="ion-android-star"></span>
                                  </li>
                                  @endfor
                            </ul>

                            <span class="confirm-rating">
                                ( {{ __('messages.rated_product').' '.$store->user_rating->star.' '.__('messages.star') }} )</span>
                        </div>

                        @endif
                    <div class="average-store-rating">
                        <div class="score">
                            <span class="rating-average">{{ $store->rating_average }}</span>
                        </div>
                        <div class="number-rating">
                            @if( $store->rating->count() == 0 )
                            <span>{{ __('messages.no_review') }}</span>
                            @elseif( $store->rating->count() == 1 )
                                <span>{{ '1 '.__('messages.review') }}</span>
                            @else
                            <span>{{ $store->rating->count().' '.__('messages.reviews') }}</span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="store-container">
            <div class="container">
                <div class="store-main-content">
                    <div class="row store-main--wrapper">
                        <div class="store--category col-md-3">
                            <div class="store-list-category">
                                <h4 class="store-title">{{ __('messages.category') }}</h4>
                                <ul class="list-category-wrapper">
                                    @foreach( $store->categories as $category )
                                        <li class="category-item" >
                                            <a href="#{{ $category->slug }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="product-in-store col-md-6">
                            <div class="list-product-on-store--wrapper">
                                <div class="product-action">
                                    <div class="form-search search-product">
                                        <input type="search" name="search" class="search-product-in-store" placeholder="{{ __('messages.search_product') }}">
                                        <input type="hidden" value="{{ $store->id }}" name="store_id" class="store-id">
                                    </div>
                                </div>
                                <div class="list-product-wrapper ajax-search-html">

                                    @foreach($store->categories as $category)
                                    <div id="{{ $category->slug }}" class="product-category">
                                        <h4 class="category-name">{{ $category->name }}</h4>
                                        @php
                                            $products = $category->products->where('store_id', $store->id);
                                        @endphp
                                        <div class="list-goods-in-category">

                                            @foreach( $products as $product )
                                            <div id="product-{{ $product->id }}" class="product">
                                                <div class="item-info-product ">
                                                    <div class="goods-thumb-item">
                                                        <a href="/products/{{ $product->slug }}">
                                                            @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                                            <img src="{{ $logo->image_path }}" alt="Image Product">
                                                            @endforeach
                                                        </a>
                                                    </div>
                                                    <div class="good-main-info">
                                                        <h4 class="goods-name">
                                                            <a href="/products/{{ $product->slug }}">{{ $product->name }}</a>
                                                        </h4>
                                                        @php
                                                            $rating = $product->rating_average;
                                                            $avg = ( $rating / 5 ) * 100;
                                                        @endphp
                                                        <div class="wt-star-rating">
                                                            <span class="star-reviewed" style="width: {{ $avg }}%">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-right">
                                                    @if( app()->getLocale() == 'en' )
                                                    <div class="info-goods-price">
                                                        @if( $product->on_sale != 0 )
                                                        <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}$</span>
                                                        <del>{{ $product->usd }}$</del>
                                                        @else
                                                        <span class="item_price">{{ $product->usd }}$</span></span>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if( app()->getLocale() == 'vi' )
                                                    <div class="info-goods-price">
                                                        @if( $product->on_sale != 0 )
                                                        <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}đ</span>
                                                        <del>{{ $product->vnd }}đ</del>
                                                        @else
                                                        <span class="item_price">{{ $product->vnd }}đ</span>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    <div class="goods-add-to-cart">
                                                        <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                                            @csrf
                                                            <fieldset>
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                                @guest
                                                                <button class="user-login">{{ __('messages.add_to_cart') }}</button>
                                                                @else
                                                                <button type="submit" class="button btn-add-to-cart btn-shop-add-to-cart"></button>
                                                                @endguest
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>


                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="store--cart col-md-3">

                        </div>
                    </div>
                </div>

                <div id="comment">
                    <h2 class="title">{{ __('messages.comments') }}</h2>
                    @if( Auth::id() )
                        <form action="/comment-store" method="POST" class="form-comment">
                            @csrf
                            <textarea name="comment" id="input-comment" rows="5" placeholder="{{ __('messages.enter_comment') }}"></textarea>
                            <button class="btn btn-post-comment" type="submit">
                                <span class="btn-main">
                                    <span class="btn-default">
                                        {{ __('messages.comment') }}
                                    </span>
                                    <span class="text-hover">
                                        {{ __('messages.comment') }}
                                    </span>
                                    <span class="btn-hover"></span>
                                </span>
                            </button>
                            <input type="hidden" id="store-id" name="store_id" value="{{ $store->id }}">
                            <input type="hidden" name="parent_id" value="0">
                        </form>
                        <div class="comment-list">
                            {!! getStoreComment($store->id) !!}
                        </div>

                    @else
                        <span>
                            <a href="">{{ __('messages.sing_in') }}</a>
                            {{ __('messages.or') }}
                            <a href="">{{ __('messages.sing_in') }}</a>
                            {{ __('messages.to_comment') }}
                        </span>
                    @endif
                </div>
            </div>

        </div>

    </div>
</section>
<div id="shop-cart-sidebar">
    <div class="cart-sidebar-head">
        <h4 class="cart-sidebar-title">Shopping cart</h4>
            @if ( Session::get('cart')['quantity'] )
                <span class="count">{{ Session::get('cart')['quantity'] }}</span>
            @else
                <span class="count">0</span>
            @endif

        <button id="close-cart-sidebar" class="ion-android-close"></button>
    </div>
    <div class="cart-sidebar-content">
        <ul class="list-product-in-cart product-item-action">
            @if ( Session::get('cart')['product'] )
                @foreach( Session::get('cart')['product'] as $product )
                <li class="mini-cart-item cart-item">
                    <div class="product-minnicart-info">
                        <span class="mincart-product-name">{{ $product->name }} </span>
                        <span class="product-quantity">
                            <span class="minicart-product-quantity">{{ $product->quantity }}</span> x
                            <span class="minicart-product-price">
                                @if( app()->getLocale() == 'en' )
                                    {{ '$'.$product->usd }}
                                @endif
                                @if( app()->getLocale() == 'vi' )
                                    {{ 'đ'.$product->vnd }}
                                @endif
                            </span>
                        </span>
                    </div>
                    <div class="product-minicart-logo">
                        <img src="{{ $product->logo }}" alt="{{ $product->name }}">
                    </div>
                    <span class="remove_from_cart_button ion-android-close delete-product" product="{{ $product->id }}"></span>
                </li>
                @endforeach
            @else
            <h6>{{ __('messages.no_product') }}</h6>
            @endif

        </ul>
    </div>
    <div class="subpay">
        <span class="label">{{ __('messages.total').':' }}</span>
        @if( app()->getLocale() == 'en' )
        <span class="total-price">$
            {{ Session::get('cart')['usd'] - Session::get('cart')['discount_usd'] }}
        </span>
        @endif
        @if( app()->getLocale() == 'vi' )
        <span class="total-price">đ
            {{ Session::get('cart')['vnd'] - Session::get('cart')['discount_vnd'] }}
        </span>
        @endif
    </div>
    <div class="mini-cart-action">
        <a href="{{ route('cart') }}" class="btn btn-view-cart">{{ __('messages.view_cart') }}</a>
        <a href="{{ route('checkout') }}" class="btn btn-view-checkout">{{ __('messages.checkout') }}</a>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/product-slider.js') }}"></script>
    <script src="{{ asset('js/home/quantity.js') }}"></script>
    <script src="{{ asset('js/home/rating.js') }}"></script>
    <script src="{{ asset('js/home/search-product.js') }}"></script>
    <script src="{{ asset('js/home/comment.js') }}"></script>
    <script src="{{ asset('js/home/reply-store.js') }}"></script>
    <script src="{{ asset('js/home/add-to-cart.js') }}"></script>
@endsection
