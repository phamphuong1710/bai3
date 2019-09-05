@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/product-single.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/comment.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/mini-cart.css') }}" rel="stylesheet">
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

                            @if( Auth::id() && $product->user_rating === false )
                            <div class="rating-star">
                                <form action="/rating-product" id="form-rating" method="POST">

                                <ul id='stars' class="rating">
                                    @for( $i=1; $i<6 ; $i++ )
                                     <li class="item-star">
                                        <input type="radio" value="{{ $i }}" name="star">
                                        <span class="ion-android-star"></span>
                                      </li>
                                      @endfor
                                </ul>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </form>
                            </div>
                            @endif
                            @if( Auth::id() && $product->user_rating !== false )
                            <div class="rating-star">
                                <ul id='stars' class="rating">
                                    @for( $i=0; $i < $product->user_rating->star ; $i++ )
                                     <li class="star selected">
                                        <span class="ion-android-star"></span>
                                      </li>
                                    @endfor
                                    @for( $i=0; $i < ( 5 - $product->user_rating->star) ; $i++ )
                                     <li class="star">
                                        <span class="ion-android-star"></span>
                                      </li>
                                      @endfor
                                </ul>

                                <span class="confirm-rating">
                                    {{ __('messages.rated_product').' '.$product->user_rating->star.' '.__('messages.star') }} </span>
                            </div>

                            @endif


                        <div class="average-store-rating">
                            <div class="score">
                                <span class="rating-average">{{ $product->rating_average }}</span>
                            </div>
                            <div class="number-rating">
                                @if( $product->rating->count() == 0 )
                                <span>{{ __('messages.no_review') }}</span>
                                @elseif( $product->rating->count() == 1 )
                                    <span>{{ '1 '.__('messages.review') }}</span>
                                @else
                                <span>{{ $product->rating->count().' '.__('messages.reviews') }}</span>
                                @endif
                            </div>

                        </div>

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
                            <form class="add-cart add-to-cart-form" action="{{ route('add-to-cart') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="quantity">
                                    <span class="modify-qty dec ion-android-remove"></span>
                                    <input type="number" id="quantity" class="input-text qty add-quantity @error('quantity') is-invalid @enderror" step="1" min="1" max="{{ $product->quantity_stock }}" name="quantity" value="1" size="4" inputmode="numeric">
                                    <span class="modify-qty inc ion-android-add"></span>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">

                                <button type="submit" name="add-to-cart" value="{{ $product->id }}" class="add-to-cart btn-add-to-cart">{{ __('messages.add_to_cart') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="comment">
                    <h2 class="title">{{ __('messages.comments') }}</h2>
                    @if( Auth::id() )
                        <form action="/comment-product" method="POST" class="form-comment">
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
                            <input type="hidden" id="product-id" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="parent_id" value="0">
                        </form>
                        <div class="comment-list">
                            {!! getProductComment($product->id) !!}
                        </div>

                    @else
                        <span>
                            <a href="/login">{{ __('messages.sing_in') }}</a>
                            {{ __('messages.or') }}
                            <a href="/register">{{ __('messages.sing_in') }}</a>
                            {{ __('messages.to_comment') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="related-product">
            <h2>Reated product</h2>
            <div class="row">
                @foreach($product->in_category as $goods)
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item">
                            <a href="/products/{{ $goods->slug }}">
                                @foreach ( $goods->media->where( 'active', 1 ) as $logo )
                                <img src="{{ $logo->image_path }}" alt="Image Product">
                                @endforeach
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
                @foreach($product->in_store as $goods)
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item">
                            <a href="/products/{{ $goods->slug }}">
                                @foreach ( $goods->media->where( 'active', 1 ) as $logo )
                                <img src="{{ $logo->image_path }}" alt="Image Product">
                                @endforeach
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


    </div>
</div>

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
        <a href="{{ route('checkout') }}" class="btn btn-view-checkout">{{ __('messages.checkout') }}</a>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/product-slider.js') }}"></script>
    <script src="{{ asset('js/home/quantity.js') }}"></script>
    <script src="{{ asset('js/home/rating.js') }}"></script>
    <script src="{{ asset('js/home/comment.js') }}"></script>
    <script src="{{ asset('js/home/reply-product.js') }}"></script>
    <script src="{{ asset('js/home/add-to-cart.js') }}"></script>
@endsection
