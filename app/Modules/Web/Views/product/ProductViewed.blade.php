@if(count($data)>0)
<script src="{{asset('/js/newpage/lazysize.min.js')}}"></script>

<div class="lynessa-heading style-01 mt-5 py-5">
    <div class="heading-inner">
        <h3 class="title">
            {{ trans('Web::home.ProductShow.productView.title') }}<span></span>
        </h3>
        <div class="subtitle">
            {{trans('Web::home.ProductShow.productView.content')}}
        </div>
    </div>
</div>
<div class="container mx-auto">
    <div class="row productViewed">
@foreach($data as $product)
<div class="col-md-3 col-6 dscacsp">
    <div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
        <div class="product-inner tooltip-right">
            <div class="product-thumb">
                <a class="thumb-link" href="@if(!empty($product->categories)) 
                    @php	
                        @$cate_slug   = $product->categories()->first();
                        @$cate_slug_1 = @$cate_slug->slug; 
                    @endphp 
                    {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @elseif(!empty($cate_slug->parent)) 
                    @php
                        @$cate_slug_2 = $cate_slug->parent->first()->slug;
                    @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @else
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                    @endif" tabindex="0">
                    <div class="xam"></div> {{--block when hover image product--}}
						
                    <img class="img-responsive lazyload" data-src="{{get_image_product_webp_thumb(@$product->images->first()->image_path, $product->product_id,'thumb')}}" alt="{{!empty($img->name) ? $img->name : 'image_product_notfound'}}" width="270" height="350">
                </a>
                <div class="flash">
                    {{-- begin: giam % --}}
                    @if($product->sell_price!='0')
                    <span class="onsale"><span class="number">
                            -{{CEIL(100 - @$product->sell_price / ($product->org_price / 100))}}%
                    </span></span>
                    @endif
                    {{-- end: giam % --}}
                  
                </div>
                <div class="group-button">
                    @if((count(@$product->parentproduct)<=0)&&(@$product->qty>0)) <div class="add-to-cart">
                        <a class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                            id="addToCart_{{$product->product_id}}">Add to
                            cart</a>
                </div>
                @endif

                <a class="button yith-wcqv-button yith-wcqv-button-one" id="quickView_{{$product->product_id}}">Quick View</a>
                <div class="lynessa product compare-button">
                    <a href="@if(!empty($product->categories)) 
                        @php	
                            @$cate_slug   = $product->categories()->first();
                            @$cate_slug_1 = @$cate_slug->slug; 
                        @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                        @elseif(!empty($cate_slug->parent)) 
                        @php
                            @$cate_slug_2 = $cate_slug->parent->first()->slug;
                        @endphp 
                            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                        @else
                            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                        @endif" class="compare button">Compare</a>
                </div>
                  {{-- love --}}
                  @if(Auth::check())
                  @php $meloves = @$product->loveproduct()->get();@endphp
                  @if(!empty($meloves))
                  @php $loved = $meloves->where('user_id',Auth::id()); @endphp
                  
                      @if(count($loved)>0)
                      <div class="yith-wcwl-add-to-wishlist wishlistbtn bg-danger" id="loveselling_{{$product->product_id}}">
                          <div class="yith-wcwl-add-button show">
                              <a class="add_to_wishlist">Add to Wishlist</a>
                          </div>
                      </div>
                      @else
                      <div class="yith-wcwl-add-to-wishlist wishlistbtn" id="loveselling_{{$product->product_id}}">
                          <div class="yith-wcwl-add-button show">
                              <a class="add_to_wishlist">Add to Wishlist</a>
                          </div>
                      </div>
                      @endif
                      
                  @else
                  <div class="yith-wcwl-add-to-wishlist wishlistbtn" id="loveselling_{{$product->product_id}}">
                      <div class="yith-wcwl-add-button show">
                          <a class="add_to_wishlist">Add to Wishlist</a>
                      </div>
                  </div>
                  @endif
              @else
              <div class="yith-wcwl-add-to-wishlist">
                  <div class="yith-wcwl-add-button show">
                  <a class="add_to_wishlist" href="{{route('loginmember')}}">Add to Wishlist</a>
                  </div>
              </div>
              @endif
              {{-- end love --}}
            </div>
        </div>
        <div class="product-info">
            <h4 class="product-name product_title">
                <a href="@if(!empty($product->categories)) 
                    @php	
                        @$cate_slug   = $product->categories()->first();
                        @$cate_slug_1 = @$cate_slug->slug; 
                    @endphp 
                    {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @elseif(!empty($cate_slug->parent)) 
                    @php
                        @$cate_slug_2 = $cate_slug->parent->first()->slug;
                    @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @else
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                    @endif" tabindex="0"> {{$product->name}}</a>
            </h4>
            <div class="rating-wapper nostar">
                <div class="star-rating"><span style="width:{{$product->evaluate->where('status','A')->avg('star') != null ? $product->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated
                        <strong class="rating"></strong>
                        out of 5</span></div>
                <span class="review"></span>
            </div>
            <!-- kt cos gia khuyen mai ko -->
            @if($product->sell_price!='0')
            <span class="price">
                <del>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->org_price)}}₫</span>
                </del>
                <ins>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->sell_price)}}₫</span>
                </ins>
            </span>
            @else
            <span class="price">
                <ins>
                    <span class="lynessa-Price-amount amount">{{Number_format($product->org_price)}}₫</span>
                </ins>
            </span>
            @endif
        </div>
    </div>
