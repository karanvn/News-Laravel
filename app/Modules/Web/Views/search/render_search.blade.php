
@if(count($products)>0)
@foreach($products as $value)
<div class="col-md-3 col-6 dscacsp">
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
					<img class="img-responsive lazyload"
						src="{{asset('storage/editor/thumbs/'.$value->product_id.'/'.$img->image_path)}}"
						alt="{{!empty(@$img->name) ? @$img->name : 'E-Laravel'}}" width="270" height="350">
					@php break; @endphp
					@endforeach
					@else
					<img class="img-responsive lazyload"
					src="1234567898765" width="270" height="350">
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
	@if (count($products) >= $limit)
	<div class="text-center col-12 mt-3">
		<form action="{{route('search')}}">
			<input type="hidden" name="q" value="{{$keyword}}">
		{{-- <svg class="arrows">
			<path class="a1" d="M0 0 L30 32 L60 0"></path>
			<path class="a2" d="M0 20 L30 52 L60 20"></path>
			<path class="a3" d="M0 40 L30 72 L60 40"></path>
		</svg> --}}
			<div class="btn-cont">
				<button type="submit" class="btn" style="background: white; line-height: 5px">
					Xem nhiều sản phẩm hơn
					<span class="line-1"></span>
					<span class="line-2"></span>
					<span class="line-3"></span>
					<span class="line-4"></span>
				</button>
			</div>
		</form>
	</div>
	@endif
@else
Không tìm ra sản phẩm
@endif

<script src="{{asset('/js/newpage/footer.js')}}"></script>
