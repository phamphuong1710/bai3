@extends('layouts.master')
@section('style')

<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/mini-cart.css') }}" rel="stylesheet">
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
    <div class="ads-grid">
        <div class="container">
            <!-- //tittle heading -->
            <!-- product left -->
            <div class="side-bar col-md-3">
                <div class="search-product">
                    <h3 class="widget-title">{{ __('messages.search_product') }}</h3>
                    <form action="/search/product" method="post" class="form-search-sidebar">
                        @csrf
                        <input type="search" placeholder="Product name..." name="search" required class="input-search-sidebar">
                        <button type="submit" class="btn btn-search" aria-label="Left Align">
                            <span class="btn-main">
                                <span class="btn-default ion-android-search"></span>
                                <span class="text-hover ion-android-search"></span>
                                <span class="btn-hover"></span>
                            </span>
                        </button>
                    </form>
                </div>

                <!-- reviews -->
                <div class="customer-rev left-side">
                    <h3 class="widget-title">Customer Review</h3>
                    <ul>
                        <li>
                            <a href="/store/rating/5">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <span>5.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="/store/rating/4">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>4.0</span>
                            </a>
                        </li>

                        <li>
                            <a href="/store/rating/3">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>3.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="store/rating/2">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>2</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //reviews -->
                <!-- discounts -->
                <div class="left-side">
                    <h3 class="widget-title">Discount</h3>
                    <ul>

                        <li>
                            <a href="/products/discount/20">
                                <span class="span">20% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/30">
                                <span class="span">30% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/40">
                                <span class="span">40% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/50">
                                <span class="span">50% or More</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- //discounts -->


                <!-- //deals -->
            </div>
            <!-- //product left -->
            <!-- product right -->
            <div class="agileinfo-ads-display col-md-9">
                <div class="wrapper">
                    <!-- first section (nuts) -->
                    <div class="product-sec1">
                        <h3 class="heading-tittle">{{ __('messages.new_product') }}</h3>
                        @foreach( $new as $product )
                        <div class="col-md-4 product-men">
                            <div class="men-pro-item simpleCart_shelfItem">
                                <div class="men-thumb-item">
                                    <a href="/products/{{ $product->slug }}">
                                        @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                        <img src="{{ $logo->image_path }}" alt="Image Product">
                                        @endforeach
                                    </a>
                                    <div class="men-cart-pro">
                                        <div class="inner-men-cart-pro">
                                            <a href="/products/{{ $product->slug }}" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                        </div>
                                    </div>
                                    <span class="product-new-top">{{ __('messages.new') }}</span>
                                </div>
                                <div class="item-info-product ">
                                    <h4>
                                    <a href="single.html">{{ $product->name }}</a>
                                    </h4>
                                    @if( app()->getLocale() == 'en' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    @if( app()->getLocale() == 'vi' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                        <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                            @csrf
                                            <fieldset>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                <input type="submit" name="submit" value="Add to cart" class="button btn-add-to-cart">
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>

                    <div class="product-sec1">
                        <h3 class="heading-tittle">{{ __('messages.bestseller') }}</h3>
                        @foreach( $bestSeller as $product )
                        <div class="col-md-4 product-men">
                            <div class="men-pro-item simpleCart_shelfItem">
                                <div class="men-thumb-item">
                                    @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                    <img src="{{ $logo->image_path }}" alt="Image Product">
                                    @endforeach
                                    <div class="men-cart-pro">
                                        <div class="inner-men-cart-pro">
                                            <a href="single.html" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info-product ">
                                    <h4>
                                    <a href="single.html">{{ $product->name }}</a>
                                    </h4>
                                    @if( app()->getLocale() == 'en' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    @if( app()->getLocale() == 'vi' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                        <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                            @csrf
                                            <fieldset>
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                <input type="submit" name="submit" value="Add to cart" class="button btn-add-to-cart">
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                    <!-- //third section (oils) -->
                </div>
            </div>
            <!-- //product right -->
        </div>
    </div>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="col-xs-8 agile-leftmk">
                <h2>Get your Groceries delivered from local stores</h2>
                <p>Free Delivery on your first order!</p>
                <form action="#" method="post">
                    <input type="email" placeholder="E-mail" name="email" required>
                    <input type="submit" value="Subscribe">
                </form>
                <div class="newsform-w3l">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //newsletter -->
</div>
<div  id="shop-overlay"></div>
<div id="shop-cart-sidebar">
    <div class="cart-sidebar-head">
        <h4 class="cart-sidebar-title">Shopping cart</h4>
            @if ( Session::get('cart')['quantity'] )
                <span class="count">Session::get('cart')['quantity']</span>
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
                                    {{ $product->usd }}
                                @endif
                                @if( app()->getLocale() == 'vi' )
                                    {{ $product->vnd }}
                                @endif
                            </span>
                        </span>
                    </div>
                    <div class="product-minicart-logo">
                        <img src="{{ $product->logo }}" alt=" $product->name ">
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
        <span class="total-price">
            {{ Session::get('cart')['usd'] - Session::get('cart')['discount_usd'] }}
        </span>
        @endif
        @if( app()->getLocale() == 'vi' )
        <span class="total-price">
            {{ Session::get('cart')['vnd'] - Session::get('cart')['discount_vnd'] }}
        </span>
        @endif
    </div>
    <div class="mini-cart-action">
        <a href="{{ route('cart') }}" class="btn btn-view-cart">{{ __('messages.view_cart') }}</a>
        <a href="" class="btn btn-view-checkout">{{ __('messages.checkout') }}</a>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/home/slider.js') }}"></script>
<script src="{{ asset('js/home/add-to-cart.js') }}"></script>
<script src="{{ asset('js/home/delete-cart.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
@endsection


