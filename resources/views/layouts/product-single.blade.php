@extends('layouts.master')
@section('style')
<link href="{{ asset('css/ionicon.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/product-single.css') }}" rel="stylesheet">
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
                        <a href="/$product->category->slug">
                            {{ $product->category->name }}
                        </a>
                    </li>
                    <li class="crumb">
                        <span>{{ $product->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="product">
            <div class="product-wrapper">
                <div class="row product-main-content">
                    <div class="product-thumnail col-md-6">
                        <div class="slider-for">
                            @foreach($product->media as $image)
                            <div class="product-image">
                                <img src="{{ url('/').$image->image_path }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="slider-nav">
                            @foreach($product->media as $image)
                            <div class="product-image">
                                <img src="{{ url('/').$image->image_path }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product-summary col-md-6">
                        <div class="summary-wrapper">
                            <h1 class="product-name">{{ $product->name }}</h1>
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
                            <div class="rating-star">
                            @if( Auth::id() && ratingProduct($product->id) === false )
                                <form action="/rating-product" id="form-rating" method="POST">

                                <ul id='stars' class="rating">
                                    @for( $i=1; $i<6 ; $i++ )
                                     <li class="item-star">
                                        <input type="radio" value="{{ $i }}" name="star">
                                        <span class="fa fa-star"></span>
                                      </li>
                                      @endfor
                                </ul>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </form>
                            @endif
                            @if( Auth::id() && ratingProduct($product->id) !== false )

                                <ul id='stars' class="rating">
                                    @for( $i=0; $i < ratingProduct($product->id)->star ; $i++ )
                                     <li class="star selected">
                                        <span class="fa fa-star"></span>
                                      </li>
                                    @endfor
                                    @for( $i=0; $i < ( 5 - ratingProduct($product->id)) ; $i++ )
                                     <li class="star">
                                        <span class="fa fa-star"></span>
                                      </li>
                                      @endfor
                                </ul>

                                <span>Bạn đã đánh giá sản phẩm {{ ratingProduct($product->id) }} sao</span>

                            @endif

                            </div>

                            <span class="rating-average">{{ $product->rating_average }}</span>

                            <span class="product-category">
                                <span class="label">{{ __('messages.category').':' }}</span>
                                <span class="category-name">{{ $product->category->name }}</span>
                            </span>
                            <span class="product-quantity">
                                <span class="label">{{ __('messages.quantity').':' }}</span>
                                <span class="quantity">{{ $product->quantity_stock }}</span>
                            </span>
                            <div class="product-description">
                                <span class="description-text">{{ $product->description }}</span>
                            </div>
                            <form class="add-cart" action="" method="post" enctype="multipart/form-data">

                                <div class="quantity">
                                    <span class="modify-qty dec ion-android-remove"></span>
                                    <input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="{{ $product->quantity_stock }}" name="quantity" value="1" title="Qty" size="4" inputmode="numeric">
                                    <span class="modify-qty inc ion-android-add"></span>
                                </div>

                                <button type="submit" name="add-to-cart" value="{{ $product->id }}" class="add-to-cart">{{ __('messages.add_to_cart') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="comment">

                </div>
            </div>
        </div>
        <div class="related-product">
            <h2>Reated product</h2>
            <div class="row">
                @foreach(sameProductInCategory($product->id) as $goods)
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item">
                            <a href="/products/{{ $goods->slug }}">
                                <img src="{{ getProductLogo($goods->id)->image_path }}" alt="Image Product">
                            </a>
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="/products/{{ $goods->slug }}" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="item-info-product ">
                            <h4>
                            <a href="/products/{{ $goods->slug }}">{{ $product->name }}</a>
                            </h4>
                            @if( app()->getLocale() == 'en' )
                            <div class="info-product-price">
                                @if( $goods->on_sale != 0 )
                                <span class="item_price">{{ $goods->usd - ( $goods->on_sale / 100 * $goods->usd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                <del>{{ $goods->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                @else
                                <span class="item_price">{{ $goods->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                @endif
                            </div>
                            @endif
                            @if( app()->getLocale() == 'vi' )
                            <div class="info-product-price">
                                @if( $goods->on_sale != 0 )
                                <span class="item_price">{{ $goods->vnd - ( $goods->on_sale / 100 * $goods->vnd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                <del>{{ $goods->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                @else
                                <span class="item_price">{{ $goods->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
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
            </div>
        </div>
        <div class="related-product">
            <h2>Products in the same store</h2>
            <div class="row">
                @foreach(sameProductInStore($product->id) as $goods)
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item">
                            <a href="/products/{{ $goods->slug }}">
                                <img src="{{ getProductLogo($goods->id)->image_path }}" alt="Image Product">
                            </a>
                            <div class="men-cart-pro">
                                <div class="inner-men-cart-pro">
                                    <a href="/products/{{ $goods->slug }}" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="item-info-product ">
                            <h4>
                            <a href="/products/{{ $goods->slug }}">{{ $product->name }}</a>
                            </h4>
                            @if( app()->getLocale() == 'en' )
                            <div class="info-product-price">
                                @if( $goods->on_sale != 0 )
                                <span class="item_price">{{ $goods->usd - ( $goods->on_sale / 100 * $goods->usd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                <del>{{ $goods->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                @else
                                <span class="item_price">{{ $goods->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                @endif
                            </div>
                            @endif
                            @if( app()->getLocale() == 'vi' )
                            <div class="info-product-price">
                                @if( $goods->on_sale != 0 )
                                <span class="item_price">{{ $goods->vnd - ( $goods->on_sale / 100 * $goods->vnd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                <del>{{ $goods->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                @else
                                <span class="item_price">{{ $goods->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
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
@endsection
