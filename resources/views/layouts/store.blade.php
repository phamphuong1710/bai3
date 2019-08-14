@extends('layouts.master')
@section('style')
<link href="{{ asset('css/ionicon.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/product-single.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="single-product">
    <div class="single-page-header">
        <div class="breadcrumb-app">
            <div class="container">
                <ul class="breadcrumb-nav">
                    <li class="crumb">
                        <a href="/">{{ __('messages.home') }}</a>
                    </li>

                    <li class="crumb">
                        <span>{{ $store->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">


    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/home/product-slider.js') }}"></script>
    <script src="{{ asset('js/home/quantity.js') }}"></script>
    <script src="{{ asset('js/home/rating.js') }}"></script>
@endsection
