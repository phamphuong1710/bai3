<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/home/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    @yield('style')
</head>
<body>
    <!-- top-header -->
    <div class="header-most-top">
        <p>Grocery Offer Zone Top Deals & Discounts</p>
    </div>
    <!-- //top-header -->
    <!-- header-bot-->
    <div class="header-bot">
        <div class="header-bot_inner_wthreeinfo_header_mid">
            <!-- header-bot-->
            <div class="col-md-4 logo_agile">
                <h1>
                <a href="index-2.html">
                    <span>G</span>rocery
                    <span>S</span>hoppy
                    <img src="images/logo2.png" alt=" ">
                </a>
                </h1>
            </div>
            <!-- header-bot -->
            <div class="col-md-8 header">
                <!-- header lists -->
                <ul>
                    <li>
                        <a class="play-icon popup-with-zoom-anim" href="#small-dialog1">
                            <span class="fa fa-map-marker" aria-hidden="true"></span>
                            Shop Locator
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal1">
                        <span class="fa fa-truck" aria-hidden="true"></span>Track Order</a>
                    </li>
                    <li>
                        <span class="fa fa-phone" aria-hidden="true"></span> 001 234 5678
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal1">
                            <span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal2">
                            <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </a>
                    </li>
                </ul>
                <!-- //header lists -->
                <!-- search -->
                <div class="agileits_search">
                    <form action="#" method="post">
                        <input name="Search" type="search" placeholder="How can we help you today?" required="">
                        <button type="submit" class="btn btn-default" aria-label="Left Align">
                        <span class="fa fa-search" aria-hidden="true"> </span>
                        </button>
                    </form>
                </div>
                <!-- //search -->
                <!-- cart details -->
                <div class="top_nav_right">
                    <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                        <form action="#" method="post" class="last">
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="display" value="1">
                            <button class="w3view-cart" type="submit" name="submit" value="">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- //cart details -->
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- shop locator (popup) -->
    <!-- Button trigger modal(shop-locator) -->
    <div id="small-dialog1" class="mfp-hide">
        <div class="select-city">
            <h3>Please Select Your Location</h3>
            <select class="list_of_cities">
                <optgroup label="Popular Cities">
                    <option selected style="display:none;color:#eee;">Select City</option>
                    <option>Birmingham</option>
                    <option>Anchorage</option>
                    <option>Phoenix</option>
                    <option>Little Rock</option>
                    <option>Los Angeles</option>
                    <option>Denver</option>
                    <option>Bridgeport</option>
                    <option>Wilmington</option>
                    <option>Jacksonville</option>
                    <option>Atlanta</option>
                    <option>Honolulu</option>
                    <option>Boise</option>
                    <option>Chicago</option>
                    <option>Indianapolis</option>
                </optgroup>
            </select>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //shop locator (popup) -->
    <!-- signin Model -->
    <!-- Modal1 -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body modal-body-sub_agile">
                    <div class="main-mailposi">
                        <span class="fa fa-envelope-o" aria-hidden="true"></span>
                    </div>
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign In </h3>
                        <p>
                            Sign In now, Let's start your Grocery Shopping. Don't have an account?
                            <a href="#" data-toggle="modal" data-target="#myModal2">
                            Sign Up Now</a>
                        </p>
                        <form action="#" method="post">
                            <div class="styled-input agile-styled-input-top">
                                <input type="text" placeholder="User Name" name="Name" required="">
                            </div>
                            <div class="styled-input">
                                <input type="password" placeholder="Password" name="password" required="">
                            </div>
                            <input type="submit" value="Sign In">
                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- //Modal content-->
        </div>
    </div>
    <!-- //Modal1 -->
    <!-- //signin Model -->
    <!-- signup Model -->
    <!-- Modal2 -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body modal-body-sub_agile">
                    <div class="main-mailposi">
                        <span class="fa fa-envelope-o" aria-hidden="true"></span>
                    </div>
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign Up</h3>
                        <p>
                            Come join the Grocery Shoppy! Let's set up your Account.
                        </p>
                        <form action="#" method="post">
                            <div class="styled-input agile-styled-input-top">
                                <input type="text" placeholder="Name" name="Name" required="">
                            </div>
                            <div class="styled-input">
                                <input type="email" placeholder="E-mail" name="Email" required="">
                            </div>
                            <div class="styled-input">
                                <input type="password" placeholder="Password" name="password" id="password1" required="">
                            </div>
                            <div class="styled-input">
                                <input type="password" placeholder="Confirm Password" name="Confirm Password" id="password2" required="">
                            </div>
                            <input type="submit" value="Sign Up">
                        </form>
                        <p>
                            <a href="#">By clicking register, I agree to your terms</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- //Modal content-->
        </div>
    </div>
    <!-- //Modal2 -->
    <!-- //signup Model -->
    <!-- //header-bot -->
    <!-- navigation -->
    <div class="ban-top">
        <div class="container">
            <div class="agileits-navi_search">
                <form action="#" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" required="">
                        <option value="">All Categories</option>
                        <option value="Kitchen">Kitchen</option>
                        <option value="Household">Household</option>
                        <option value="Snacks &amp; Beverages">Snacks &amp; Beverages</option>
                        <option value="Personal Care">Personal Care</option>
                        <option value="Gift Hampers">Gift Hampers</option>
                        <option value="Fruits &amp; Vegetables">Fruits &amp; Vegetables</option>
                        <option value="Baby Care">Baby Care</option>
                        <option value="Soft Drinks &amp; Juices">Soft Drinks &amp; Juices</option>
                        <option value="Frozen Food">Frozen Food</option>
                        <option value="Bread &amp; Bakery">Bread &amp; Bakery</option>
                        <option value="Sweets">Sweets</option>
                    </select>
                </form>
            </div>
            <div class="top_nav_left">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu__list">
                                <li class="active">
                                    <a class="nav-stylehead" href="index-2.html">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a class="nav-stylehead" href="about.html">About Us</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kitchen
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu multi-column columns-3">
                                        <div class="agile_inner_drop_nav_info">
                                            <div class="col-sm-4 multi-gd-img">
                                                <ul class="multi-column-dropdown">
                                                    <li>
                                                        <a href="product.html">Bakery</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Baking Supplies</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Coffee, Tea &amp; Beverages</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Dried Fruits, Nuts</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Sweets, Chocolate</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Spices &amp; Masalas</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Jams, Honey &amp; Spreads</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4 multi-gd-img">
                                                <ul class="multi-column-dropdown">
                                                    <li>
                                                        <a href="product.html">Pickles</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Pasta &amp; Noodles</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Rice, Flour &amp; Pulses</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Sauces &amp; Cooking Pastes</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Snack Foods</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Oils, Vinegars</a>
                                                    </li>
                                                    <li>
                                                        <a href="product.html">Meat, Poultry &amp; Seafood</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4 multi-gd-img">
                                                <img src="images/nav.png" alt="">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Household
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu multi-column columns-3">
                                        <div class="agile_inner_drop_nav_info">
                                            <div class="col-sm-6 multi-gd-img">
                                                <ul class="multi-column-dropdown">
                                                    <li>
                                                        <a href="product2.html">Kitchen &amp; Dining</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Detergents</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Utensil Cleaners</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Floor &amp; Other Cleaners</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Disposables, Garbage Bag</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Repellents &amp; Fresheners</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html"> Dishwash</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 multi-gd-img">
                                                <ul class="multi-column-dropdown">
                                                    <li>
                                                        <a href="product2.html">Pet Care</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Cleaning Accessories</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Pooja Needs</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Crackers</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Festive Decoratives</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Plasticware</a>
                                                    </li>
                                                    <li>
                                                        <a href="product2.html">Home Care</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </ul>
                                </li>
                                <li class="">
                                    <a class="nav-stylehead" href="faqs.html">Faqs</a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-stylehead dropdown-toggle" href="#" data-toggle="dropdown">Pages
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu agile_short_dropdown">
                                        <li>
                                            <a href="icons.html">Web Icons</a>
                                        </li>
                                        <li>
                                            <a href="typography.html">Typography</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a class="nav-stylehead" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- //special offers -->
    <!---728x90--->
    @yield('content')
    <!-- newsletter -->
    <div class="footer-top">
        <div class="container-fluid">
            <div class="col-xs-8 agile-leftmk">
                <h2>Get your Groceries delivered from local stores</h2>
                <p>Free Delivery on your first order!</p>
                <form action="#" method="post">
                    <input type="email" placeholder="E-mail" name="email" required="">
                    <input type="submit" value="Subscribe">
                </form>
                <div class="newsform-w3l">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-xs-4 w3l-rightmk">
                <img src="images/tab3.png" alt=" ">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //newsletter -->
    <!-- footer -->
    <footer>
        <div class="container">
            <!-- footer first section -->
            <p class="footer-main">
                <span>"Grocery Shoppy"</span> Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
            beatae vitae dicta sunt explicabo.</p>
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
                            <img src="images/1.png" alt="">
                        </a>
                        <a href="#">
                            <img src="images/2.png" alt="">
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
                <div class="sub-some">
                    <h5>Online Grocery Shopping</h5>
                    <p>Order online. All your favourite products from the low price online supermarket for grocery home delivery in Delhi,
                        Gurgaon, Bengaluru, Mumbai and other cities in India. Lowest prices guaranteed on Patanjali, Aashirvaad, Pampers, Maggi,
                    Saffola, Huggies, Fortune, Nestle, Amul, MamyPoko Pants, Surf Excel, Ariel, Vim, Haldiram's and others.</p>
                </div>
                <div class="sub-some">
                    <h5>Shop online with the best deals & offers</h5>
                    <p>Now Get Upto 40% Off On Everyday Essential Products Shown On The Offer Page. The range includes Grocery, Personal Care,
                    Baby Care, Pet Supplies, Healthcare and Other Daily Need Products. Discount May Vary From Product To Product.</p>
                </div>
                <!-- brands -->
                <div class="sub-some">
                    <h5>Popular Brands</h5>
                    <ul>
                        <li>
                            <a href="product.html">Aashirvaad</a>
                        </li>
                        <li>
                            <a href="product.html">Amul</a>
                        </li>
                        <li>
                            <a href="product.html">Bingo</a>
                        </li>
                        <li>
                            <a href="product.html">Boost</a>
                        </li>
                        <li>
                            <a href="product.html">Durex</a>
                        </li>
                        <li>
                            <a href="product.html"> Maggi</a>
                        </li>
                        <li>
                            <a href="product.html">Glucon-D</a>
                        </li>
                        <li>
                            <a href="product.html">Horlicks</a>
                        </li>
                        <li>
                            <a href="product2.html">Head & Shoulders</a>
                        </li>
                        <li>
                            <a href="product2.html">Dove</a>
                        </li>
                        <li>
                            <a href="product2.html">Dettol</a>
                        </li>
                        <li>
                            <a href="product2.html">Dabur</a>
                        </li>
                        <li>
                            <a href="product2.html">Colgate</a>
                        </li>
                        <li>
                            <a href="product.html">Coca-Cola</a>
                        </li>
                        <li>
                            <a href="product2.html">Closeup</a>
                        </li>
                        <li>
                            <a href="product2.html"> Cinthol</a>
                        </li>
                        <li>
                            <a href="product.html">Cadbury</a>
                        </li>
                        <li>
                            <a href="product.html">Bru</a>
                        </li>
                        <li>
                            <a href="product.html">Bournvita</a>
                        </li>
                        <li>
                            <a href="product.html">Tang</a>
                        </li>
                        <li>
                            <a href="product.html">Pears</a>
                        </li>
                        <li>
                            <a href="product.html">Oreo</a>
                        </li>
                        <li>
                            <a href="product.html"> Taj Mahal</a>
                        </li>
                        <li>
                            <a href="product.html">Sprite</a>
                        </li>
                        <li>
                            <a href="product.html">Thums Up</a>
                        </li>
                        <li>
                            <a href="product2.html">Fair & Lovely</a>
                        </li>
                        <li>
                            <a href="product2.html">Lakme</a>
                        </li>
                        <li>
                            <a href="product.html">Tata</a>
                        </li>
                        <li>
                            <a href="product2.html">Sunfeast</a>
                        </li>
                        <li>
                            <a href="product2.html">Sunsilk</a>
                        </li>
                        <li>
                            <a href="product.html">Patanjali</a>
                        </li>
                        <li>
                            <a href="product.html">MTR</a>
                        </li>
                        <li>
                            <a href="product.html">Kissan</a>
                        </li>
                        <li>
                            <a href="product2.html"> Lipton</a>
                        </li>
                    </ul>
                </div>
                <!-- //brands -->
                <!-- payment -->
                <div class="sub-some child-momu">
                    <h5>Payment Method</h5>
                    <ul>
                        <li>
                            <img src="images/pay2.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay5.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay1.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay4.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay6.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay3.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay7.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay8.png" alt="">
                        </li>
                        <li>
                            <img src="images/pay9.png" alt="">
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
