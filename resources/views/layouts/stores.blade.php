@extends('layouts.master')
@section('style')

@endsection
@section('content')
<div class="list-store">
    <div class="single-page-header">
        <div class="breadcrumb-app">
            <div class="container">
                <ul class="breadcrumb-nav">
                    <li class="crumb">
                        <a href="/">{{ __('messages.home') }}</a>
                    </li>

                    <li class="crumb">
                        <span>{{ $stores->star }} Star</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="related-product">
            <h2>Store</h2>
            <div class="row">
                @foreach($stores as $store)
                <div class="col-md-3 product-men">
                    <div class="men-pro-item simpleCart_shelfItem">
                        <div class="men-thumb-item">
                            <a href="/store/{{ $store->slug }}">
                                <img src="{{ getStoreLogo($store->id)->image_path }}" alt="Image Product">
                            </a>
                        </div>
                        <div class="item-info-product ">
                            <h4>
                            <a href="/store/{{ $store->slug }}">{{ $store->name }}</a>
                            </h4>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $stores->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')

@endsection
