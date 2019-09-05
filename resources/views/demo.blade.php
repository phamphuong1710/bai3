
@section('style')
<link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
<link href="{{ asset('css/home/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-checkout checkout-detail">
    <div class="container">
        <div class="cart-detail-wrapper">
            <div class="order-detail">
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
                        @foreach( $cart['product'] as $product )
                        <tr class="cart-item">
                            <td class="product-image">
                                <div class="product-thumb">
                                    <img src="{{ $product->logo }}" alt="{{ $product->name }}" class="product-logo">
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
                        <tr class="cart-total">
                            <td class="total-label" colspan="6"> {{ __('messages.total') }}</td>
                            <td class="total-price">

                                @if( app()->getLocale() == 'en' )
                                    {{ '$'.($cart['usd'] - $cart['discount_usd']) }}
                                @else
                                    {{ 'đ'.($cart['vnd'] - $cart['discount_vnd']) }}
                                @endif
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <form class="update-cart" action="" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="billing">{{ __('messages.billing') }}</h2>
                <div class="form-group">
                    <label for="name">{{ __('messages.name') }}</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('messages.phone') }}</label>
                    <input type="text" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="address" class=" col-form-label text-md-right">{{ __('messages.address') }}</label>
                    <div class="">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div id="map"></div>
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">
                    </div>
                </div>

                <button type="submit">Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&libraries=places&anguage=vi&region=VI"></script>
<script src="{{ asset('js/admin/google-map.js') }}"></script>
<script src="{{ asset('js/home/distance.js') }}"></script>
@endsection -->
@extends('pages.order')
@section('order')
    <div class="featured-section" id="projects">
        <div class="container">
            <h3 class="tittle-w3l">
                Thông tin đơn đặt hàng
            </h3>
            <div class="bs-docs-example">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Món</th>
                        <th>Giá</th>
                        <th>Tên Cửa hàng</th>
                        <th>Địa Chhỉ</th>
                        <th>Hình Ảnh</th>
                        <th>Số Lượng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $count = 0;
                        $sum = 0;
                    @endphp
                    @foreach ($productAll as $product)
                        @php
                            $count++;
                            $sum += $product->price*$carts[$count]['quantity'];
                        @endphp
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ productPrice($product->price) }}</td>
                            <td>{{ $product->store->name }}</td>
                            <td>{{ $product->store->address }}</td>
                            <td><img class="height-img" src="{{ url($product->image? 'uploads/'.$product->image:'store/logo2.png') }}"
                                     alt="{{ $product->name }}"/></td>
                            <td>{{ $carts[$count]['quantity'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <style>
                #km,#sum{
                    color: #cf2127!important;
                }
                .distance{
                    font-size: 12px;
                    color: #cf2127;
                    font-weight: 700;
                }
            </style>
            {!! Form::open(['method' => 'POST', 'route' => 'home.order.create']) !!}
                <div class="row info-order">
                    <div class="col-md-2">
                        <p class="ship">Phí ship: 5.000/km</p>
                    </div>
                    <div class="col-md-4">
                        <p total-ship>Tổng số km: <strong id="km">0</strong>km</p>
                    </div>
                    <div class="col-md-4">
                        <p class="total-order">Phí Ship: <strong class="" id="sum">{{($sum)}} </strong></p>
                        <p></p>
                    </div>
                    <div id="quangduong" class="col-md-12">
                    </div>

                </div>
            {{ Form::hidden('stores',$stores , array('id' => 'stores')) }}
            {{ Form::hidden('total',null , array('id' => 'total')) }}
            {{ Form::hidden('pLat', null, array('id' => 'lat')) }}
            {{ Form::hidden('pLng', null , array('id' => 'lng')) }}
            <div class="form-group">
                {{ Form::label( __('validation.col.name'), null, ['class' => 'control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label( __('validation.col.phone'), null, ['class' => 'control-label']) }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group required" id="pac-card">
                {!! Form::label(__('validation.col.address'),null,['class'=>'col-form-label']) !!}
                <div class="" id="pac-container">
                    {!! Form::text('address',null,['id' => 'pac-input', 'required', 'class'=>'form-control'.($errors->has('address')? 'is-invalid':''),'autofocus']) !!}
                    {!! $errors->first('address','<span class="invalid-feedback">:message</span>') !!}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label( __('validation.col.email'), null, ['class' => 'control-label']) }}
                {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group row">
                <div class="col-md-3 col-lg-2"></div>
                <div class="col-md-8">
                    <a href="{{url('/')}}" class="btn btn-danger">
                        {{ __('validation.action.back') }}</a>
                    {!! Form::button(__('validation.action.save'),['type' =>'submit','class'=>'btn
                btn-primary'])!!}
                </div>
            </div>
            {!! Form::close() !!}

            <div class="row">
                <div class="col-md-12"  id="map" style="height: 400px"></div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&callback=initMap&key=AIzaSyBOrpaa9ECnY2JUib0NWv3QXH21JMvc-p4"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOrpaa9ECnY2JUib0NWv3QXH21JMvc-p4&libraries=places&callback=initMap" async defer></script>
    <script>
        var responses = [];
        document.getElementById("quangduong").innerHTML = '';
        function showSteps(directionResult) {
            var myRoute = directionResult.routes[0].legs[0];
            var instructions = '<h3 class="distance">' + myRoute.distance.text + '</h3><br>';
            document.getElementById("quangduong").innerHTML += instructions;
        }
        function calculateAndDisplayRoute(directionsService, map, pointA, pointB) {
            directionsService.route({
                origin: pointA,
                destination: pointB,
                avoidTolls: false,
                avoidHighways: false,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    var directionsDisplay = new google.maps.DirectionsRenderer({
                        map: map,
                        suppressMarkers: true,
                        // preserveViewprot: true
                    });
                    responses.push(response);
                    if (responses.length > 0) {
                        for (var i = 0; i < (responses.length - 1); i++) {
                            response.routes[0].bounds.union(responses[i].routes[0].bounds)
                            for (var j = 0; j < responses[i].routes[0].legs.length; j++)
                                response.routes[0].legs.push(responses[i].routes[0].legs[j]);
                        }
                        directionsDisplay.setDirections(response);
                    }
                    showSteps(response);
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            });

        }
        function initMap() {
            document.getElementById("quangduong").innerHTML = '';
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 21.0166589, lng: 105.7818972},
                zoom: 13
            });
            var input = document.getElementById('pac-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            autocomplete.setFields(
                ['address_components', 'geometry', 'icon', 'name']);
            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            var directionsService = new google.maps.DirectionsService();

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        // codeLatLng(latitude, latitude);
                        // console.log(latitude);
                        // pLat = latitude;
                        // pLng = longitude;
                        // $('#lat').val(latitude);
                        // $('#lng').val(longitude);
                        // // codeLatLng(latitude, longitude);
                        var pointA = new google.maps.LatLng(latitude, longitude);
                        markerA = new google.maps.Marker({
                            position: pointA,
                            title: "Khách đặt hàng",
                            label: "Khách đặt hàng",
                            map: map
                        });
                        var point = [];
                        var marker = [];
                        var dataStores = $('#stores').val();
                        dataStores = JSON.parse(dataStores);
                        document.getElementById("quangduong").innerHTML = '';
                        $.each(dataStores, function(i,row){
                            point[i] = new google.maps.LatLng(row.lat, row.lng);
                            marker[i] = new google.maps.Marker({
                                position: point[i],
                                title: row.name,
                                label: row.name,
                                map: map
                            });
                            calculateAndDisplayRoute(directionsService, map, point[i], pointA);

                        });
                        // point = [];
                        // marker = [];
                        // responses = [];
                        dataStores = '';
                        // dataStores = JSON.parse(dataStores);
                        // tinhtien();
                    }else{
                        alert('không hiển thị được')
                    }
                });
                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = address;
                infowindow.open(map, marker);
            });


        }
        $('#quangduong').bind("DOMSubtreeModified",function(){
            var sum = 0;
            $(".distance").each(function() {
                sum += parseFloat($(this).text());
            });
            console.log(sum);
            $("#km").text(sum);
            var cart = parseFloat($("#sum").text());
            var total = sum*5000 + cart;
            $("#km").text(sum);
            $("#total").val(total);
            total = 0;
            sum = 0;
        });
    </script>

