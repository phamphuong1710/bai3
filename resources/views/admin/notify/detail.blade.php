@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/store.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="store-section">
<table>
    <tr>
        <th>{{ __('messages.name') . ":" }}</th>
        <td>{{ $custommer->full_name }}</td>
    </tr>
    <tr>
        <th>{{ __('messages.phone') . ':'  }}</th>
        <td>{{ $custommer->phone}}</td>
    </tr>
    <tr>
        <th>{{ __('messages.address') . ':'  }}</th>
        <td>{{ $custommer->address}}</td>
    </tr>
</table>
@php
$product = $orderDetail->product;
@endphp
<table>
    <thead>
        <tr>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.price') }}</th>
            <th>{{ __('messages.quantity') }}</th>
            <th>{{ __('messages.total') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ $product->name }}
            </td>
            <td>
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
                        @endif
            </td>
            <td>{{ $orderDetail->quantity }}</td>
            <td>
                @if( app()->getLocale() == 'en' )
                    {{ '$'.($orderDetail->quantity * ( $orderDetail->usd - $orderDetail->discount_usd) ) }}
                @else
                    {{ 'đ'.($orderDetail->quantity * ( $orderDetail->vnd - $orderDetail->discount_vnd)) }}
                @endif
            </td>
        </tr>
    </tbody>
</table>
</div>

@endsection