</div>
</div>
@endforeach

@if(@$productViewLimit == 1)
    <div class="btn-cont mt-5 col-12 py-2 text-center">
        <a class="btn" id="productViewedMoreBtn">{{ trans('Web::home.ProductViewed.more') }}
            <span class="line-1"></span>
            <span class="line-2"></span>
            <span class="line-3"></span>
            <span class="line-4"></span>
        </a>
    </div>
    {{-- show more --}}
    <div class="col-md-12 col-12" id="productViewedMoreShow">
        <div class="row">
        <div class="col-md-9 d-md-block d-none" id="leftProductViewedMoreShow"></div>
        <div class="col-md-3 col-12" id="rightProductViewedMoreShow">
        <div class="row">
            <div class="col-11 border-bottom py-2 mb-2 title">
                <b>{{ trans('Web::home.ProductViewed.title') }}</b>
            </div>
            <div class="col-1 border py-2 text-center mb-2 title">
                <i class="fa fa-times" aria-hidden="true" id="productViewedMoreX"></i>
            </div>
        @foreach($dataFull as $product)
<div class="col-md-6 col-6 dscacsp">
    <div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
        <div class="product-inner tooltip-right">
            <div class="product-thumb">
                <a class="thumb-link" href="@if(!empty($product->categories)) 
                    @php	
                        @$cate_slug   = $product->categories()->first();
                        @$cate_slug_1 = @$cate_slug->slug; 
                    @endphp 
                    {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @elseif(!empty($cate_slug->parent)) 
                    @php
                        @$cate_slug_2 = $cate_slug->parent->first()->slug;
                    @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @else
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                    @endif" tabindex="0">
                    <img class="img-responsive lazyload" data-src="{{get_image_product_webp_thumb(@$product->images->first()->image_path, $product->product_id,'thumb')}}" alt="{{!empty($img->name) ? $img->name : 'image_product_notfound'}}" width="270" height="350">
                </a>
                <div class="flash">
                    {{-- begin: giam % --}}
                    @if($product->sell_price!='0')
                    <span class="onsale"><span class="number">
                            -{{CEIL(100 - @$product->sell_price / ($product->org_price / 100))}}%
                    </span></span>
                    @endif
                    {{-- end: giam % --}}
                  
                </div>
                <div class="group-button">
                    @if((count(@$product->parentproduct)<=0)&&(@$product->qty>0)) <div class="add-to-cart">
                        <a class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                            id="addToCart_{{$product->product_id}}">Add to
                            cart</a>
                </div>
                @endif

                <a class="button yith-wcqv-button yith-wcqv-button-one" id="quickView_{{$product->product_id}}">Quick View</a>
                <div class="lynessa product compare-button">
                    <a href="@if(!empty($product->categories)) 
                        @php	
                            @$cate_slug   = $product->categories()->first();
                            @$cate_slug_1 = @$cate_slug->slug; 
                        @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                        @elseif(!empty($cate_slug->parent)) 
                        @php
                            @$cate_slug_2 = $cate_slug->parent->first()->slug;
                        @endphp 
                            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                        @else
                            {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                        @endif" class="compare button">Compare</a>
                </div>
                  {{-- love --}}
                  @if(Auth::check())
                  @php $meloves = @$product->loveproduct()->get();@endphp
                  @if(!empty($meloves))
                  @php $loved = $meloves->where('user_id',Auth::id()); @endphp
                  
                      @if(count($loved)>0)
                      <div class="yith-wcwl-add-to-wishlist wishlistbtn bg-danger" id="loveselling_{{$product->product_id}}">
                          <div class="yith-wcwl-add-button show">
                              <a class="add_to_wishlist">Add to Wishlist</a>
                          </div>
                      </div>
                      @else
                      <div class="yith-wcwl-add-to-wishlist wishlistbtn" id="loveselling_{{$product->product_id}}">
                          <div class="yith-wcwl-add-button show">
                              <a class="add_to_wishlist">Add to Wishlist</a>
                          </div>
                      </div>
                      @endif
                      
                  @else
                  <div class="yith-wcwl-add-to-wishlist wishlistbtn" id="loveselling_{{$product->product_id}}">
                      <div class="yith-wcwl-add-button show">
                          <a class="add_to_wishlist">Add to Wishlist</a>
                      </div>
                  </div>
                  @endif
              @else
              <div class="yith-wcwl-add-to-wishlist">
                  <div class="yith-wcwl-add-button show">
                  <a class="add_to_wishlist" href="{{route('loginmember')}}">Add to Wishlist</a>
                  </div>
              </div>
              @endif
              {{-- end love --}}
            </div>
        </div>
        <div class="product-info">
            <h4 class="product-name product_title">
                <a href="@if(!empty($product->categories)) 
                    @php	
                        @$cate_slug   = $product->categories()->first();
                        @$cate_slug_1 = @$cate_slug->slug; 
                    @endphp 
                    {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @elseif(!empty($cate_slug->parent)) 
                    @php
                        @$cate_slug_2 = $cate_slug->parent->first()->slug;
                    @endphp 
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
                    @else
                        {{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'slug'=>$product->slug])}}
                    @endif" tabindex="0"> {{$product->name}}</a>
            </h4>
            <div class="rating-wapper nostar">
                <div class="star-rating"><span
                        style="width:{{$product->evaluate->where('status','A')->avg('star') != null ? $product->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated
                        <strong class="rating"></strong>
                        out of 5</span></div>
                <span class="review"></span>
            </div>
            <!-- kt cos gia khuyen mai ko -->
            @if($product->sell_price!='0')
            <span class="price">
                <del>
                    <span class="lynessa-Price-amount amount">
                        {{Number_format($product->org_price)}}₫
                    </span>
                </del>
                <ins>
                    <span class="lynessa-Price-amount amount">
                        {{Number_format($product->sell_price)}}₫
                    </span>
                </ins>
            </span>
            @else
            <span class="price">
                <ins>
                    <span class="lynessa-Price-amount amount">
                        {{Number_format($product->org_price)}}₫
                    </span>
                </ins>
            </span>
            @endif
        </div>
    </div>
</div>
</div>
@endforeach

    </div>
@endif
</div>
</div>
<style>
    #productViewedMoreShow{
        position:fixed;
        top:0;right:-100%;
        transition:0.24s;
        z-index:12345676;
        height:100vh;
        overflow:auto;
        opacity:0;
    }
    #productViewedMoreShow #leftProductViewedMoreShow{
        content: '';
        background:#000;
        opacity:0.5;
    }
    #productViewedMoreShow #rightProductViewedMoreShow{
        background:#fff;
    }
    #productViewedMoreShow #rightProductViewedMoreShow .title{
        font-size:19px;
    }