@endsection


            <div class="side-bar col-md-3">
                <div class="search-product">
                    <h3 class="widget-title">{{ __('messages.search_product') }}</h3>
                    <form action="/search/product" method="post" class="form-search-sidebar">
                        @csrf
                        <input type="search" placeholder="Product name..." name="search" required class="input-search-sidebar">
                        <button type="submit" class="btn btn-search" aria-label="Left Align">
                            <span class="btn-main">
                                <span class="btn-default ion-android-search"></span>
                                <span class="text-hover ion-android-search"></span>
                                <span class="btn-hover"></span>
                            </span>
                        </button>
                    </form>
                </div>

                <!-- reviews -->
                <div class="customer-rev left-side">
                    <h3 class="widget-title">Customer Review</h3>
                    <ul>
                        <li>
                            <a href="/store/rating/5">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <span>5.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="/store/rating/4">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>4.0</span>
                            </a>
                        </li>

                        <li>
                            <a href="/store/rating/3">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>3.0</span>
                            </a>
                        </li>
                        <li>
                            <a href="store/rating/2">
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <i class="ion-android-star-outline" aria-hidden="true"></i>
                                <span>2</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //reviews -->
                <!-- discounts -->
                <div class="left-side">
                    <h3 class="widget-title">Discount</h3>
                    <ul>

                        <li>
                            <a href="/products/discount/20">
                                <span class="span">20% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/30">
                                <span class="span">30% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/40">
                                <span class="span">40% or More</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products/discount/50">
                                <span class="span">50% or More</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- //discounts -->


                <!-- //deals -->
            </div>
