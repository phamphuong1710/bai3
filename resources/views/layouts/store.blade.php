@extends('layouts.master')
@section('style')
<link href="{{ asset('css/ionicon.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/product-single.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/store.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="single-product">
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
    <div class="container">
        <div class="ads-grid">
            <div class="container">
                <!-- //tittle heading -->
                <!-- product left -->
                <div class="side-bar col-md-3">
                    <!-- reviews -->
                    <div class="customer-rev left-side">
                        <h3 class="widget-title">{{ __('messages.product') }}</h3>
                        <ul>
                            <li>
                                <a href="/product/rating/5">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <span>5.0</span>
                                </a>
                            </li>
                            <li>
                                <a href="/product/rating/4">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <span>4.0</span>
                                </a>
                            </li>

                            <li>
                                <a href="/product/rating/3">
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <i class="ion-android-star-outline" aria-hidden="true"></i>
                                    <span>3.0</span>
                                </a>
                            </li>
                            <li>
                                <a href="product/rating/2">
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
                    <!-- price range -->
                    <div class="range">
                        <h3 class="widget-title">Price range</h3>
                        <ul class="dropdown-menu6">
                            <li>
                                <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header" style="left: 0.555556%; width: 66.1111%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0.555556%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 66.6667%;"></a></div>
                                <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;">
                            </li>
                        </ul>
                    </div>
                    <!-- //price range -->

                    <!-- //food preference -->
                    <!-- discounts -->
                    <div class="left-side">
                        <h3 class="agileits-sear-head">Discount</h3>
                        <ul>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">5% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">10% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">20% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">30% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">50% or More</span>
                            </li>
                            <li>
                                <input type="checkbox" class="checked">
                                <span class="span">60% or More</span>
                            </li>
                        </ul>
                    </div>
                    <!-- //discounts -->


                    <!-- //deals -->
                </div>
                <!-- //product left -->
                <!-- product right -->
                <div class="agileinfo-ads-display col-md-9">
                    <div class="wrapper store-wrapper">
                        <div class="logo-wrapper">
                            <img src="{{ url('/').$store->media->where('active', 1)->first()->image_path }}" alt="">
                        </div>
                        <div class="store-summary">
                            <h1 class="title store-name">{{ $store->name }}</h1>
                            <span class="store-address">{{ $store->address->address }}</span>
                            <span class="store-phone">{{ $store->phone }}</span>
                                @if( Auth::id() && ratingStore($store->id) === false )
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
                                @if( Auth::id() && ratingStore($store->id) !== false )
                                <div class="rating-star">
                                    <ul id='stars' class="rating">
                                        @for( $i=0; $i < ratingStore($store->id)->star ; $i++ )
                                         <li class="star selected">
                                            <span class="ion-android-star"></span>
                                          </li>
                                        @endfor
                                        @for( $i=0; $i < ( 5 - ratingStore($store->id)->star) ; $i++ )
                                         <li class="star">
                                            <span class="ion-android-star"></span>
                                          </li>
                                          @endfor
                                    </ul>

                                    <span class="confirm-rating">Bạn đã đánh giá sản phẩm {{ ratingStore($store->id)->star }} sao</span>
                                </div>

                                @endif
                            <div class="average-store-rating">
                                <div class="score">
                                    <span class="rating-average">{{ $store->rating_average }}</span>
                                </div>
                                <div class="number-rating">
                                    @if( $store->rating->count() == 0 )
                                    <span>Chưa có đánh giá</span>
                                    @else
                                    <span>{{ $store->rating->count().' đánh giá' }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="product-in-store">
                        <div class="product-action">
                            <div class="total-product">
                                <span class="number-product">{{ $store->products->count(). ' ' .__('messages.product') }}</span>
                            </div>
                            <div class="form-search search-product">
                                <input type="search" name="search" class="search-product-in-store">
                                <input type="hidden" value="{{ $store->id }}" name="store_id" class="store-id">
                            </div>
                        </div>
                        <div class="list-product-wrapper ajax-search-html">
                            @foreach($store->products as $product)
                            <div class="col-md-4 product-men">
                                <div class="men-pro-item simpleCart_shelfItem">
                                    <div class="men-thumb-item">
                                        <a href="/products/{{ $product->slug }}">
                                            <img src="{{ getProductLogo($product->id)->image_path }}" alt="Image Product">
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
                                        <a href="/products/{{ $product->slug }}">{{ $product->name }}</a>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- //product right -->
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/product-slider.js') }}"></script>
    <script src="{{ asset('js/home/quantity.js') }}"></script>
    <script src="{{ asset('js/home/rating.js') }}"></script>
    <script src="{{ asset('js/home/search-product.js') }}"></script>
@endsection