</style>
<script src="{{asset('/js/newpage/footer.js')}}"></script>
<script>
    $('#productViewedMoreBtn').on('click', function(){
        $('#productViewedMoreShow').css('right','0%');
        $('#productViewedMoreShow').css('opacity','1');
    })
    $('#productViewedMoreX').on('click', function(){
        $('#productViewedMoreShow').css('opacity','0');
        $('#productViewedMoreShow').css('right','-100%');
    })
    $('#leftProductViewedMoreShow').on('click', function(){
        $('#productViewedMoreShow').css('opacity','0');
        $('#productViewedMoreShow').css('right','-100%');
    })

</script>

<script>
    $(".productViewed .yith-wcqv-button").on("click", function () {
        id = $(this).attr("id");
        id = id.split("_")[1];
        $(".animationloadpage").show();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        }),
        $.ajax({
            type: "GET",
            url: "/searchproductseacrchbutton",
            dataType: "text",
            data: {
                id: id
            },
            success: function (b) {
                
                $(".animationloadpage").hide(),
                $("#seeMoreParent").show(),
                $("#seeMore").html(b)
            }
        })
    });
    $("#borderSeeMore").on("click", function () {
        $("#seeMoreParent").hide(),
        $("#seeMore").html("")
    });
    $("#background-ProductShowMore").on("click", function () {
        $("#seeMoreParent").hide(),
        $("#seeMore").html("")
    });
    $(".productViewed .ajax_add_to_cart").on("click", function () {
        var b = $(this).attr("id");
        b = b.split("_")[1];
        $(".animationloadpage").show();
        $.ajax("/addcartAjax/" + b, {
            method: "GET",
            dataType: "json",
            contentType: !1,
            cache: !1,
            processData: !1,
            success: function (a) {
                $(".animationloadpage").hide();
                if(a.status=='1'){
                    $(".alertAjax").removeClass("alert-warning");
                    $(".alertAjax").addClass("alert-success");
    
                    //  cập nhật giỏ hàng bên phải
                    $(".widget_shopping_cart").html(a.htmlCartToggle);
                    $(".countCart").html(a.count);
                }else{
                    $(".alertAjax").removeClass("alert-success");
                    $(".alertAjax").addClass("alert-warning");
                }
                $(".alertAjax .content").html(a.message),
                $(".alertAjax").show(),
                $(".alert").delay(5000).fadeOut()
            }
        })
        
    }),
    $(".productViewed .wishlistbtn").on("click", function () {
        var b = $(this).attr("id");
        b = (b = b.split("_"))[1],
        $(this).hasClass("bg-danger") ? $(this).removeClass("bg-danger") : $(this).addClass("bg-danger"),
        $(".animationloadpage").show(),
        $.ajax("/editLoveProduct/" + b, {
            method: "GET",
            dataType: "JSON",
            contentType: !1,
            cache: !1,
            processData: !1,
            success: function (a) {
                $(".animationloadpage").hide()
            }
        })
    });
    </script>
@endif

