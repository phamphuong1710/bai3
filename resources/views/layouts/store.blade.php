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
        @php
            $cart = Session::get('cart');
            dd($cart);
        @endphp
        <div class="wrapper store-wrapper">

            <div class="container store-information">
                <div class="store-logo-wrapper">
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
                        <div class="store--category col-md-4">
                            <div class="btn-buy-group">
                                <a href="{{ route( 'buy-group', ['id' => $store->id] ) }}" class="btn-buygroup">
                                    {{ __( 'messages.buy_group' ) }}
                                </a>
                                <div class="link-buy-group-popup">
                                    <div class="popup-wrapper">
                                        <h4 class="title">{{ __('messages.share') }}</h4>
                                        <div class="link-share">
                                            <span class="text">{{ __('messages.copy') }}</span>
                                            <input type="text" class="href">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="product-in-store col-md-8">
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

                                        <div class="list-goods-in-category">

                                            @foreach( $products[$category->id] as $product )
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
                                                    <div class="info-goods-price">
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
                                                    <div class="goods-add-to-cart">
                                                        <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                                            @csrf
                                                            <fieldset>
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                                                <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                                                <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                                                @if ( array_key_exists( 's', $_GET ) )
                                                                    <input type="hidden" name="slug" value="{{$_GET['s']}}">
                                                                @endif
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
                            <button class="btn-post-comment" type="submit">
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
                            <ul class="comments">
                                @foreach ( $comments_parent as $comment )
                                    <li class="comment-item">
                                        <div class="comment-item-wrapper">
                                            <div class="comment-info">
                                                <div class="comment-info-left">
                                                    <span class="author">{{ $comment->user->name }}</span>
                                                    <span class="created-at ion-clock">{{ ($comment->created_at)->diffForHumans() }}</span>
                                                </div>
                                                <a href="#" class="reply-comment ion-chatbubble" comment="{{ $comment->id }}">Reply</a>
                                            </div>
                                            <span class="comment-content">
                                                {{ $comment->content }}
                                            </span>
                                            <div class="reply-form"></div>
                                        </div>

                                        <ul class="list-comment-child" data-comment="{{ $comment->id }}">
                                        @foreach( $comments_child[$comment->id] as $child )

                                            <li class="comment-item">
                                                <div class="comment-item-wrapper">
                                                    <div class="comment-info">
                                                        <div class="comment-info-left">
                                                            <span class="author">{{ $child->user->name }}</span>
                                                            <span class="created-at ion-clock">{{ ($child->created_at)->diffForHumans() }}</span>
                                                        </div>
                                                        <a href="#" class="reply-comment ion-chatbubble" comment="{{$comment->id}}">Reply</a>
                                                    </div>
                                                    <span class="comment-content">{{ $child->content }}
                                                    </span>
                                                    <div class="reply-form"></div>
                                                </div>
                                            </li>

                                        @endforeach
                                        </ul>

                                    </li>

                                @endforeach
                            </ul>
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

@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/quantity.js') }}"></script>
    <script src="{{ asset('js/home/rating.js') }}"></script>
    <script src="{{ asset('js/home/search-product.js') }}"></script>
    <script src="{{ asset('js/home/comment.js') }}"></script>
    <script src="{{ asset('js/home/reply-store.js') }}"></script>
    <script src="{{ asset('js/home/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/home/buygroup-popup.js') }}"></script>
@endsection
