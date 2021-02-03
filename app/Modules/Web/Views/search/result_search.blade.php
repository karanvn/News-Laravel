@extends('home.main')
@section('head')
	<style>
		.not-found{
			color: red;
			font-weight: bold;
		}
		.notified, .result, .keyword{
			text-align: center; 
			width: 100%;
		}
		.result{
			padding-bottom: 20px; 
		}
		.gach_duoi{
			border: 2px solid #ea853a;
			width: 100px;
		}
		.text_search{
			padding: 150px 100px 0 100px; 
			text-align: center;
		}
		.keyword{
			padding: 20px 100px 0 100px; 
		}
	</style>
@endsection
@section('title')
	Kết quả tìm kiếm "{{@$keyword}}" - {{@$generals['SHOP']['shop_name']}}
@endsection
@section('meta')
	<meta name="description" content="{{@$generals['SHOP']['seo_description']}}" />
	<meta property="og:title" content="Kết quả tìm kiếm '{{@$keyword}}' - {{@$generals['SHOP']['shop_name']}}">
	<meta property="og:description" content="{{@$generals['SHOP']['seo_description']}}">
@endsection
@section('content')
<div class="container" data-aos="fade-up">
	<h1 class="text_search">Tìm kiếm</h1>
	@if(count($products)>0)<div class="result">Có {{count($allProducts)}} sản phẩm cho tìm kiếm</div>@endif
	<div class="gach_duoi mx-auto"></div>
</div>

<div class="container mx-auto row mt-2" id="list_product" data-aos="fade-up">
@if(count($products)>0)
<div class="col-md-12 mb-2">Kết quả tìm kiếm cho "{{$keyword}}"</div>
@foreach($products as $value)
<div class="col-md-3 col-6 list_item" data-aos="fade-up">
	<div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
		<div class="product-inner tooltip-right">
			<div class="product-thumb">
				<a class="thumb-link" href="@if(!empty($value->categories)) 
					@php	
						@$cate_slug   = $value->categories()->first();
						$slug1        = @$cate_slug->parent->slug;
						$slug2        = @$cate_slug->slug; 
						$slug3        = @$value->slug;
					@endphp 
					{{route('optimize_slug', ['alias1'=> @$slug1, 'alias2'=> @$slug2, 'alias3'=>$slug3])}}
					@endif" tabindex="0">
					<div class="xam"></div> {{--block when hover image product--}}
					@if(count($value->images)>0)
						@foreach($value->images as $img)
						@php
							$image_product = show_image(config('product.image.product.thumb_path').$value->product_id, $img->image_path, config('product.image.product.no_image'));
						@endphp
						<img class="img-responsive lazyload" data-src="{{ $image_product }}" alt="{{!empty($img->name) ? $img->name : 'image_product_notfound'}}" width="270" height="350" data-aos="fade-up">
						@php break; @endphp
						@endforeach
					@else
						<img src="{{asset('admin/assets/media/products/no_product.svg')}}" alt="image_product_notfound">
					@endif
				</a>
				<div class="flash">
					{{-- begin: giam % --}}
					@if($value->sell_price!='0')
					<span class="onsale"><span class="number">
							-{{CEIL(100 - @$value->sell_price / ($value->org_price / 100))}}%
						</span></span>
					@endif
					{{-- end: giam % --}}
				</div>
				<div class="group-button">
					@if(count($value->parentproduct)<=0) <div class="add-to-cart">
						<a class="button product_type_simple add_to_cart_button ajax_add_to_cart" id="{{$value->product_id}}">Add to cart</a>
				</div>
				@endif
				<div class="lynessa product compare-button">
					<a href="{{route('optimize_slug', ['alias1'=>$value->slug])}}" class="compare button">Compare</a>
				</div>
			</div>
		</div>

		<div class="product-info">
			<h4 class="product-name product_title">
				<a  href="@if(!empty($value->categories)) 
					@php	
						@$cate_slug   = $value->categories()->first();
						$slug1        = @$cate_slug->parent->slug;
						$slug2        = @$cate_slug->slug; 
						$slug3        = @$value->slug;
					@endphp 
					{{route('optimize_slug', ['alias1'=> @$slug1, 'alias2'=> @$slug2, 'alias3'=>$slug3])}}
					@endif" tabindex="0"> {{$value->name}}</a>
			</h4>
			<div class="rating-wapper nostar">
				<div class="star-rating"><span
						style="width:{{$value->evaluate->where('status','A')->avg('star') != null ? $value->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated
						<strong class="rating"></strong>
						out of 5</span></div>
				<span class="review"></span>
			</div>
			<!-- kt cos gia khuyen mai ko -->
			@if($value->sell_price!='0')
			<span class="price">
				<del>
					<span class="lynessa-Price-amount amount">
						{{Number_format($value->org_price)}}₫
					</span>
				</del>
				<ins>
					<span class="lynessa-Price-amount amount">
						{{Number_format($value->sell_price)}}₫
					</span>
				</ins>
			</span>
			@else
			<span class="price">
				<ins>
					<span class="lynessa-Price-amount amount">
						{{Number_format($value->org_price)}}₫
					</span>
				</ins>
			</span>
			@endif
		</div>
	</div>
</div>
</div>
@endforeach
@else
<h2 class="keyword">Không tìm thấy nội dung bạn yêu cầu</span></h2>
<h4 class="notified">Không tìm thấy "<span class="not-found">{{$keyword}}</span>". Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</h3>
@endif
</div>

<input type="hidden" name="limit" id="limit" value="{{$limit}}">
<input type="hidden" id="currentPage" value="{{$products->currentPage()}}">
<input type="hidden" id="lastPage" value="{{$products->lastPage()}}">
<input type="hidden" id="keyword" value="{{$keyword}}">

@if (count($products) >= $limit)
<p class="text-center col-12 mt-3">
	<svg class="arrows">
		<path class="a1" d="M0 0 L30 32 L60 0"></path>
		<path class="a2" d="M0 20 L30 52 L60 20"></path>
		<path class="a3" d="M0 40 L30 72 L60 40"></path>
	</svg>
	<div class="btn-cont">
		<a class="btn" id="loadMore">
			Xem nhiều hơn
			<span class="line-1"></span>
			<span class="line-2"></span>
			<span class="line-3"></span>
			<span class="line-4"></span>
		</a>
	</div>
</p>
@endif

<script src="{{asset('/js/newpage/footer.js')}}"></script>


@endsection

@section('script')
    <script>
        var lastPage    = parseInt($('#lastPage').val());
        var currentPage = parseInt($('#currentPage').val());
        var nextPage    = parseInt($('#currentPage').val())+1;
        var limit       = $("#limit").val();
        var keyword     = $("#keyword").val();
        
		$('#loadMore').on('click', function() {
			// alert(limit);
            $('.animationloadpage').show();
            if(nextPage<=lastPage)
            {
                $.ajax({
                url : "{{ route('search') }}?q="+keyword+"&page="+nextPage,
                type : "get",
				async : true,
                dataType:"text",
                success : function (result){
                    var product = $(result).find('#list_product').html();
					// console.log(product);
                    var count_per_page = (product.match(/list_item/g) || []).length;
					// alert(count_per_page);
                    if(count_per_page < Number(limit)){
                        $('#loadMore').hide();
                        $('.arrows').hide();
                    }
                    $('#list_product').append(product);
                    $('#currentPage').val(nextPage);
                    nextPage++;
                    $('.animationloadpage').hide();
                }
                });
            }
            else{
                $('#loadMore').remove();
                $('.animationloadpage').hide();
            }
        });


		
        
    
    </script>
@endsection