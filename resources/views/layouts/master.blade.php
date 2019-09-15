<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/poppins.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home/style.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/ionicon.css') }}">
        <link href="{{ asset('css/home/front-page.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home/header.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/home/footer.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/home/button.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/home/quantity.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home/mini-cart.css') }}" rel="stylesheet">

        @yield('style')
    </head>
    <body>
        <div class="page-loading">
            <div class="loader">

            </div>
        </div>
        <header class="site-header">
            <div class="header-top">
                <div class="container">
                    <div class="top-bar-content">
                        <div class="wellcome">
                            <span class="wellcome-text">
                                {{ __('messages.welcome_text') }}
                            </span>
                        </div>
                        <div class="menu-topbar">
                            <ul class="menu-top">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myModal1">
                                        <span class="ion-ios-bell" aria-hidden="true"></span>Track Order</a>
                                    </li>
                                    @if (Route::has('login'))
                                        @auth
                                        <li class="user user-dropdown">
                                            @php
                                                $username = Auth::user()->name;
                                            @endphp
                                            {{ $username }}
                                            <ul class="list-user-action">
                                                <li class="user-action-item">
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-user btn-sing-out ">
                                                        <span class="ion-power"></span>
                                                        {{ __('messages.sing_out') }}</button>
                                                    </form>
                                                </li>
                                                <li class="user-action-item">
                                                    <span class="profile" data-user="{{ Auth::id() }}">
                                                        {{ __('messages.profile') }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>
                                        @else
                                        <li>
                                            <a href="{{ route('login') }}" class="user-login">
                                                <span class="ion-person"></span>
                                                {{ __('messages.sing_in') }}
                                            </a>
                                        </li>
                                            @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}" class="btn-register" >
                                                    <span class="ion-android-create"></span>
                                                    {{ __('messages.register') }}
                                                </a>
                                            </li>
                                            @endif
                                        @endauth
                                    @endif


                                <li><a href="{{ url('locale/en') }}">EN</a></li>
                                <li><a href="{{ url('locale/vi') }}" >VI</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //top-header -->
                <!-- header-bot-->
                <div class="header-action">
                    <div class="container">
                        <div class="header-action-wrapper">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <span class="logo-text">
                                        {{ config('app.name') }}
                                    </span>
                                </a>
                            </div>
                            <div class="header-search">
                                <form action="{{ route('search') }}" method="post">
                                    @csrf
                                    <input name="search" type="search" placeholder="{{ __('messages.search_header') }}" required class="input-serach-header">
                                    <button type="submit" class="btn-search ion-android-search" aria-label="Left Align">
                                    </button>
                                </form>
                            </div>
                            <div class="site-header-contact">
                                <ul class="list-contact">
                                    <li class="item-contact item-phone">
                                        <span class="ion-ios-telephone" aria-hidden="true">001 234 5678</span>
                                    </li>
                                    <li class="item-contact item-email">
                                        <span class="email ion-ios-email">
                                            info@camp.com
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigation-header">
                <div class="container">
                    <div class="main-menu-wrapper">
                        <div class="navigation-menu">
                            <nav class="main-navigation navbar-default" id="site-navigation">
                                <button type="button" class="menu-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                                {!! getMenuTeamplate() !!}
                            </nav>
                        </div>

                        <div class="cart">
                            <span class="ion-bag icon-cart">
                                @if(Auth::id())
                                    @if( Session::get('cart')['quantity'] )
                                        <sup class="count cart-quantity">{{ Session::get('cart')['quantity'] }}</sup>
                                    @else
                                        <sup class="count cart-quantity">0</sup>
                                    @endif
                                @else
                                <sup class="count cart-quantity">0</sup>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
        <div id="shop-overlay"></div>
        @auth
        <div class="edit-popup-overlay">
            <div id="edit-popup">
                <div class="edit-popup-wrapper">

                </div>
            </div>
        </div>
        @endauth
        @guest
            <div class="login-wrapper" id="login">
                <div class="login-form">

                </div>
                <span class="close-form-login ion-android-close"></span>
            </div>
            @if (Route::has('register'))
            <div class="register-wrapper" id="register">
                <div class="register-form"></div>
                <span class="close-form-register ion-android-close"></span>
            </div>
            @endif
        @endguest
        <div id="shop-cart-sidebar">
            <div class="cart-sidebar-head">
                <h4 class="cart-sidebar-title">Shopping cart</h4>
                    @if ( Session::get('cart')['quantity'] )
                        <span class="count">{{ Session::get('cart')['quantity'] }}</span>
                    @else
                        <span class="count">0</span>
                    @endif

                <button id="close-cart-sidebar" class="ion-android-close"></button>
            </div>
            <div class="cart-sidebar-content">
                <ul class="list-product-in-cart product-item-action">
                    @if ( Session::get('cart')['product'] )
                        @php
                            $cart = Session::get('cart');
                        @endphp
                    <form class="update-cart" action="{{ route('update-cart', [ 'id' => $cart['id']]) }}" method="post" enctype="multipart/form-data">


                        @foreach( Session::get('cart')['product'] as $product )
                        <li class="mini-cart-item cart-item">
                            <div class="product-minnicart-info">
                                <span class="mincart-product-name">
                                    {{ $product->name }}
                                </span>


                                <div class="quantity-mini-cart quantity">
                                    <span class="modify-qty dec ion-android-remove"></span>
                                    <input type="number" class="input-text qty text"  min="1" max="" name="quantity[{{ $product->id }}]" value="{{ $product->quantity }}">
                                    <span class="modify-qty inc ion-android-add"></span>
                                </div>

                            </div>
                            <span class="minicart-product-price">
                                @if( app()->getLocale() == 'en' )
                                    {{ '$'.$product->usd }}
                                @endif
                                @if( app()->getLocale() == 'vi' )
                                    {{ 'đ'.$product->vnd }}
                                @endif
                            </span>
                            <div class="product-minicart-logo">
                                <img src="{{ $product->logo }}" alt="{{ $product->name }}">
                            </div>
                            <span class="remove_from_cart_button ion-android-close delete-product" product="{{ $product->id }}"></span>
                        </li>
                        @endforeach
                    </form>
                    @else
                    <h6>{{ __('messages.no_product') }}</h6>
                    @endif

                </ul>
            </div>
            <div class="subpay">
                <span class="label">{{ __('messages.total').':' }}</span>
                @if( app()->getLocale() == 'en' )
                <span class="total-price">$
                    {{ Session::get('cart')['usd'] - Session::get('cart')['discount_usd'] }}
                </span>
                @endif
                @if( app()->getLocale() == 'vi' )
                <span class="total-price">đ
                    {{ Session::get('cart')['vnd'] - Session::get('cart')['discount_vnd'] }}
                </span>
                @endif
            </div>
            <div class="mini-cart-action">
                <a href="{{ route('cart') }}" class="btn btn-view-cart">{{ __('messages.view_cart') }}</a>
                <a href="{{ route('checkout') }}" class="btn btn-view-checkout">{{ __('messages.checkout') }}</a>
            </div>
        </div>

        <!-- footer -->
        <footer class="footer">
            <div class="container">

                <!-- footer third section -->
                <div class="footer-info">
                    <div class="row">
                        <!-- quick links -->
                        <div class="col-md-3 footer-grids">
                            <h3>Quick Links</h3>
                            <ul>
                                <li>
                                    <a href="about.html">About Us</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact Us</a>
                                </li>
                                <li>
                                    <a href="help.html">Help</a>
                                </li>
                                <li>
                                    <a href="faqs.html">Faqs</a>
                                </li>
                                <li>
                                    <a href="terms.html">Terms of use</a>
                                </li>
                                <li>
                                    <a href="privacy.html">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 footer-grids">
                            <h3>Get in Touch</h3>
                            <ul class="contact-footer">
                                <li class="ion-android-pin">123 Sebastian, USA.</li>
                                <li class="ion-ios-telephone"></i> 333 222 3333 </li>
                                <li class="ion-email">
                                    <a href="mailto:example@mail.com"> mail@example.com</a>
                                </li>
                            </ul>
                        </div>
                         <!-- //quick links -->
                        <!-- social icons -->

                        <div class="social col-md-3 footer-grids">
                            <h3>Follow Us on</h3>
                            <ul>
                                <li>
                                    <a class="icon fb" href="#">
                                        <i class="ion-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon tw" href="#">
                                        <i class="ion-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon gp" href="#">
                                        <i class="ion-social-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="agileits_app-devices col-md-3  footer-grids">
                            <h3>Download the App</h3>
                            <a href="#">
                                <img src="{{ asset('images/1.png') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('images/2.png') }}" alt="">
                            </a>
                            <div class="clearfix"> </div>
                        </div>
                        <!-- //social icons -->
                    </div>
                </div>
                <!-- //footer third section -->
            </div>
        </footer>
        <!-- //footer -->
        <!-- copyright -->
        <div class="copy-right">
            <div class="container">
                <span class="copy-right-text">© 2018 Grocery Shoppy. All rights reserved | Design by
                    <a href="http://w3layouts.com/"> W3layouts.</a>
                </span>
            </div>
        </div>
        <span class="btn-back-to-top ion-chevron-up"></span>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/home/app.js') }}"></script>
        <script src="{{ asset('js/home/navigation.js') }}"></script>
        <script src="{{ asset('js/home/quantity.js') }}"></script>
        <script src="{{ asset('js/home/update-cart.js') }}"></script>
        <script src="{{ asset('js/home/profile.js') }}"></script>
        @yield('js')
    </body>
</html>
