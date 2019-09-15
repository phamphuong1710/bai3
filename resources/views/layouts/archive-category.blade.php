@extends('layouts.master')

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
                        <span>{{ $products->category->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="related-product">
            <h2>{{ $products->category->name }}</h2>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item item-pro">
                            <div class="men-thumb-item">
                                <a href="/products/{{ $product->slug }}">

                                    <img src="{{ $product->logo->image_path }}" alt="{{ $product->name }}">
                                </a>
                                <?php if ( $product->on_sale != 0 ): ?>
                                    <span class="product-discount">{{ $product->on_sale . '%' }}</span>
                                <?php endif ?>

                                <div class="add-to-cart-wrapper">
                                    <form action="{{ route('add-to-cart') }}" method="post" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="add-product">
                                        <input type="hidden" name="quantity" value="1"  class="add-quantity">
                                        <input type="hidden" name="usd_to_vnd" class="usd-to-vnd">
                                        @guest
                                        <button class="user-login btn-add-cart ion-ios-cart">{{ __('messages.add_to_cart') }}</button>
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
                                <div class="info-product-price">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/home/add-to-cart.js') }}"></script>
@endsection
