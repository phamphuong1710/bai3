@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/cart.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-cart cart-detail">
    <div class="container">
        <div class="cart-detail-wrapper">
            <form class="add-cart" action="" method="post" enctype="multipart/form-data">
                <table class="cart-table">
                    @foreach( $cart['product'] as $product )
                    <tr class="cart-item">
                        <td class="product-image">
                            <img src="{{ $product->logo->image_path }}" alt="{{ $product->name }}" class="product-logo">
                        </td>
                        <td class="product-name">{{ $product->name }}</td>
                        <td class="product-price">
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
                        </td>
                        <td class="product-quantity">
                            <div class="quantity">
                                <span class="modify-qty dec ion-android-remove"></span>
                                <input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="{{ $product->quantity_stock }}" name="quantity[{{ $product->id }}]" value="{{ $product->quantity }}" title="Qty" size="4" inputmode="numeric">
                                <span class="modify-qty inc ion-android-add"></span>
                            </div>
                        </td>
                        <td class="product-item-action">
                            <span class="ion-close delete-product" product="{{ $product->detail_id }}"></span>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <input type="hidden" value="{{ $cart['id'] }}" name="cart">
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/home/quantity.js') }}"></script>
<script src="{{ asset('js/home/delete-cart.js') }}"></script>
@endsection
