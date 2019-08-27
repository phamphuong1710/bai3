<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/home/style.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/ionicon.css') }}">
        <link href="{{ asset('css/home/front-page.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home/header.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/home/button.css') }}" rel="stylesheet" >
        @yield('style')
    </head>
    <body>
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
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-user btn-sing-out ">
                                                <span class="ion-power"></span>
                                                {{ __('messages.sing_out') }}</button>
                                            </form>
                                        </li>
                                        @else
                                        <li>
                                            <a href="{{ route('login') }}">
                                                <span class="ion-person"></span>
                                                {{ __('messages.sing_in') }}
                                            </a>
                                        </li>
                                            @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}" data-toggle="modal" data-target="#myModal1" >
                                                    <span class="ion-android-create"></span>
                                                    {{ __('messages.register') }}
                                                </a>
                                            </li>
                                            @endif
                                        @endauth
                                    @endif
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
                                    <button type="submit" class="btn btn-search" aria-label="Left Align">
                                    <span class="btn-main">
                                        <span class="btn-default ion-android-search"></span>
                                        <span class="text-hover ion-android-search"></span>
                                        <span class="btn-hover"></span>
                                    </span>
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
        <!-- footer -->
        <footer>
            <div class="container">
                <!-- footer first section -->
                <!-- //footer first section -->
                <!-- footer second section -->
                <div class="w3l-grids-footer">
                    <div class="col-xs-4 offer-footer">
                        <div class="col-xs-4 icon-fot">
                            <span class="fa fa-map-marker" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-8 text-form-footer">
                            <h3>Track Your Order</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-xs-4 offer-footer">
                        <div class="col-xs-4 icon-fot">
                            <span class="fa fa-refresh" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-8 text-form-footer">
                            <h3>Free & Easy Returns</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-xs-4 offer-footer">
                        <div class="col-xs-4 icon-fot">
                            <span class="fa fa-times" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-8 text-form-footer">
                            <h3>Online cancellation </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- //footer second section -->
                <!-- footer third section -->
                <div class="footer-info w3-agileits-info">
                    <!-- footer categories -->
                    <div class="col-sm-5 address-right">
                        <div class="col-xs-6 footer-grids">
                            <h3>Categories</h3>
                            <ul>
                                <li>
                                    <a href="product.html">Grocery</a>
                                </li>
                                <li>
                                    <a href="product.html">Fruits</a>
                                </li>
                                <li>
                                    <a href="product.html">Soft Drinks</a>
                                </li>
                                <li>
                                    <a href="product2.html">Dishwashers</a>
                                </li>
                                <li>
                                    <a href="product.html">Biscuits & Cookies</a>
                                </li>
                                <li>
                                    <a href="product2.html">Baby Diapers</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 footer-grids agile-secomk">
                            <ul>
                                <li>
                                    <a href="product.html">Snacks & Beverages</a>
                                </li>
                                <li>
                                    <a href="product.html">Bread & Bakery</a>
                                </li>
                                <li>
                                    <a href="product.html">Sweets</a>
                                </li>
                                <li>
                                    <a href="product.html">Chocolates & Biscuits</a>
                                </li>
                                <li>
                                    <a href="product2.html">Personal Care</a>
                                </li>
                                <li>
                                    <a href="product.html">Dried Fruits & Nuts</a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- //footer categories -->
                    <!-- quick links -->
                    <div class="col-sm-5 address-right">
                        <div class="col-xs-6 footer-grids">
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
                        <div class="col-xs-6 footer-grids">
                            <h3>Get in Touch</h3>
                            <ul>
                                <li>
                                <i class="fa fa-map-marker"></i> 123 Sebastian, USA.</li>
                                <li>
                                <i class="fa fa-mobile"></i> 333 222 3333 </li>
                                <li>
                                <i class="fa fa-phone"></i> +222 11 4444 </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    <a href="mailto:example@mail.com"> mail@example.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //quick links -->
                    <!-- social icons -->
                    <div class="col-sm-2 footer-grids  w3l-socialmk">
                        <h3>Follow Us on</h3>
                        <div class="social">
                            <ul>
                                <li>
                                    <a class="icon fb" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon tw" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon gp" href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="agileits_app-devices">
                            <h5>Download the App</h5>
                            <a href="#">
                                <img src="{{ asset('images/1.png') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('images/2.png') }}" alt="">
                            </a>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <!-- //social icons -->
                    <div class="clearfix"></div>
                </div>
                <!-- //footer third section -->
                <!-- footer fourth section (text) -->
                <div class="agile-sometext">
                    <!-- //brands -->
                    <!-- payment -->
                    <div class="sub-some child-momu">
                        <h5>Payment Method</h5>
                        <ul>
                            <li>
                                <img src="{{ asset('images/pay2.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay5.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay1.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay4.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay6.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay3.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay7.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay8.png') }}" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('images/pay9.png') }}" alt="">
                            </li>
                        </ul>
                    </div>
                    <!-- //payment -->
                </div>
                <!-- //footer fourth section (text) -->
            </div>
        </footer>
        <!-- //footer -->
        <!-- copyright -->
        <div class="copy-right">
            <div class="container">
                <p>© 2018 Grocery Shoppy. All rights reserved | Design by
                    <a href="http://w3layouts.com/"> W3layouts.</a>
                </p>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/home/navigation.js') }}"></script>
        @yield('js')
    </body>
</html>
