<div class="row searchprodctView">
    <div class="col-md-6 left px-0">
		{{-- image big --}}
		<div class="wrapper pb-5 reviewsearchBig">
			<div class="carousel px-0 mx-auto bg-warning text-center">
		 {{-- for thumb --}}
			   @if(count(@$data->images)>0)
				@foreach(@$data->images as $image)
					<div class="item text-left rounded bg-warning mx-0">
						<img src="{{asset('storage/editor/source/'.@$data->product_id.'/'.@$image->image_path)}}"
						alt="{{ !empty(@$image->name) ? @$image->name : 'Images' }}">
					</div>
				@endforeach
				@else
					<img src="{{asset('admin/assets/media/products/no_product.jpg')}}" alt="image_product_notfound">
				@endif
			   {{-- end thubm --}}
			</div>
		</div>
		{{-- end image big --}}
	</div>
    <div class="col-md-6 col-8 right px-5">
		<h3 class="col-10">
			{{@$data->name}}
		</h3>

		@php $avg =round($data->evaluate->where('status','A')->avg('star')); @endphp
		@for($i=1;$i<=$avg;$i++)
			<i class="fa fa-star text-warning" aria-hidden="true"></i>
		@endfor
			@for($i=$avg+1;$i<=5;$i++)
			<i class="fa fa-star-o text-warning" aria-hidden="true"></i>
			@endfor
				<p class="d-inline py-1">{{@$data->evaluate->where('status','A')->count()}} đánh giá</p>
				<span class="px-3">|</span>
				<span>
					@if(!Auth::check())
					<a href="{{route('loginmember')}}"><i class="fa fa-heart mr-1" aria-hidden="true"></i></a>
					@else

					@if(count(@$love)>0)
					<i class="fa fa-heart mr-1 text-danger" aria-hidden="true" id="love"></i>
					@else
					<i class="fa fa-heart mr-1" aria-hidden="true" id="love"></i>
					@endif
					@endif
					<span id="loveCountSearch">{{$data->love()->count()}}</span><span>
						{{ trans('Web::home.ProductShow.love') }}</span></span>
				{{-- tình trạng --}}
				<div class="px-0 py-2" id="statusProductSearch">
					<b>{{ trans('Web::home.ProductShow.status.title') }}: </b>
					@if(count(@$data->parentproduct)==0)
					@if(@$data->qty>0)
					<span class="contentStatus">{{ trans('Web::home.ProductShow.status.stocking') }}</span>
					@else
					<span class="contentStatus">{{ trans('Web::home.ProductShow.status.noStocking') }}</span>
					@endif
					@else
					<span class="contentStatus">{{ trans('Web::home.ProductShow.status.manyOption') }}</span>
					@endif

				</div>
				{{-- giá --}}
				<div class="px-0 py-1 priceProductSearch">
					@if(@$data->sell_price>0)
					<span>
						<span class="" style="font-size:1.5em">
							<b class="sell"> {{Number_format(@$data->sell_price)}} ₫</b>
						</span>
						<span class="ml-2">
							<del class="org">
								{{Number_format(@$data->org_price)}} ₫
								<del>
						</span>
					</span>
					@else
					<span>
						<span class="" style="font-size:1.5em">
							<b class="sell">{{Number_format(@$data->org_price)}} ₫</b>
						</span>
						<span class="ml-2">
							<del class="org">

								<del>
						</span>
					</span>
					@endif
				</div>
			

				{{-- end: giá --}}
				
				{{-- xử lý màu sắc --}}
				<form action="{{route('addcart')}}" method="POST" class="col-12 px-0">
					@csrf
					@if(count(@$data->parentproduct)==0)

					<div class="col-12 mt-2">
						<div class="row">
							<div class="col-md-4 col-12 px-0">
								<input type="hidden" name="product[]" value="{{$data->product_id}}" id="id_productSearch">
								<div class="borderCount col-12">
									<div class="row">
										<div class="down col-2 text-center pt-2 next px-0">-</div>
										<input class="col-8 mx-0" min="1" name="count[{{$data->product_id}}]" value="1"
										type="number" id="countSearch">
										<div class="up col-2 text-center pt-2 next px-0">+</div>
									</div>
								</div>
							</div>



							@if($data->qty>0)
							<div class="col-8 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 noteOptionAdd">
								<button class="button btn-submit submit-newsletter px-0 col-12"
									id="btnAddCartOne">{{ trans('Web::home.ProductShow.adddCart') }}</button>
							</div>
						</div>
					</div>
					@else
					<div class="col-8 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 noteOptionAdd">
						<button class="button btn-submit submit-newsletter px-0 col-12" id="btnAddCartOne"
							disabled>{{ trans('Web::home.ProductShow.adddCart') }}</button>
					</div>
	</div>
