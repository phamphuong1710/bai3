@extends('layouts.master')
@section('style')
@endsection
@section('content')
<div class="font-page page-content">

    <div class="ads-grid">
        <div class="container">
            @if($products)
            <div class="related-product">
                <h2>Search For Product</h2>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3 product-men">
                            <div class="men-pro-item item-pro">
                                <div class="men-thumb-item">
                                    <a href="/products/{{ $product->slug }}">

                                        <img src="{{ $product->logo }}" alt="{{ $product->name }}">
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
                                        <span class="item_price">
                                            <span class="currency">$</span>{{ number_format($price,2,'.','.') }}
                                        </span>
                                        <del>
                                            <span class="currency">$</span>{{ number_format($product->usd,2,'.','.') }}</del>
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

            </div>
            @endif

            @if($stores)

            <div class="related-product">
                <h2>Store</h2>
                <div class="row">
                    @foreach($stores as $store)
                            <div class="col-md-3 product-men">
                                <div class="store-item item-pro">
                                    <div class="men-thumb-item">
                                        <a href="/store/{{ $store->slug }}">
                                            <img src="{{ $store->logo }}" alt="{{ $store->name }}">
                                        </a>
                                    </div>
                                    <div class="item-info-product ">
                                        <h4 class="item-name">
                                        <a href="/store/{{ $store->slug }}">{{ Str::words($store->name, 3) }}</a>
                                        </h4>
                                        <span class="store-address">
                                            {{  Str::words($store->address->address, 4) }}
                                        </span>
                                        @php
                                            $avg = $store->rating_average;
                                            $p = ( $avg / 5 ) * 100;
                                        @endphp
                                        <div class="wt-star-rating">
                                            <span class="star-reviewed" style="width: {{ $p }}%">
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>

            </div>
            @endif
        </div>
    </div>

</div>
@endsection
@section('js')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
