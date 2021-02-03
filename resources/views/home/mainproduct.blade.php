<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('home.header')
</head>

<body class="single single-product">
<header id="header" class="header style-04 header-sticky">
    <div class="header-middle">
        <div class="header-middle-inner">
            <div class="header-search-mid">
                <div class="header-search">
                    <div class="block-search">
                        <form role="search" method="get"
                              class="form-search block-search-form lynessa-live-search-form">
                            <div class="form-content search-box results-search">
                                <div class="inner">
                                    <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value="" placeholder="Search here..." type="text">
                                </div>
                            </div>
                            <button type="submit" class="btn-submit">
                                <span class="pe-7s-search"></span>
                            </button>
                        </form><!-- block search -->
                    </div>
                </div>
            </div>
            <div class="header-logo-menu">
                <div class="block-menu-bar">
                    <a class="menu-bar menu-toggle" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="header-logo">
                    <a href="index.html"><img alt="Lynessa" src="{{asset('assets/images/logo.png')}}"
                                              class="logo"></a></div>
            </div>
            <div class="header-control">
                <div class="header-control-inner">
                    <div class="meta-dreaming">
                        <div class="menu-item block-user block-dreaming lynessa-dropdown">
                            <a class="block-link" href="my-account.html">
                                <span class="pe-7s-user"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--dashboard is-active">
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--orders">
                                    <a href="#">Orders</a>
                                </li>
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--downloads">
                                    <a href="#">Downloads</a>
                                </li>
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--edit-address">
                                    <a href="#">Addresses</a>
                                </li>
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--edit-account">
                                    <a href="#">Account details</a>
                                </li>
                                <li class="menu-item lynessa-MyAccount-navigation-link lynessa-MyAccount-navigation-link--customer-logout">
                                    <a href="#">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-minicart block-dreaming lynessa-mini-cart lynessa-dropdown">
                            <div class="shopcart-dropdown block-cart-link" data-lynessa="lynessa-dropdown">
                                <a class="block-link link-dropdown" href="cart.html">
                                    <span class="pe-7s-shopbag"></span>
                                    <span class="count">{{Cart::getContent()->count()}}</span>
                                </a>
                            </div>
                            <div class="widget lynessa widget_shopping_cart">
                                <div class="widget_shopping_cart_content">
                                    <h3 class="minicart-title">Your Cart<span
                                            class="minicart-number-items">{{Cart::getContent()->count()}}</span></h3>
                                    <ul class="lynessa-mini-cart cart_list product_list_widget">
                                       
                                       @if(Cart::getContent()->count() >0)
                                            @foreach(Cart::getContent() as $cart)
                                            <li class="lynessa-mini-cart-item mini_cart_item">
                                            <a href="{{asset('deletecart/'.$cart->id)}}" class="remove remove_from_cart_button"></a>
                                            <a href="#">
                                                <!-- <img src="{{asset('storage/editor/source/')}}/{{App\modules\Product\Models\Product::find($cart->id)->images()->first()->image_path}}"
                                                     class="attachment-lynessa_thumbnail size-lynessa_thumbnail"
                                                     alt="img" width="600" height="778"> -->
                                                    
                                                        {{substr($cart->name,0,40)}} ...
                                                    
                                            </a>
                                            <span class="quantity">{{$cart->quantity}} × <span
                                                    class="lynessa-Price-amount amount"><span
                                                    class="lynessa-Price-currencySymbol">$</span>{{$cart->price}}</span></span>
                                        </li>
                                            @endforeach
                                       @endif
                                    </ul>
                                    <p class="lynessa-mini-cart__total total"><strong>Subtotal:</strong>
                                        <span class="lynessa-Price-amount amount"><span
                                                class="lynessa-Price-currencySymbol">$</span>{{Cart::getSubTotal($totalItems = false)}}</span>
                                    </p>
                                    <p class="lynessa-mini-cart__buttons buttons">
                                        <a href="{{route('viewcart')}}" class="button lynessa-forward">Viewcart</a>
                                        <a href="{{route('checkcart')}}"
                                           class="button checkout lynessa-forward">Checkout</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-wrap-stick">
        <div class="header-position">
            <div class="header-nav">
                <div class="container">
                    <div class="lynessa-menu-wapper"></div>
                    <div class="header-nav-inner">
                        <div class="box-header-nav menu-nocenter">
                            <ul id="menu-primary-menu"
                                class="clone-main-menu lynessa-clone-mobile-menu lynessa-nav main-menu">
                                <li id="menu-item-230"
                                    class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-230 parent parent-megamenu item-megamenu menu-item-has-children">
                                    <a class="lynessa-menu-item-title" title="Home" href="{{route('home')}}">Home</a>
                                    <span class="toggle-submenu"></span>
                                    
                                </li>
                                <li id="menu-item-228"
                                    class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-228 parent parent-megamenu item-megamenu menu-item-has-children">
                                    <a class="lynessa-menu-item-title" title="Shop"
                                       href="shop.html">Shop</a>
                                    <span class="toggle-submenu"></span>
                                    <div class="submenu megamenu megamenu-shop">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">Shop Layouts </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="shop.html" target="_self">Shop Grid </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-list.html" target="_self">
                                                                    <span class="image">
                                                                        <img src="assets/images/label-new.jpg"
                                                                             class="attachment-full size-full"
                                                                             alt="img">
                                                                    </span>
                                                                    Shop List
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop.html" target="_self">No Sidebar </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-leftsidebar.html" target="_self">Left
                                                                    Sidebar </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-rightsidebar.html" target="_self">Right
                                                                    Sidebar </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">Product Layouts </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="single-product.html" target="_self">Vertical
                                                                    Thumbnails </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-policy.html"
                                                                   target="_self">
                                                                    <span class="image">
                                                                        <img src="assets/images/label-new.jpg"
                                                                             class="attachment-full size-full"
                                                                             alt="img">
                                                                    </span>
                                                                    Extra Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-rightsidebar.html"
                                                                   target="_self">
                                                                    Right Sidebar </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-leftsidebar.html"
                                                                   target="_self">
                                                                    Left Sidebar </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Product Extends </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="single-product-bundle.html"
                                                                   target="_self">
                                                                            <span class="image">
                                                                                <img src="assets/images/label-new.jpg"
                                                                                     class="attachment-full size-full"
                                                                                     alt="img">
                                                                            </span>
                                                                    Product Bundle
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-360deg.html"
                                                                   target="_self">
                                                                    <span class="image">
                                                                        <img src="assets/images/label-hot.jpg"
                                                                             class="attachment-full size-full"
                                                                             alt="img">
                                                                    </span>
                                                                    Product 360 Deg </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-video.html"
                                                                   target="_self">
                                                                    Video </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Other Pages </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="cart.html">Cart </a>
                                                            </li>
                                                            <li>
                                                                <a href="wishlist.html" target="_self">Wishlist </a>
                                                            </li>
                                                            <li>
                                                                <a href="checkout.html" target="_self">Checkout </a>
                                                            </li>
                                                            <li>
                                                                <a href="order-tracking.html" target="_self">Order
                                                                    Tracking </a>
                                                            </li>
                                                            <li>
                                                                <a href="my-account.html" target="_self">My Account </a>
                                                            </li>
                                                            <li>
                                                                <a href="compare.html" target="_self">Compare</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Product Types </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="single-product-simple.html"
                                                                   target="_self">
                                                                    Simple </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product.html"
                                                                   target="_self">
                                                                            <span class="image"><img
                                                                                    src="assets/images/label-hot.jpg"
                                                                                    class="attachment-full size-full"
                                                                                    alt="img"></span>
                                                                    Variable </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-external.html"
                                                                   target="_self">
                                                                    External / Affiliate </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-group.html"
                                                                   target="_self">
                                                                    Grouped </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-outofstock.html"
                                                                   target="_self">
                                                                    Out Of Stock </a>
                                                            </li>
                                                            <li>
                                                                <a href="single-product-onsale.html"
                                                                   target="_self">
                                                                    On Sale </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Other Account Page</h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="dashboard.html" target="_self">
                                                                    Dashboard
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="orders.html" target="_self">
                                                                    Orders</a>
                                                            </li>
                                                            <li>
                                                                <a href="downloads.html" target="_self">
                                                                    Downloads </a>
                                                            </li>
                                                            <li>
                                                                <a href="edit-address.html" target="_self">
                                                                    Addresses</a>
                                                            </li>
                                                            <li>
                                                                <a href="edit-account.html" target="_self">
                                                                    Account details </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="menu-item-229"
                                    class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-229 parent parent-megamenu item-megamenu menu-item-has-children">
                                    <a class="lynessa-menu-item-title" title="Elements" href="#">Elements</a>
                                    <span class="toggle-submenu"></span>
                                    <div class="submenu megamenu megamenu-elements">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">Element 1 </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="banner.html"
                                                                   target="_self">Banner </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-element.html"
                                                                   target="_self">Blog Element </a>
                                                            </li>
                                                            <li>
                                                                <a href="categories-element.html"
                                                                   target="_self">
                                                                    Categories Element </a>
                                                            </li>
                                                            <li>
                                                                <a href="product-element.html"
                                                                   target="_self">
                                                                    Product Element </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Element 2 </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="client.html"
                                                                   target="_self">
                                                                    Client </a>
                                                            </li>
                                                            <li>
                                                                <a href="product-layout.html"
                                                                   target="_self">
                                                                    Product Layout </a>
                                                            </li>
                                                            <li>
                                                                <a href="google-map.html"
                                                                   target="_self">
                                                                    Google map </a>
                                                            </li>
                                                            <li>
                                                                <a href="iconbox.html"
                                                                   target="_self">
                                                                    Icon Box </a>
                                                            </li>
                                                            <li>
                                                                <a href="team.html"
                                                                   target="_self">
                                                                    Team </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="lynessa-listitem style-01">
                                                    <div class="listitem-inner">
                                                        <h4 class="title">
                                                            Element 3 </h4>
                                                        <ul class="listitem-list">
                                                            <li>
                                                                <a href="instagram-feed.html"
                                                                   target="_self">
                                                                    Instagram Feed </a>
                                                            </li>
                                                            <li>
                                                                <a href="newsletter.html"
                                                                   target="_self">
                                                                    Newsletter </a>
                                                            </li>
                                                            <li>
                                                                <a href="testimonials.html"
                                                                   target="_self">
                                                                    Testimonials </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="menu-item-996"
                                    class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-996 parent parent-megamenu item-megamenu menu-item-has-children">
                                    <a class="lynessa-menu-item-title" title="Blog"
                                       href="blog.html">Blog</a>
                                    <span class="toggle-submenu"></span>
                                   
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="header-mobile-left">
            <div class="block-menu-bar">
                <a class="menu-bar menu-toggle" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
            <div class="header-search lynessa-dropdown">
                <div class="header-search-inner" data-lynessa="lynessa-dropdown">
                    <a href="#" class="link-dropdown block-link">
                        <span class="pe-7s-search"></span>
                    </a>
                </div>
                <div class="block-search">
                    <form role="search" method="get"
                          class="form-search block-search-form lynessa-live-search-form">
                        <div class="form-content search-box results-search">
                            <div class="inner">
                                <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value="" placeholder="Search here..." type="text">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="pe-7s-search"></span>
                        </button>
                    </form><!-- block search -->
                </div>
            </div>
           
        </div>
        <div class="header-mobile-mid">
            <div class="header-logo">
                <a href="index.html"><img alt="Lynessa"
                                          src="{{asset('assets/images/logo.png')}}"
                                          class="logo"></a></div>
        </div>
        <div class="header-mobile-right">
            <div class="header-control-inner">
                <div class="meta-dreaming">
                    <div class="menu-item block-user block-dreaming lynessa-dropdown">
                        <a class="block-link" href="my-account.html">
                            <span class="pe-7s-user"></span>
                        </a>
                     
                    </div>
                    <div class="block-minicart block-dreaming lynessa-mini-cart lynessa-dropdown">
                    <div class="shopcart-dropdown block-cart-link" data-lynessa="lynessa-dropdown">
                                <a class="block-link link-dropdown" href="cart.html">
                                    <span class="pe-7s-shopbag"></span>
                                    <span class="count">{{Cart::getContent()->count()}}</span>
                                </a>
                            </div>
                            <div class="widget lynessa widget_shopping_cart">
                                <div class="widget_shopping_cart_content">
                                    <h3 class="minicart-title">Your Cart<span
                                            class="minicart-number-items">{{Cart::getContent()->count()}}</span></h3>
                                    <ul class="lynessa-mini-cart cart_list product_list_widget">
                                       
                                       @if(Cart::getContent()->count() >0)
                                            @foreach(Cart::getContent() as $cart)
                                            <li class="lynessa-mini-cart-item mini_cart_item">
                                            <a href="{{asset('deletecart/'.$cart->id)}}" class="remove remove_from_cart_button"></a>
                                            <a href="#">
                                                <!-- <img src="{{asset('storage/editor/source/')}}/{{App\modules\Product\Models\Product::find($cart->id)->images()->first()->image_path}}"
                                                     class="attachment-lynessa_thumbnail size-lynessa_thumbnail"
                                                     alt="img" width="600" height="778"> -->
                                                    
                                                        {{substr($cart->name,0,40)}} ...
                                                    
                                            </a>
                                            <span class="quantity">{{$cart->quantity}} × <span
                                                    class="lynessa-Price-amount amount"><span
                                                    class="lynessa-Price-currencySymbol">$</span>{{$cart->price}}</span></span>
                                        </li>
                                            @endforeach
                                       @endif
                                    </ul>
                                    <p class="lynessa-mini-cart__total total"><strong>Subtotal:</strong>
                                        <span class="lynessa-Price-amount amount"><span
                                                class="lynessa-Price-currencySymbol">$</span>{{Cart::getSubTotal($totalItems = false)}}</span>
                                    </p>
                                    <p class="lynessa-mini-cart__buttons buttons">
                                        <a href="{{route('viewcart')}}" class="button lynessa-forward">Viewcart</a>
                                        <a href="{{route('checkcart')}}"
                                           class="button checkout lynessa-forward">Checkout</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
        @yield('content')

    <!-- start of page footer -->
    <!-- end of page footer -->
    <!-- Back Top of the page -->
    <span id="back-top" class="pe-7s-angle-up main-bg-color"></span>

    @include('home.footer')

    @if (session('addcart'))
    <script>
    $('.cart-opener').click();
    </script>
    @endif
</body>

</html>
<script>
$('#showcart').click();
</script>