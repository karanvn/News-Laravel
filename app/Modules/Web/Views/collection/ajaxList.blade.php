@if(count($products)>0)
	@foreach($products as $product)
		<div class="col-md-3 col-6 productViewed">
			<div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
				<div class="product-inner tooltip-right">
					<div class="product-thumb">
						<a class="thumb-link" href="@if(!empty($product->categories)) 
							@php	
								@$cate_slug   = $product->categories()->first();
								@$cate_slug_1 = @$cate_slug->slug; 
							@endphp 
							{{route('optimize_slug', ['alias1'=> @$cate_slug->parent->slug, 'alias2' => @$cate_slug_1, 'alias3' => $product->slug])}}
							@elseif(!empty($cate_slug->parent)) 
							@php
								@$cate_slug_2 = $cate_slug->parent->first()->slug;
							@endphp 
								{{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=>$product->slug])}}
							@else
								{{route('optimize_slug', ['alias1'=> @$cate_slug_1, 'alias2'=> @$cate_slug_2, 'alias3'=>$product->slug])}}
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
								<a class="button product_type_simple add_to_cart_button ajax_add_to_cart" id="addToCart_{{$product->product_id}}">Add to cart</a>
						</div>
						@endif

						<a class="button yith-wcqv-button" id="quickView_{{$product->product_id}}">Quick View</a>
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
							<strong class="rating"></strong>out of 5</span>
						</div>
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
								@if ($product->org_price != 0)
									{{Number_format($product->org_price)}}₫
								@else
									Liên hệ
								@endif
							</span>
						</ins>
					</span>
					@endif
					
				</div>
			</div>
		</div>
		</div>
	@endforeach
@endif

<div id="nay">
	
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
</div>

