@extends('layouts.master')
@section('style')

<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="font-page page-content">

    <section class="slideshow" id="slideshow">
        <div class="slider-content slider-hero" id="slider-hero">
        @foreach( getSlider() as $slider )

            <div class="slider-item">
                <div class="img-slide">
                    <img src="{{ url('/') . $slider->media->image_path }}" alt="slider1">
                </div>
                <div class="caption container">
                    <span class="caption-title">{{ $slider->store->name }}</span>
                    <span class="cap-text">{{ $slider->description }}</span>
                    @if( getMaxDiscount($slider->store->id) != 0 )
                    <h2 class="sale-up">{{ ' Save '. getMaxDiscount($slider->store->id).'%' }}</h2>
                    @endif
                    <a href="/store/{{ $slider->store->slug }}" class="btn-watch">

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
                <!-- reviews -->
                <div class="customer-rev left-side">
                    <h3 class="agileits-sear-head">Customer Review</h3>
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
                <div class="wrapper">
                    <!-- first section (nuts) -->
                    <div class="product-sec1">
                        <h3 class="heading-tittle">{{ __('messages.new_product') }}</h3>
                        @foreach( productNew() as $product )
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
                                        <form action="#" method="post">
                                            <fieldset>
                                                <input type="hidden" name="cmd" value="_cart">
                                                <input type="hidden" name="add" value="1">
                                                <input type="hidden" name="business" value=" ">
                                                <input type="hidden" name="item_name" value="Almonds, 100g">
                                                <input type="hidden" name="amount" value="149.00">
                                                <input type="hidden" name="discount_amount" value="1.00">
                                                <input type="hidden" name="currency_code" value="USD">
                                                <input type="hidden" name="return" value=" ">
                                                <input type="hidden" name="cancel_return" value=" ">
                                                <input type="submit" name="submit" value="Add to cart" class="button">
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
                        @foreach( productBestSeller() as $product )
                        <div class="col-md-4 product-men">
                            <div class="men-pro-item simpleCart_shelfItem">
                                <div class="men-thumb-item">
                                    <img src="{{ getProductLogo($product->id)->image_path }}" alt="Image Product">
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
                                        <form action="#" method="post">
                                            <fieldset>
                                                <input type="hidden" name="cmd" value="_cart">
                                                <input type="hidden" name="add" value="1">
                                                <input type="hidden" name="business" value=" ">
                                                <input type="hidden" name="item_name" value="Almonds, 100g">
                                                <input type="hidden" name="amount" value="149.00">
                                                <input type="hidden" name="discount_amount" value="1.00">
                                                <input type="hidden" name="currency_code" value="USD">
                                                <input type="hidden" name="return" value=" ">
                                                <input type="hidden" name="cancel_return" value=" ">
                                                <input type="submit" name="submit" value="Add to cart" class="button">
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
@endsection
@section('js')
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/home/slider.js') }}"></script>
@endsection
