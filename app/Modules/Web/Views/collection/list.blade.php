@extends('home.main')
@section('title'){{ @$collection->name }}@endsection
@section('content')
<style>
.lynessa-Button:hover {
    background-color: #cf9163;
}
</style>

<div class="banner-wrapper">
    {{-- <img src="{{ asset('assets/images/banner-for-all2.jpg') }}"
         class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ @$collection->name }}</h1>
    </div>
</div>

<div class="container mt-5">
    
        @if(count($products)>0)
        <div class="row" id="listCo">
            @foreach($products as $product)
		<div class="col-md-3 col-6 dscacsp">
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
							<img class="img-responsive lazyload" data-src="{{get_image_product_webp_thumb(@$product->images->first()->image_path, $product->product_id,'thumb')}}" alt="{{!empty($img->name) ? $img->name : 'image_product_notfound'}}" width="270" height="350" data-aos="fade-up">
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
        </div>

        @if($products->hasPages())
        <div class="btn-cont">
            <a class="btn" id="seeMoreCollection" >
                Xem nhiều hơn
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
                <span class="line-4"></span>
            </a>
        </div>
        @endif
        @else
            
        @endif
   
</div>
<input type="hidden" value="{{@$collection->id}}" id="idCo">
<script>
var page = 2;
$('#seeMoreCollection').on('click', function(){
		$(".animationloadpage").show();
	    $.ajax("/loadProductsCollection/"+$('#idCo').val()+"?page=" + page, {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
        $(".animationloadpage").hide();
        page++;
        console.log(a);
        $('#listCo').append(a.html);
        if(a.success == '2'){
            $(this).hide();
        }
		
		}
	})
	})
</script>

@endsection