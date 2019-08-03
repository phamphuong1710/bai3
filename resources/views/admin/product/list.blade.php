@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">

@endsection
@section('content')



    <div class="product-grid">
        <div class="list-title">
            <h2>{{ __('messages.list_product') }}</h2>
        </div>
        <div class="store-action">
            <div class="action-top d-flex justify-content-between align-items-center">
                <a href="/shop//create-product" class="create create-store">
                    {{ __('messages.createproduct') }}
                </a>
                <div class="form-search search-product">
                    <input type="search" name="product" id="input-product">
                    <button type="submit" class="fa fa-search btn-search btn-search-product"></button>

                </div>
            </div>
            <div class="action-bottom d-flex justify-content-between align-items-center">
                <span class="count-store">
                    {{ count($products).' '.__('messages.product') }}
                </span>
                <div class="form-filter">
                    <div class="form-group">

                        <select class="form-control" id="product-category" name="category">
                            <option value="0">{{ __('messages.filter_category') }}</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-product">

            <div class="list-product-wrapper ajax-search-html">
                @foreach( $products as $product )
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
                                    {{ __('messages.import_price').': ' }}
                                    <span class="price" price="{{ $product->price }}">{{ number_format($product->price,0,".",".") }}</span>
                                    <span class="currency">{{ __('messages.curentcy') }}</span>
                                </span>
                                <span class="sale-price">
                                    {{ __('messages.price_sale').' :' }}
                                    <span class="price" price="{{ $product->sale_price }}">{{ number_format($product->sale_price,0,".",".") }}</span>
                                    <span class="currency">{{ __('messages.curentcy') }}</span>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/delete-product.js') }}"></script>
<script src="{{ asset('js/admin/search-product-by-user.js') }}"></script>
@if( app()->getLocale() == 'en' )
<script src="{{ asset('js/admin/currency.js') }}"></script>
@endif
<script src="{{ asset('js/admin/filter-category.js') }}"></script>
@endsection
