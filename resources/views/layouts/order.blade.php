@extends('layouts.master')
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-checkout checkout-detail">
    <div class="container">
        <div class="order-detail-wrapper">
            <h2>Thông Tin đơn hàng</h2>

            <p><strong>Tên người nhận hàng:</strong> <span>{{ $user->full_name }}</span></p>
            <p><strong>Sdt:</strong> <span>{{ $user->phone }}</span></p>
            <p>
                <strong>Tổng Tiền:</strong>
                @if( app()->getLocale() == 'en' )
                <span>{{ $user->total_usd }}</span>
                @else
                <span>{{ $user->total_vnd }}</span>
                @endif
            </p>
            <p></p>
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
                    @foreach( $order as $product )
                    <tr class="cart-item">
                        <td class="product-image">
                            <div class="product-thumb">
                                <img src="{{ $product->media->where(active, 1)->first()->image_path }}" alt="{{ $product->name }}" class="product-logo">
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

                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
