@extends('home.main')
@section('title')
{{$data->name}}
@endsection

@section('head')
<meta name="description"
    content="{{!empty(@$data->seo_description) ? @$data->seo_description : 'Free Web tutorials website bán chạy các sản phẩm đa dạng và tiện dụng thật sự chu yên nghiệp, Free Web tutorials website bán chạy các sản phẩm đa dạng và tiện dụng thật sự chu yên nghiệp'}}">
    <meta name="keywords"
    content="{{!empty(@$data->seo_keywords) ? @$data->seo_keywords : 'Free Web tutorials website bán chạy các sản phẩm đa dạng và tiện dụng thật sự chu yên nghiệp, Free Web tutorials website bán chạy các sản phẩm đa dạng và tiện dụng thật sự chu yên nghiệp'}}">
@endsection

@section('content')
{{-- SCHEMA HERE --}}
@php
    echo '<script type="application/ld+json">';
@endphp
    {!! @$schema !!} 
@php
    echo '</script>';    
@endphp
{{-- SCHEMA HERE --}}
<!-- start of product-detail -->
<div class="py-5 my-5" style="content:''"></div>
@if(session()->has('successevaluate'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Tuyêt!</strong> Đánh giá của bạn đã được gửi đi.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="banner-wrapper no_background">
    <div class="banner-wrapper-inner">
        <nav class="lynessa-breadcrumb"><a href="{{route('home')}}">Home</a><i class="fa fa-angle-right"></i><a href="#">Shop</a><i class="fa fa-angle-right"></i>{{@$data->name}}
        </nav>
    </div>
</div>
<div class="single-thumb-vertical main-container shop-page no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="lynessa-notices-wrapper"></div>
                <div id="product-27" class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                    <div class="main-contain-summary">
                        <div class="contain-left has-gallery">
                            <div class="single-left">
                                <div class="lynessa-product-gallery lynessa-product-gallery--with-images lynessa-product-gallery--columns-4 images">
                                    <a href="#" class="lynessa-product-gallery__trigger">
                                        <img draggable="false" class="emoji" alt="🔍" src="https://s.w.org/images/core/emoji/11/svg/1f50d.svg"></a>
                                    <div class="flex-viewport">
                                        <figure class="lynessa-product-gallery__wrapper">
                                            @if(count(@$data->images)>0)
                                                @foreach(@$data->images as $image)
                                                    <div class="lynessa-product-gallery__image">
                                                        <img src="{{asset('storage/editor/source/'.@$data->product_id.'/'.@$image->image_path)}}" alt="img">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </figure>
                                    </div>
                                    <ol class="flex-control-nav flex-control-thumbs">
                                        @if(count(@$data->images)>0)
                                            @foreach(@$data->images as $image)
                                                <li><img src="{{ show_image(asset(config('product.image.product.thumb_path').$product->product_id), $img->image_path) }}" alt="{{ !empty(@$image->name) ? @$image->name : 'Images' }}">
                                                </li>
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>
                            </div>
                            <div class="summary entry-summary">
                                <div class="flash">
                                    <span class="onnew"><span class="text">New</span></span>
                                </div>
                                <h1 class="product_title entry-title">{{@$data->name}}</h1>
                                <div class="rating-wapper nostar">
                                    <div class="star-rating"><span style="width:{{@$data->evaluate->where('status','A')->avg('star') != null ? $data->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated <strong class="rating">0</strong> out of 5</span>
                                    </div>
                                </div>
                                <p class="price">
                                    @if(@$data->sell_price>0)
                                    <span class="price">
                                        <del>
                                            <span class="lynessa-Price-amount amount">
                                                {{Number_format(@$data->org_price)}} VND
                                            </span>
                                        </del>
                                        <ins>
                                            <span class="lynessa-Price-amount amount">
                                                {{Number_format(@$data->sell_price)}} VND
                                            </span>
                                        </ins>
                                    </span>
                                    @else
                                    <span class="price">
                                        <ins>
                                            <span class="lynessa-Price-amount amount">
                                                {{Number_format(@$data->org_price)}} VND
                                            </span>
                                        </ins>
                                    </span>
                                    @endif
                                </p>
                                <p class="stock in-stock">
                                    Availability: <span>{{@$data->qty > 0 ? 'Còn hàng ' : 'Hết hàng' }}</span>
                                </p>
                                <div class="lynessa-product-details__short-description">
                                    <p>{!! @$data->note !!}</p>
                                </div>
                                <!--  chổ mua hàng -->
                                @if(count(@$data->parentproduct)==0)
                                <form action="{{route('addcart')}}" method="POST">
                                    @csrf
                                    <div class="col-12 row">
                                        <input type="hidden" name="product[]" value="{{$data->product_id}}" id="product">
                                        <input class="col-3 border btn" min="1" name="count[{{$data->product_id}}]" value="1" type="number">
                                        <button class="col-6 btn-dark rounded-0 btnOneClick" type="submit" id="addtocart"> Thêm vào giỏ hàng </button>
                                    </div>
                                </form>
                                @else
                                <input type="hidden" name="productparent" value="{{$data->product_id}}" id="productparent">
                                <input type="hidden" id="countselect" value={{@$features->where('parent_id','0')->count()}}>
                                <!-- trường hợp có con -->
                                @php $i = 1; @endphp
                                @foreach(@$features->where('parent_id','0') as $feature)
                                <p class="py-0 mb-0 mt-4">{{$feature->name}}</p>
                                <select class="form-control border optionfeature" id=optionfeature_{{$i}}>
                                    <option value="">----{{@$feature->name}}----</option>
                                    @foreach(@$features->where('parent_id',$feature->id) as $feaparent)
                                        <option value="{{$feaparent->id}}">
                                            {{@$feaparent->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @php $i++; @endphp
                                @endforeach

                                <!-- begin: sp con -->
                                <div id="showajaxproduct" class="mt-2">
                                    <form action="{{route('addcart')}}" method="POST">
                                        @csrf
                                        <div style="max-height:220px;overflow:auto" class="mt-3">
                                            @foreach(@$data->parentproduct as $datacon)
                                            <div class="col-12 py-1 border-bottom">
                                                <div class="row">
                                                    <div class="col-2">
                                                        @if(!empty($datacon->image))
                                                        {{-- <img src="{{asset('storage/editor/thumbs/'.@$datacon->parent_product_id.'/'.@$datacon->images()->first()->image_path)}}" alt="Images" style="width:55px"> --}}
                                                        <img src="{{ show_image(asset(config('product.image.product.thumb_path').$datacon->parent_product_id), $datacon->images()->first()->image_path) }}" alt="{{!empty(@$img->name) ? @$img->name : 'E-Laravel'}}" width="270" height="350" data-aos="fade-up">
                                                        @endif
                                                    </div>
                                                    <div class="col-8">
                                                        <b>{{@$datacon->name}}</b>
                                                        <br>
                                                        @if(!empty(@$datacon->sell_price)&&(@$datacon->sell_price>0))
                                                        <span class="price">
                                                            <del>
                                                                <span class="lynessa-Price-amount amount">
                                                                    {{Number_format(@$datacon->org_price)}}
                                                                    VND
                                                                </span>
                                                            </del>
                                                            <ins>
                                                                <span class="lynessa-Price-amount amount text-danger">
                                                                    {{Number_format(@$datacon->sell_price)}} VND
                                                                </span>
                                                            </ins>
                                                        </span>
                                                        @else
                                                        <span class="price">
                                                            <ins>
                                                                <span class="lynessa-Price-amount amount text-danger">
                                                                    {{Number_format(@$datacon->org_price)}}VND
                                                                </span>
                                                            </ins>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-2 py-2">
                                                        <input type="hidden" name="product[]" value="{{$datacon->product_id}}" id="product">
                                                        <input class="border col-12 btn" min="0" name="count[{{$datacon->product_id}}]" value="0" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <button class="col-12 mt-2 btn-dark rounded-0 btnOneClick" type="submit" id="addtocart">
                                            Thêm vào giỏ hàng
                                        </button>
                                    </form>
                                </div>
                                <!-- end: ds con -->
                                @endif
                                <!-- end: chổ mua hàng -->
                                <div class="yith-wcwl-add-to-wishlist">
                                    <div class="yith-wcwl-add-button show">
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="product_meta">
                                    <div class="wcml-dropdown product wcml_currency_switcher">
                                        <ul>
                                            <li class="wcml-cs-active-currency">
                                                <a class="wcml-cs-item-toggle">USD</a>
                                                <ul class="wcml-cs-submenu">
                                                    <li>
                                                        <a>EUR</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="sku_wrapper">SKU: <span class="sku">{{@$data->short_name}}</span></span>
                                    <span class="posted_in">Categories:
                                        @if(!empty($data->categories))
                                            @php $i =1; @endphp
                                            @foreach(@$data->categories as $category)
                                                @if($i==1)
                                                    <h2>{{@$category->name}}</h2>
                                                @else
                                                    , <h2>{{@$category->name}}</h2>
                                                @endif
                                                @php $i =2; @endphp
                                            @endforeach
                                        @endif
                                    </span>
                                </div>
                                <div class="lynessa-share-socials">
                                    <p class="social-heading">Share: </p>
                                    <a target="_blank" class="facebook" href="#">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" class="twitter" href="#"><i class="fa fa-twitter"></i>
                                    </a>
                                    <a target="_blank" class="pinterest" href="#"> <i class="fa fa-pinterest"></i>
                                    </a>
                                    <a target="_blank" class="googleplus" href="#"><i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lynessa-tabs lynessa-tabs-wrapper">
                        <ul class="tabs dreaming-tabs px-0" role="tablist">
                            <li class="description_tab active px-0" id="tab-title-description" role="tab"
                                aria-controls="tab-description">
                                <a href="#tab-description">Description</a>
                            </li>
                            <li class="reviews_tab px-0" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                                <a href="#tab-reviews">Reviews</a>
                            </li>
                        </ul>
                        <div class="lynessa-Tabs-panel lynessa-Tabs-panel--description panel entry-content lynessa-tab"
                            id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                            <div class="container-table">
                                {!! @$data->description !!}
                            </div>
                        </div>
                        <div class="cmt mt-3">
                            <div class="bg-light border-bottom px-2">{{@$data->evaluate->where('status','A')->count()}}
                                đánh giá</div>
                            @if(!empty(@$data->evaluate))
                            @foreach(@$data->evaluate->where('status','A') as $evaluate)
                            <div class="col-12 bg-light mb-1 py-3">
                                <p class="py-0 my-0">
                                    <b>{{@$evaluate->name}}</b> / {{@$evaluate->email}}
                                </p>
                                <div class="star-rating"><span style="width:{{@$evaluate->star * 20}}%">Rated <strong class="rating">0</strong> out of 5</span></div>
                                <p class="py-0 my-0">
                                    <i><small>{{@$evaluate->created_at}}</small></i>
                                </p>
                                <p class="pt-0 my-0">
                                    {{@$evaluate->content}}
                                </p>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <form action="{{route('addevaluate')}}" method="POST" class="contact-form">
                            @csrf
                            <p class="heading">Đánh giá</p>
                            <!-- start of star -->
                            <ul class="list-inline star">
                                <span>Your Rate*</span>
                                <li class="d-inline"><i class="fa fa-star clickstar" aria-hidden="true" id="1"></i>
                                </li>
                                <li class="d-inline"><i class="fa fa-star clickstar d-inline" aria-hidden="true"
                                        id="2"></i></li>
                                <li class="d-inline"><i class="fa fa-star clickstar d-inline" aria-hidden="true"
                                        id="3"></i></li>
                                <li class="d-inline"><i class="fa fa-star clickstar d-inline" aria-hidden="true"
                                        id="4"></i></li>
                                <li class="d-inline"><i class="fa fa-star clickstar d-inline" aria-hidden="true"
                                        id="5"></i></li>
                            </ul>
                            <input type="hidden" name="product_id" value="{{$data->product_id}}">
                            <input type="hidden" max="5" min="1" name="star" id="star" value="5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="name" class="form-control border" placeholder="Your name*" id="name">
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border" placeholder="Email address*" id="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 mt-2 col-12">
                                    <textarea name="content" rows="10" class="form-control btn border col-12 text-left" placeholder="Your review*" id="message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 mt-1 px-3">
                                    <button class="btn btn-full text-uppercase px-5 btnOneClick" type="submit">GỬI</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- #respond -->
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
</div>
</div>
<div class="lynessa-products style-05 container">
    <div class="response-product product-list-owl owl-slick equal-container better-height"
        data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
        data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
        @foreach(@$relatedproducts as $product)
        <div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
            <div class="product-inner tooltip-right">
                <div class="product-thumb">
                    <a class="thumb-link" href="{{asset('san-pham')}}/{{$product->slug}}.html" tabindex="0">
                        @if(count(@$product->images)>0)
                            @foreach($product->images as $img)
                            <img class="img-responsive" src="{{ show_image(asset(config('product.image.product.thumb_path').$product->product_id), $img->image_path) }}" alt="{{!empty($img->name) ? $img->name : 'images'}}" width="270" height="350" alt="img">
                            @php break; @endphp
                            @endforeach
                        @endif
                    </a>
                    <div class="flash">
                        <!-- <span class="onsale"><span class="number">-11%</span></span> -->
                        <span class="onnew"><span class="text">New</span></span>
                    </div>
                    <div class="group-button">
                        @if(count(@$product->parentproduct)<=0) <div class="add-to-cart">
                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" id="{{$product->product_id}}">Add to cart</a>
                    </div>
                    @endif

                    <a class="button yith-wcqv-button" id="{{$product->product_id}}">Quick View</a>
                    <div class="lynessa product compare-button">
                        <a href="{{asset('san-pham')}}/{{$product->slug}}.html" class="compare button">Compare</a>
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-name product_title">
                    <a href="{{asset('san-pham')}}/{{$product->slug}}.html" tabindex="0"> {{$product->name}}</a>
                </h3>
                <div class="rating-wapper nostar">
                    <div class="star-rating"><span style="width:{{@$product->evaluate->where('status','A')->avg('star') != null ? @$product->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated
                        <strong class="rating"></strong>out of 5</span></div>
                    <span class="review"></span>
                </div>
                <!-- kt cos gia khuyen mai ko -->
                @if(@$product->sell_price>0)
                <span class="price">
                    <del>
                        <span class="lynessa-Price-amount amount">
                            {{Number_format(@$product->org_price)}} VND
                        </span>
                    </del>
                    <ins>
                        <span class="lynessa-Price-amount amount">
                            {{Number_format(@$product->sell_price)}} VND
                        </span>
                    </ins>
                </span>
                @else
                <span class="price">
                    <ins>
                        <span class="lynessa-Price-amount amount">
                            {{Number_format(@$product->org_price)}}VND
                        </span>
                    </ins>
                </span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>

<script src="{{asset('js/newpage/product/show.js')}}"></script>

<style>
h2{
    font-size:1em;
    display:inline;
}
</style>
@endsection