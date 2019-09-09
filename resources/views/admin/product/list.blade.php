@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/list-product.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="product-grid">
        <div class="list-title">
            <h2>{{ __('messages.list_product') }}</h2>
        </div>
        <div class="store-action">
            <div class="action-top d-flex justify-content-between align-items-center">

                <div class="form-search search-product">
                    <input type="search" name="product" id="input-product">
                    <button type="submit" class="fa fa-search btn-search btn-search-product"></button>

                </div>
            </div>
            <div class="action-bottom d-flex justify-content-between align-items-center">
                <span class="count-store">
                    <span class="product-number">{{ count($products) }}</span>{{ ' '.__('messages.product') }}
                </span>
                <div class="form-filter d-flex justify-content-between align-items-center">
                    <div class="form-group">
                        <select class="form-control" id="product-category" name="category">
                            <option value="0">{{ __('messages.filter_category') }}</option>
                            @foreach( $categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="sorting" name="category">
                            <option value="created_at-asc">
                                {{ __('messages.sort_date_asc') }}</option>
                            <option value="name-asc">
                                {{ __('messages.sort_name_asc') }}
                            </option>
                            <option value="sale_price-asc">
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
                            <option value="sale_price-desc">
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
                @foreach( $products as $product )
                <div id="product-{{ $product->id }}" class="product product-admin">
                    <div class="product-content">
                        <div class="image-product-wrapper">
                            <a href="/products/{{$product->id}}">
                                @foreach( $product->media->where('active', 1) as $logo )
                                <img src="{{ $logo->image_path }}" alt="Image Feature">
                                @endforeach
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="/products/{{$product->id}}">
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
                            <a href="/products/{{ $product->id }}/edit" class="btn-action btn-edit" data-id="{{ $product->id }}" controller="products">{{ __('messages.edit') }}</a>
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
                    {{ $products->links() }}
                </div>
                <div class="edit-popup-overlay" id="edit-popup">
                    <div class="edit-popup"  data-edit="products">
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
<!-- edit -->

<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/admin/remove.js') }}"></script>
<script src="{{ asset('js/admin/create-logo.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>
<script src="{{ asset('js/admin/create-images.js') }}"></script>
<script src="{{ asset('js/admin/delete-image.js') }}"></script>
<script src="{{ asset('js/admin/edit-image.js') }}"></script>
<script src="{{ asset('js/admin/delete-product.js') }}"></script>
<script src="{{ asset('js/admin/filter-product-user.js') }}"></script>
<script src="{{ asset('js/admin/edit-popup.js') }}"></script>
<script src="{{ asset('js/admin/currency.js') }}"></script>
@endsection
