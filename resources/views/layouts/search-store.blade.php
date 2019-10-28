@extends('layouts.master')
@section('style')
@endsection
@section('content')
<div class="font-page page-content">

    <div class="ads-grid">
        <div class="container">

            @if($stores)

            <div class="related-store">
                <h2>Store</h2>
                <div class="row">
                    @foreach($stores as $store)
                            <div class="col-md-3 product-men">
                                <div class="store-item item-pro">
                                    <div class="men-thumb-item">
                                        <a href="/store/{{ $store->slug }}">
                                            <img src="{{ $store->logo }}" alt="{{ $store->name }}">
                                        </a>
                                    </div>
                                    <div class="item-info-product ">
                                        <h4 class="item-name">
                                        <a href="/store/{{ $store->slug }}">{{ Str::words($store->name, 3) }}</a>
                                        </h4>
                                        <span class="store-address">
                                            {{  Str::words($store->address->address, 4) }}
                                        </span>
                                        @php
                                            $avg = $store->rating_average;
                                            $p = ( $avg / 5 ) * 100;
                                        @endphp
                                        <div class="wt-star-rating">
                                            <span class="star-reviewed" style="width: {{ $p }}%">
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>

            </div>
            @endif
        </div>
    </div>

</div>
@endsection
@section('js')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
