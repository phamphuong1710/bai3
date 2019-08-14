@extends('layouts.master')
@section('style')
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="font-page page-content">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            @foreach( getTopDiscountProduct() as $product )
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $product->store->name }}</h5>
                    <p>Discount up to {{ $product->on_sale.'%' }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="ads-grid">
        <div class="container">
            <div class="related-product">
                <h2>Search For Product</h2>
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item simpleCart_shelfItem">
                            <div class="men-thumb-item">
                                <a href="/products/{{ $product->slug }}">
                                    <img src="{{ getProductLogo($product->id)->image_path }}" alt="Image Product">
                                </a>
                                <div class="men-cart-pro">
                                    <div class="inner-men-cart-pro">
                                        <a href="/products/{{ $product->slug }}" class="link-product-add-cart">{{ __('messages.quick_view') }}</a>
                                    </div>
                                </div>
                                <span class="product-new-top">{{ __('messages.new') }}</span>
                            </div>
                            <div class="item-info-product ">
                                <h4>
                                <a href="/products/{{ $product->slug }}">{{ $product->name }}</a>
                                </h4>
                                @if( app()->getLocale() == 'en' )
                                <div class="info-product-price">
                                    @if( $product->on_sale != 0 )
                                    <span class="item_price">{{ $product->usd - ( $product->on_sale / 100 * $product->usd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                    <del>{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                    @else
                                    <span class="item_price">{{ $product->usd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                    @endif
                                </div>
                                @endif
                                @if( app()->getLocale() == 'vi' )
                                <div class="info-product-price">
                                    @if( $product->on_sale != 0 )
                                    <span class="item_price">{{ $product->vnd - ( $product->on_sale / 100 * $product->vnd ) }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                    <del>{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></del>
                                    @else
                                    <span class="item_price">{{ $product->vnd }}<span class="currency">{{ __('messages.curentcy') }}</span></span>
                                    @endif
                                </div>
                                @endif
                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                    <form action="#" method="post">
                                        <fieldset>
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="add" value="1">
                                            <input type="hidden" name="business" value=" ">
                                            <input type="hidden" name="item_name" value="Almonds, 100g">
                                            <input type="hidden" name="amount" value="149.00">
                                            <input type="hidden" name="discount_amount" value="1.00">
                                            <input type="hidden" name="currency_code" value="USD">
                                            <input type="hidden" name="return" value=" ">
                                            <input type="hidden" name="cancel_return" value=" ">
                                            <input type="submit" name="submit" value="Add to cart" class="button">
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

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

            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="col-xs-8 agile-leftmk">
                <h2>Get your Groceries delivered from local stores</h2>
                <p>Free Delivery on your first order!</p>
                <form action="#" method="post">
                    <input type="email" placeholder="E-mail" name="email" required>
                    <input type="submit" value="Subscribe">
                </form>
                <div class="newsform-w3l">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //newsletter -->
</div>
@endsection
@section('js')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
