@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="single-product">
    <div class="container">

        <div class="single-page-header">
            <div class="breadcrumb">
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

        <div class="product">
            <div class="product-wrapper">
                <div class="row product-main-content">
                    <div class="product-thumnail col-md-7">
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
                    <div class="product-summary col-md-5">
                        <div class="summary-wrapper">
                            <h2 class="product-name">{{ $product->name }}</h2>
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
                        </div>
                    </div>
                </div>

                <div id="comment">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/product-slider.js') }}"></script>

@endsection
