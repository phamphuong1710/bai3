@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="content-order">
        <div class="user-order">
            <h2 class="billing-detail-title">{{ __('messages.billing') }}</h2>
            <div class="content-info-order">
                <div class="row user-item">
                    <div class="col-md-2 user-label">
                        <h6>{{ __('messages.full_name').': ' }}</h6>
                    </div>
                    <div class="col-md-10 user-item-info">
                        <span>{{ $user->full_name }}</span>
                    </div>
                </div>
                <div class="row user-item">
                    <div class="col-md-2 user-label">
                        <h6>{{ __('messages.address').': ' }}</h6>
                    </div>
                    <div class="col-md-10 user-item-info">
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
                <div class="row user-item">
                    <div class="col-md-2 user-label">
                        <h6>{{ __('messages.phone') }}</h6>
                    </div>
                    <div class="col-md-10 user-item-info">
                        <span>{{ $user->phone }}</span>
                    </div>
                </div>
            </div>

        <div class="product-order">
            <h2 class="billing-detail-title">{{ __('messages.order') }}</h2>
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
                    @foreach( $orderDetail as $detail )
                    @php
                    $product = $detail->product;
                    @endphp
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
                            {{ $detail->quantity }}
                        </td>
                        <td>
                            @if( app()->getLocale() == 'en' )
                                {{ '$'.($detail->quantity * ( $product->usd - $product->discount_usd) ) }}
                            @else
                                {{ 'đ'.($detail->quantity * ( $product->vnd - $product->discount_vnd)) }}
                            @endif
                        </td>
                        <td class="order-store">
                            {{ $product->store->name }}
                        </td>
                        <td class="order-store-address">
                            {{ $product->store->address->address }}

                        </td>
                        <td class="product-item-action">
                            <span class="ion-close delete-product" product="{{ $product->id }}"></span>
                        </td>

                    </tr>
                    @endforeach
                    <tr class="cart-total">
                        <td class="total-label" colspan="6"> {{ __('messages.total') }}</td>
                        @php
                            if( app()->getLocale() == 'en' ) :
                                $price = ($order->usd - $order->discount_usd);
                            else :
                                $price = ($order->vnd - $order->discount_vnd);
                            endif
                        @endphp
                        <td class="total-price">
                                {{ '$'. $price }}
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
