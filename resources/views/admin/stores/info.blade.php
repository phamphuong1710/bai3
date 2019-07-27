@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="user-section">
    <div class="shop-detail">
        <h1 class="page-title header">{{ $store->name }}</h1>
        <a href="/shop/{{ $store->id }}/create-product" class="create">
            {{ __('messages.createproduct') }}
        </a>
    </div>

    <div class="list-product">
        <div class="list-product-wrapper">
            @foreach( $store->products as $product )
                <div id="product-{{ $product->id }}" class="product product-admin">
                    <div class="product-content">
                        <div class="image-product-wrapper">
                            <a href="/products/{{$product->id}}">
                                <img src="{{ getProductLogo($product->id)->image_path }}" alt="Image Feature">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="/products/{{$product->id}}">
                                <h3 class="product-name">{{ $product->name }}</h3>
                            </a>
                            <div class="product-price">
                                <span class="import-price">
                                    {{ __('messages.import_price') }}{{ ': '.number_format($product->price,0,".",".") }} <sup>đ</sup>
                                </span>
                                <span class="sale-price">
                                    {{ __('messages.price_sale') }}{{ ': '.number_format($product->sale_price,0,".",".") }} <sup>đ</sup>
                                </span>
                            </div>
                        </div>

                        <div class="product-action">
                            <a href="/products/{{ $product->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                            <form action="/products/{{ $product->id }}" method="POST" class="form-delete">
                                @method('delete')
                                {{ csrf_field() }}
                                <button type="submit" class="btn-action btn-delete">{{ __('messages.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
