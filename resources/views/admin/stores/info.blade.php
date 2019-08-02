@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
@endsection
@section('content')
@if (session('success_delete'))
<div class="alert alert-success">
    {{ session('success_delete') }}
</div>
@endif
@if (session('success_update_product'))
<div class="alert alert-success">
    {{ session('success_update_product') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="shop-item-section">
    <div class="shop-detail">
        <h1 class="page-title header">{{ $store->name }}</h1>
    </div>
    <div class="store-info">
        <div class="store-info-wrapper">
            <p class="store-address">
                <span class="label">{{ __('messages.address') }}: </span>
                {{ $store->address }}
            </p>
            <p class="store-phone">
                <span class="label">{{ __('messages.phone') }}: </span>
                {{ $store->phone }}
            </p>
            <p class="store-description">
                <span class="label">{{ __('messages.description') }}: </span>
                {{ $store->description }}
            </p>
        </div>
    </div>
    <div class="all-product">
        <div class="store-action">
            <div class="action-top d-flex justify-content-between align-items-center">
                <a href="/stores/create" class="create create-store">
                    {{ __('messages.create_store') }}
                </a>
                <div class="form-search search-store">
                    <input type="search" name="store" id="input-store">
                    <button type="submit" class="fa fa-search btn-search"></button>
                </div>
            </div>
            <div class="action-bottom">
                <span class="count-store"></span>
                <div class="form-filter">
                    <div class="form-group">

                        <select class="form-control" id="exampleFormControlSelect1">
                            <option value="0">{{ __('messages.category') }}</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-product">
            <div class="list-title">
                <h2>{{ __('messages.list_product') }}</h2>
                <a href="/shop/{{ $store->id }}/create-product" class="create">
                    {{ __('messages.createproduct') }}
                </a>
            </div>

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
                                <button type="submit" class="btn-action btn-delete btn-delete-product" data-id="{{ $product->id }}">{{ __('messages.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="pagination">
                    {{ $store->products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/delete-product.js') }}"></script>
@endsection
