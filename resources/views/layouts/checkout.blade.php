@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-checkout checkout-detail">
    <div class="container">
        <div class="cart-detail-wrapper">
            <div class="order-detail">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.image') }}</th>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.quantity') }}</th>
                            <th>{{ __('messages.total') }}</th>
                            <th>{{ __('messages.store') }}</th>
                            <th>{{ __('messages.address') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $cart['product'] as $product )
                        <tr class="cart-item">
                            <td class="product-image">
                                <div class="product-thumb">
                                    <img src="{{ $product->logo }}" alt="{{ $product->name }}" class="product-logo">
                                </div>
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
                                {{ $product->quantity }}
                            </td>
                            <td>
                                @if( app()->getLocale() == 'en' )
                                    {{ '$'.($product->quantity * ( $product->usd - $product->discount_usd) ) }}
                                @else
                                    {{ 'đ'.($product->quantity * ( $product->vnd - $product->discount_vnd)) }}
                                @endif
                            </td>
                            <td class="order-store">
                                {{ $product->product->store->name }}
                            </td>
                            <td class="order-store-address">
                                {{ $product->product->store->address->address }}
                                <input type="hidden" value="{{$product->product->store->address->lat.', '.$product->product->store->address->lng}}" name="store[{{$product->product->store->id}}]" class="origin">
                            </td>
                            <td class="product-item-action">
                                <span class="ion-close delete-product" product="{{ $product->id }}"></span>
                            </td>

                        </tr>
                        @endforeach
                        <tr class="cart-total">
                            <td class="total-label" colspan="6"> {{ __('messages.total') }}</td>
                            <td class="total-price">

                                @if( app()->getLocale() == 'en' )
                                    {{ '$'.($cart['usd'] - $cart['discount_usd']) }}
                                @else
                                    {{ 'đ'.($cart['vnd'] - $cart['discount_vnd']) }}
                                @endif
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <form class="update-cart" action="" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="billing">{{ __('messages.billing') }}</h2>
                <div class="form-group">
                    <label for="name">{{ __('messages.name') }}</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('messages.phone') }}</label>
                    <input type="text" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="address" class=" col-form-label text-md-right">{{ __('messages.address') }}</label>
                    <div class="">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="map"></div>
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&libraries=places&anguage=vi&region=VI"></script>
<script src="{{ asset('js/admin/google-map.js') }}"></script>
<script src="{{ asset('js/home/distance.js') }}"></script>
@endsection