</div>
@endif

@else
{{-- begin: triuowfng hợp có sp con --}}
{{-- lấy hàng color --}}
<div class="col-12 px-0 pt-1">
	@php
	$ArrayColor[] = '';
	$ArraySize[] = '';
	@endphp
	<div class="py-0" style="margin-bottom:-20px;">
		<div class="col-12">
			<div class="row">
				<div class="col-md-4 col-4">
					<b>{{ trans('Web::home.ProductShow.color') }}</b>
				</div>
				<div class="col-md-8 col-8">
					@foreach(@$data->parentproduct as $datacon)
					@php $features = @$datacon->features()->get() @endphp

					@foreach(@$features as $feature)

					@if((@$feature->parent_id == 1)&&(!in_array(@$feature->id, $ArrayColor)))
					<p class="elipcolorSearch mr-3 btnFeatureColorOne" style="background:{{@$feature->option}}"
						id="{{ @$feature->id }}" data-tooltip="{{@$feature->name}}"></p>
					@php $ArrayColor[] = @$feature->id; @endphp
					@endif
					@endforeach
					@endforeach
				</div>
			</div>
		</div>
	</div>
	{{-- lấy hàng màu --}}
	<div class="col-12">
		<div class="row">
			<div class="col-md-4 col-4" style="white-space: nowrap">
				<b>{{ trans('Web::home.ProductShow.size') }}</b>
			</div>
			<div class="col-md-8 col-8">
				@foreach(@$data->parentproduct as $datacon)
				@php $features = @$datacon->features()->get() @endphp

				@foreach(@$features as $feature)
				@if((@$feature->parent_id == 2)&&(!in_array(@$feature->id, $ArraySize)))

				<p class="elipsizeSearch mr-3 btnFeatureSizeOne" id="{{ @$feature->id }}" data-tooltip="{{@$feature->name}}">
					<span>
						{{@$feature->option}}
					</span></p>
				@php $ArraySize[] = @$feature->id; @endphp
				@endif
				@endforeach
				@endforeach
			</div>
			
		</div>
	</div>
	{{-- end: trường hợp có con --}}
	<div class="col-12 mt-2">
		<div class="row">
			<div class="col-4 px-0">
				<input type="hidden" name="product[]" value="" id="id_productSearch">
				<div class="borderCount col-12">
					<div class="row">
						<div class="down col-2 text-center px-0 pt-2 next">-</div>
						<input class="col-8 mx-0" min="1" name="count[]" value="1" type="number" id="countSearch">
						<div class="up col-2 text-center pt-2 next px-0">+</div>
					</div>
				</div>
			</div>
			<div class="col-8 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 noteOptionAdd">
				<button class="button btn-submit submit-newsletter px-0 col-12" id="btnAddCartOne"
					disabled>{{ trans('Web::home.ProductShow.adddCart') }}</button>
			</div>
		</div>
	</div>
</div>
@endif
</form>

{{-- shipping new --}}

<!-- Modal -->

{{-- shipping --}}
<p>
	<div class="sku_wrapper">
		<b>SKU:</b>
		<span class="sku">{{!empty(@$data->short_name) ? @$data->short_name : @$data->name}}</span>
	</div>
	<div class="posted_in">
		<b>Categories:</b>
		@if(!empty($data->categories))
		@php $i =1; @endphp
		@foreach(@$data->categories as $category)
		@if($i==1)
		<span>{{@$category->name}}</span>
		@else
		, <span>{{@$category->name}}</span>
		@endif
		@php $i =2; @endphp
		@endforeach
		@endif
	</div>

	{{-- end: xử lý màu sắc --}}

</div>
</div>
</div>

	</div>
	
</div>

</div>
</div>
</div>



					
		
		{{-- shipping new --}}
		
	  <!-- Modal -->
	 
		{{-- shipping --}}

    <input type="hidden" id="idlove" value="{{$data->product_id}}">
	<input type="hidden" id="colorSearch">
	<input type="hidden" id="sizeSearch">
	<input type="hidden" id="idSearch" value="{{$data->product_id}}">

<script src="{{asset('assets/js/slick.js')}}"></script>

<script src="{{asset('js/newpage/searchproductview.js')}}"></script>
<script>

$(document).click(function(event) { 
  $target = $(event.target);
  if(!$target.closest('.searchprodctView').length){
    $("#seeMoreParent").hide();
	$("#seeMore").html("");
  }        
});
</script>
<style>
#btnAddCartOne{
	top:0;
	left:3px;
}
</style>

