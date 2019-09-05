@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/cart.css') }}" rel="stylesheet">
<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-cart cart-detail">
    <div class="container">
        <div class="cart-detail-wrapper">
            <form class="update-cart" action="{{ route('update-cart', [ 'id' => $cart['id']]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if( $cart['product'] )
                <table class="cart-table">
                    @foreach( $cart['product'] as $product )
                    <tr class="cart-item">
                        <td class="product-image">
                            <img src="{{ $product->logo }}" alt="{{ $product->name }}" class="product-logo">
                        </td>
                        <td class="product-name">{{ $product->name }}</td>
                        <td class="product-price">
                            @if( app()->getLocale() == 'en' )
                            <div class="info-product-price">
                                @if( $product->discount_usd != 0 )
                                    <span class="item_price">
                                        {{ '$'.($product->usd - ( $product->discount_usd )) }}
                                    </span>
                                    <del>{{ '$'.$product->usd }}</del>
                                @else
                                    <span class="item_price">
                                        {{ '$'.$product->usd }}
                                    </span>
                                @endif
                            </div>
                            @endif
                            @if( app()->getLocale() == 'vi' )
                            <div class="info-product-price">
                                @if( $product->on_sale != 0 )
                                    <span class="item_price">
                                        {{ 'đ'.($product->vnd - $product->discount_vnd) }}
                                    </span>
                                    <del>{{ 'đ' . $product->vnd }}</del>
                                @else
                                    <span class="item_price">
                                        {{ 'đ'.$product->vnd }}
                                    </span>
                                @endif
                            </div>
                            @endif
                        </td>
                        <td class="product-quantity">
                            <div class="quantity">
                                <span class="modify-qty dec ion-android-remove"></span>
                                <input type="number" class="input-text qty text" step="1" min="1" max="20" name="quantity[{{ $product->id }}]" value="{{ $product->quantity }}" title="Qty" size="4" inputmode="numeric">
                                <span class="modify-qty inc ion-android-add"></span>
                            </div>
                        </td>
                        <td>
                            @if( app()->getLocale() == 'en' )
                                {{ $product->quantity * ( $product->usd - $product->discount_usd) }}
                            @else
                                {{ $product->quantity * ( $product->vnd - $product->discount_vnd) }}
                            @endif
                        </td>
                        <td class="product-item-action">
                            <span class="ion-close delete-product" product="{{ $product->id }}"></span>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="cart-total">
                        <td class="total-label" colspan="4"> {{ __('messages.total') }}</td>
                        <td class="total-price">

                            @if( app()->getLocale() == 'en' )
                                {{ '$'.($cart['usd'] - $cart['discount_usd']) }}
                            @else
                                {{ 'đ'.($cart['vnd'] - $cart['discount_vnd']) }}
                            @endif
                        </td>
                    </tr>
                    <tr class="cart-update">
                        <td colspan="5" class="car-update">
                            <button type="summit" class="btn btn-update-cart">
                                {{ __('messages.update') }}
                            </button>
                            <a href="" class="btn btn-checkout">{{ __('messages.checkout') }}</a>
                        </td>
                    </tr>
                </table>
                @else
                <h6>{{ __('messages.no_product') }}</h6>
                @endif
                <input type="hidden" value="{{ $cart['id'] }}" name="cart">
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/home/quantity.js') }}"></script>
<script src="{{ asset('js/home/delete-cart.js') }}"></script>
<script src="{{ asset('js/home/update-cart.js') }}"></script>
@endsection
