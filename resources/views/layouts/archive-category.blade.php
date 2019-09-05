@extends('layouts.master')
@section('style')
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
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
@endsection
