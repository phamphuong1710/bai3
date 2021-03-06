@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
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
            <div class="logo-store d-flex justify-content-center">
                @foreach( $store->media->where('active', 1) as $logo )
                <img src="{{ $logo->image_path }}" alt="{{ 'Logo '.$store->name }}">
                @endforeach
            </div>
            <p class="store-address">
                <span class="label">{{ __('messages.address') }}: </span>
                {{ $store->address->address }}
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
        <div class="list-title">
            <h2>{{ __('messages.list_product') }}</h2>
        </div>
        <div class="store-action">
            <div class="action-top d-flex justify-content-between align-items-center">
                <a href="/shop/{{ $store->id }}/create-product" class="create create-store">
                    {{ __('messages.createproduct') }}
                </a>
                <div class="form-search search-product">
                    <input type="search" name="product" id="input-product">
                    <button type="submit" class="fa fa-search btn-search btn-search-product"></button>
                    <input type="hidden" value="{{ $store->id }}" name="store" id="store-id">
                </div>
            </div>
            <div class="action-bottom d-flex justify-content-between align-items-center">
                <span class="count-store">
                    <span class="product-number">{{ count($store->products) }}</span> {{' '.__('messages.product') }}
                </span>
                <div class="form-filter d-flex justify-content-between align-items-center">
                    <div class="form-group">
                        <select class="form-control" id="product-category" name="category">
                            <option value="">{{ __('messages.filter_category') }}</option>
                            @foreach( $categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="sorting">
                            <option value="created_at-asc">
                                {{ __('messages.sort_date_asc') }}</option>
                            <option value="name-asc">
                                {{ __('messages.sort_name_asc') }}
                            </option>
                            <option value="usd-asc">
                                {{ __('messages.sort_price_asc') }}
                            </option>
                            <option value="rating_average-asc">
                                {{ __('messages.sort_rating_asc') }}
                            </option>
                            <option value="name-desc">
                                {{ __('messages.sort_name_desc') }}
                            </option>
                            <option value="created_at-desc">
                                {{ __('messages.sort_date_desc') }}
                            </option>
                            <option value="usd-desc">
                                {{ __('messages.sort_price_desc') }}
                            </option>
                            <option value="rating_average-desc">
                                {{ __('messages.sort_rating_desc') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-product">
            <div class="list-product-wrapper ajax-search-html">
                @foreach( $store->products as $product )
                <div id="product-{{ $product->id }}" class="product product-admin">
                    <div class="product-content">
                        <div class="image-product-wrapper">
                            <a href="/products/{{$product->slug}}">
                                @foreach ( $product->media->where( 'active', 1 ) as $logo )
                                <img src="{{ $logo->image_path }}" alt="Image Feature">
                                @endforeach
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="/products/{{$product->slug}}">
                                <h3 class="product-name">{{ $product->name }}</h3>
                            </a>
                            <div class="product-price">
                                <span class="sale-price">
                                    @if( app()->getLocale() == 'en' )
                                    <span class="price" price="{{ $product->price }}">{{ number_format($product->usd, 2, '.', '.') }}</span>
                                    <span class="currency">{{ __('messages.curentcy') }}</span>
                                    @endif

                                    @if( app()->getLocale() == 'vi' )
                                    {{ __('messages.price_sale').' :' }}
                                    <span class="price" price="{{ $product->sale_price }}">{{ number_format($product->vnd,0,'.','.') }}</span>
                                    <span class="currency">{{ __('messages.curentcy') }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="product-action">
                            <a href="/products/{{ $product->id }}/edit" class="btn-action btn-edit"  data-id="{{ $product->id }}" controller="products">{{ __('messages.edit') }}</a>
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
                <div class="edit-popup-overlay" id="edit-popup">
                    <div class="edit-popup" data-edit="products">
                        <div class="edit-popup-wrapper edit-product">

                        </div>
                        <span class="btn-close-popup fa fa-close"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="library-image-wrapper">
    <div class="library-image-content">
        <ul id="image-library" class="list-old-image imageby-user">

        </ul>
        <div class="library-action">
            <div class="library-action-wrapper">
                <button class="btn btn-close">{{ __('messages.close') }}</button>
                <button class="btn btn-images-choose">{{ __('messages.insert') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/admin/remove.js') }}"></script>
<script src="{{ asset('js/admin/create-logo.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>
<script src="{{ asset('js/admin/create-images.js') }}"></script>
<script src="{{ asset('js/admin/delete-image.js') }}"></script>
<script src="{{ asset('js/admin/edit-image.js') }}"></script>
<script src="{{ asset('js/admin/delete-product.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
<script src="{{ asset('js/admin/filter-product.js') }}"></script>
@endsection
