@extends('layouts.master')
@section('style')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="font-page page-content">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            @foreach( getTopDiscountProduct() as $product )
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $product->store->name }}</h5>
                    <p>Discount up to {{ $product->on_sale.'%' }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="ads-grid">
        <div class="container">
            <!-- //tittle heading -->
            <!-- product left -->
            <div class="side-bar col-md-3">
                <div class="search-hotel">
                    <h3 class="agileits-sear-head">Search Here..</h3>
                    <form action="#" method="post">
                        <input type="search" placeholder="Product name..." name="search" required="">
                        <input type="submit" value=" ">
                    </form>
                </div>
                <!-- price range -->
                <div class="range">
                    <h3 class="agileits-sear-head">Price range</h3>
                    <ul class="dropdown-menu6">
                        <li>
                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header" style="left: 0.555556%; width: 66.1111%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0.555556%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 66.6667%;"></a></div>
                            <input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;">
                        </li>
                    </ul>
                </div>
                <!-- //price range -->
                <!-- food preference -->
                <div class="left-side">
                    <h3 class="agileits-sear-head">Food Preference</h3>
                    <ul>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Vegetarian</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Non-Vegetarian</span>
                        </li>
                    </ul>
                </div>
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
                <!-- reviews -->
                <div class="customer-rev left-side">
                    <h3 class="agileits-sear-head">Customer Review</h3>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>5.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <span>4.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <span>3.5</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <span>3.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <span>2.5</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //reviews -->
                <!-- cuisine -->
                <div class="left-side">
                    <h3 class="agileits-sear-head">Cuisine</h3>
                    <ul>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">South American</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">French</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Greek</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Chinese</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Japanese</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Italian</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Mexican</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Thai</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span">Indian</span>
                        </li>
                        <li>
                            <input type="checkbox" class="checked">
                            <span class="span"> Spanish </span>
                        </li>
                    </ul>
                </div>
                <!-- //cuisine -->
                <!-- deals -->
                <div class="deal-leftmk left-side">
                    <h3 class="agileits-sear-head">Special Deals</h3>
                    <div class="special-sec1">
                        <div class="col-xs-4 img-deals">
                            <img src="images/d2.jpg" alt="">
                        </div>
                        <div class="col-xs-8 img-deal1">
                            <h3>Lay's Potato Chips</h3>
                            <a href="single.html">$18.00</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="special-sec1">
                        <div class="col-xs-4 img-deals">
                            <img src="images/d1.jpg" alt="">
                        </div>
                        <div class="col-xs-8 img-deal1">
                            <h3>Bingo Mad Angles</h3>
                            <a href="single.html">$9.00</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="special-sec1">
                        <div class="col-xs-4 img-deals">
                            <img src="images/d4.jpg" alt="">
                        </div>
                        <div class="col-xs-8 img-deal1">
                            <h3>Tata Salt</h3>
                            <a href="single.html">$15.00</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="special-sec1">
                        <div class="col-xs-4 img-deals">
                            <img src="images/d5.jpg" alt="">
                        </div>
                        <div class="col-xs-8 img-deal1">
                            <h3>Gujarat Dry Fruit</h3>
                            <a href="single.html">$525.00</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="special-sec1">
                        <div class="col-xs-4 img-deals">
                            <img src="images/d3.jpg" alt="">
                        </div>
                        <div class="col-xs-8 img-deal1">
                            <h3>Cadbury Dairy Milk</h3>
                            <a href="single.html">$149.00</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
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
                                    <img src="{{ getProductLogo($product->id)->image_path }}" alt="Image Product">
                                    <div class="men-cart-pro">
                                        <div class="inner-men-cart-pro">
                                            <a href="single.html" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                        </div>
                                    </div>
                                    <span class="product-new-top">{{ __('messages.new') }}</span>
                                </div>
                                <div class="item-info-product ">
                                    <h4>
                                    <a href="single.html">Almonds, 100g</a>
                                    </h4>
                                    @if( app()->getLocale() == 'en' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale_usd != 0 )
                                        <span class="item_price">{{ $product->on_sale_usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    @if( app()->getLocale() == 'vi' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale_vnd != 0 )
                                        <span class="item_price">{{ $product->on_sale_vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
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
                    <!-- //first section (nuts) -->
                    <!-- second section (nuts special) -->
                    <div class="product-sec1 product-sec2">
                        <div class="col-xs-7 effect-bg">
                            <h3 class="">Pure Energy</h3>
                            <h6>Enjoy our all healthy Products</h6>
                            <p>Get Extra 10% Off</p>
                        </div>
                        <h3 class="w3l-nut-middle">Nuts &amp; Dry Fruits</h3>
                        <div class="col-xs-5 bg-right-nut">
                            <img src="images/nut1.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- //second section (nuts special) -->
                    <!-- third section (oils) -->
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
                                        <span class="item_price">{{ $product->on_sale_usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        <del>{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                        @else
                                        <span class="item_price">{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                        @endif
                                    </div>
                                    @endif
                                    @if( app()->getLocale() == 'vi' )
                                    <div class="info-product-price">
                                        @if( $product->on_sale != 0 )
                                        <span class="item_price">{{ $product->on_sale_vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
