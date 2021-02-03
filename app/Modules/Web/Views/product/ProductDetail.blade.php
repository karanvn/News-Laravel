@extends('home.main')
@section('title'){{$data->name}}@endsection
@section('head')
<meta name="description" content="{{!empty(@$data->seo_description) ? @$data->seo_description : ''}}">
<meta name="keywords"content="{{!empty(@$data->seo_keywords) ? @$data->seo_keywords : ''}}">
{{-- SCHEMA HERE --}}
@php 
	$policies = @$generals['POLICY'];
	echo '<script type="application/ld+json">';
		@endphp {!!@$schema!!} @php
	echo '</script>';
@endphp
{{-- SCHEMA HERE --}}
@endsection
@section('content')
<style>
	.margin-top-header{
	content: '';
    padding-top: 52px;
	}
</style>
<!-- start of product-detail -->
<div class="margin-top-header"></div>
<div class="wrapper col-md-6 col-12 slidemobileZoom">
	<button class="full"><i class="fa fa-joomla" aria-hidden="true"></i></button>
	{{-- begin mobile --}}
	@if(count(@$data->images)>0)
	<div class="carouselhomeZoom px-0 container">
		@foreach(@$data->images as $image)
		<div class="px-0">
			<div class="item">
				<img src="{{get_image_product_webp_thumb(@$image->image_path, $data->product_id)}}" alt="Image product">
			</div> 
		</div>
		@endforeach
		{{-- end : for --}}
	</div>
	<div class="nextZoom"><i class="fa fa-caret-right" aria-hidden="true"></i>
	</div>
	<div class="prevZoom"><i class="fa fa-caret-left" aria-hidden="true"></i>
	</div>
	@endif
</div>
<div class="SeeimageEvaluate"><img src="" alt="image Evaluate"><button type="button" class="close text-light"><span aria-hidden="true">&times;</span></button></div>
<div class="container pb-4 Breadcrumbs_ProductShow">
	<ul>
		<li>{{@$data->name}}</li>
		@if(!empty($data->categories))
			@php @$Breadcrumbs = $data->categories[0]; @endphp
			<li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->parent->slug, 'alias2'=> @$Breadcrumbs->slug.'.html'])}}">{{@$Breadcrumbs->name}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
			@if(!empty($Breadcrumbs->parent_id))
				@php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
				<li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug.'.html'])}}">{{@$Breadcrumbs->name}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				@if(!empty($Breadcrumbs->parent_id))
					@php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
					<li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug.'.html'])}}">{{@$Breadcrumbs->name}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
				@endif
			@endif
		@endif
		<li><a href="/">Home</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
	</ul>
</div>
<div class=" Breadcrumbs_ProductShowNew px-0 pb-md-0 pb-3" data-aos="fade-right">
	<ul class="list_breadcrumb bg-light py-5 mb-md-5 mb-0"></ul>
</div>
<div class="productDetail px-0 mx-0 col-12">
	{{-- nội dung web --}}
	{{-- khu vực đầu trang web --}}
	<div class="container mx-auto pageProduct">
		<div class="row mt-2">
			{{-- slide destop --}}
			<div class="col-md-6 col-12 d-md-block d-none" data-aos="fade-up">
				{{-- begin: slide --}}
				<div class="single-left">
					<div class="lynessa-product-gallery lynessa-product-gallery--with-images lynessa-product-gallery--columns-4 images">
						<div class="flex-viewport">
							<figure class="lynessa-product-gallery__wrapper">
								@if(count(@$data->images)>0)
								@foreach(@$data->images as $image)
								<div class="lynessa-product-gallery__image">
									<img src="{{get_image_product_webp_thumb(@$image->image_path, $data->product_id)}}" alt="lazyload" style="width:1000px" class="lazyload">
								</div>
								@endforeach
								@else
									<img src="{{asset('admin/assets/media/products/no_product.svg')}}" alt="image_product_notfound">
								@endif
							</figure>
						</div>
						<ol class="flex-control-nav flex-control-thumbs">
							@if(count(@$data->images)>0)
							@foreach(@$data->images as $image)
							
							<li><img src="{{get_image_product_webp_thumb(@$image->image_path, $data->product_id,'superThumb')}}" alt="{{ !empty($image->name) ? $image->name : 'image_not_found' }}" class="lazyload">
							</li>
							@endforeach
							@else
								<img src="{{asset('admin/assets/media/products/no_product.svg')}}" alt="image_product_notfound">
							@endif
						</ol>
					</div>
				</div>
				{{-- end: slide --}}
			</div>
			{{-- slide mobile --}}
			
			<div class=" wrapper col-md-6 col-12 slidemobile d-md-none d-block">
				{{-- begin mobile --}}
				@if(count(@$data->images)>0)
				<div class="carouselhome px-0 container">
					@foreach(@$data->images as $image)
					@php
						$image_product = show_image(config('product.image.product.source_path').$data->product_id, $image->image_path, config('product.image.product.no_image'));
					@endphp
					<div class="px-0">
						<div class="item">
							<img src="{{ $image_product }}" alt="lazyload" class="lazyload">
						</div>
					</div>
					@endforeach
					{{-- end : for --}}
				</div>

				@endif
			</div>

			<div class="col-md-6 col-12">
				<h1>{{@$data->name}}</h1>
				@php $avg =round($data->evaluate->where('status','A')->avg('star')); @endphp
				@for($i=1;$i<=$avg;$i++) <i class="fa fa-star text-warning" aria-hidden="true"></i>
					@endfor
					@for($i=$avg+1;$i<=5;$i++) <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
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
							<span id="loveCount">{{$data->love()->count()}}</span><span>
								{{ trans('Web::home.ProductShow.love') }}</span></span>
					
						{{-- giá --}}
						<div class="px-0 py-1 priceProduct">
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
						<div class="col-12 py-0 mb-3" style="background:#F4F4F4">
							<div class="row">
								@for ($i = 0; $i < 3; $i++)
								<div class="col px-0">
									<div class="lynessa-iconbox style-03">
										<div class="iconbox-inner">
											<div class="icon">
												<span class="{{@$policies['icon'][$i]}}"></span>
											</div>
											<div class="content">
												<p class="title">{{@$policies['name'][$i]}}</p>
												<div class="desc"><small>{{@$policies['desc'][$i]}}</small></div>
											</div>
										</div>
									</div>
								</div>
								@endfor	
							</div>
						</div>
						{{-- end: giá --}}
						<p class="py-0 my-0">
							{!! @$data->note !!}
						</p>
						{{-- xử lý màu sắc --}}
						{{-- <form action="{{route('addcart')}}" method="POST" class="col-12 px-0"> --}}
							@csrf
							@if(count(@$data->parentproduct)==0)
								{{-- tình trạng --}}
				{{-- <div class="px-0 py-2" id="statusProduct">
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
				</div> --}}
							<div class="col-12 mt-2 px-0" style="overflow:hidden">
								<div class="row">
									<div class="col-md-4 col-12">
										<input type="hidden" name="product[]" value="{{$data->product_id}}" id="id_product">
										<div class="borderCount col-12 px-md-3 px-0">
											<div class="row">
												<div class="down col-3 next px-0 text-center">-</div>
												<input class="col-6 mx-0 border-0" min="1" name="count[{{$data->product_id}}]" value="1" type="number" id="count">
												<div class="up col-3 next px-0 text-center">+</div>
											</div>
										</div>
									</div>
									@if($data->qty>0)
									<div class="col-md-4 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 btnOptionAdd px-0 pr-md-3 pr-0 btnOptionAddAction"><button class="button btn-submit submit-newsletter px-0 col-12" name="checkout" value="ok" id="btnAddCheckout">MUA NGAY</button>
									</div>
									<div class="col-md-4 col-12 lynessa-newsletter style-04 px-0 mt-md-0 mt-3 btnOptionAdd btnOptionAddAction">
										<button class="button btn-submit submit-newsletter col-12" id="btnAddCart">{{ trans('Web::home.ProductShow.adddCart') }}</button>
									</div>
								</div>
							</div>
							@else
							<div class="col-md-8 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 noteOptionAdd">
								<button class="button btn-submit submit-newsletter px-0 col-12" id="noteOptionAdd" disabled>HẾT HÀNG</button>
							</div>
							<div class="col-md-4 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 btnOptionAdd px-0 pr-md-3 pr-0"><button class="button btn-submit submit-newsletter px-0 col-12" name="checkout" value="ok" id="btnAddCheckout" disabled>{{ trans('Web::home.ProductShow.status.noStocking') }}</button>
							</div>
							<div class="col-md-4 col-12 lynessa-newsletter style-04 px-0 mt-md-0 mt-3 btnOptionAdd">
								<button class="button btn-submit submit-newsletter col-12" id="btnAddCart" disabled>{{ trans('Web::home.ProductShow.status.noStocking') }}</button>
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
						<div class="col-md-2 col-4">
							<b>{{ trans('Web::home.ProductShow.color') }}</b>
						</div>
						<div class="col-md-10 col-8">
							@foreach(@$data->parentproduct as $datacon)
							@php $features = @$datacon->features()->get() @endphp
								@foreach(@$features as $feature)
									@if((@$feature->parent_id == 1)&&(!in_array(@$feature->id, $ArrayColor)))
									<p class="elipcolor btnFeatureColor" style="background:{{@$feature->option}}"
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
					<div class="col-md-2 col-4" style="white-space: nowrap">
						<b>{{ trans('Web::home.ProductShow.size') }}</b>
					</div>
					<div class="col-md-5 col-8">
						@foreach(@$data->parentproduct as $datacon)
						@php $features = @$datacon->features()->get() @endphp

						@foreach(@$features as $feature)
						@if((@$feature->parent_id == 2)&&(!in_array(@$feature->id, $ArraySize)))

						<p class="elipsize btnFeatureSize" id="{{ @$feature->id }}"
							data-tooltip="{{@$feature->name}}">
							<span>
								{{@$feature->option}}
							</span></p>
						@php $ArraySize[] = @$feature->id; @endphp
						@endif
						@endforeach
						@endforeach
					</div>
					<div class="col-md-5 col-12 d-md-block d-none">
						<a class="text-info" id="helpSizeBtn"
							onclick="$('#htplSizeView').show()">{{ trans('Web::home.ProductShow.helpSize') }}</a>
						<div id="htplSizeView" class="col-md-8 col-12 shadow px-0"
							style="overflow:auto;display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1234567">
							<img src="https://evashopping.vn/file/images/huong-dan-chon-size-do-boi-nu-evashopping.jpg"
								alt="{{ trans('Web::home.ProductShow.helpSize') }}" style="width:100%" class="lazyload">
							<a class="btn btn-dark text-light" onclick="$('#htplSizeView').hide()"
								style="position:absolute;top:0;right:0">
								<i class="fa fa-times" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			{{-- end: trường hợp có con --}}
				{{-- tình trạng --}}
				{{-- <div class="px-0 py-2" id="statusProduct">
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
				</div> --}}
			<div class="col-12 mt-2 px-0" style="overflow:hidden">
				<div class="row">
					<div class="col-md-4 col-12 ">
						<input type="hidden" name="product[]" value="" id="id_product">
						<div class="borderCount col-12 px-md-3 px-0">
							<div class="row">
								<div class="down col-3 text-center next px-0">-</div>
								<input class="col-6 mx-0 border-0" min="1" name="count[]" value="1" type="number" id="count">
								<div class="up col-3 text-center next px-0">+</div>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 noteOptionAdd">
						<button class="button btn-submit submit-newsletter px-0 col-12" id="noteOptionAdd" disabled>{{ trans('Web::home.ProductShow.status.manyOption') }}</button>
					</div>
					<div class="col-md-4 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 btnOptionAdd px-0 pr-md-3 pr-0"><button class="button btn-submit submit-newsletter px-0 col-12" name="checkout" value="ok" id="btnAddCheckout" disabled>{{ trans('Web::home.ProductShow.status.manyOption') }}</button>
					</div>
					<div class="col-md-4 col-12 lynessa-newsletter style-04 px-0 mt-md-0 mt-3 btnOptionAdd">
						<button class="button btn-submit submit-newsletter col-12" id="btnAddCart" disabled>{{ trans('Web::home.ProductShow.status.manyOption') }}</button>
					</div>

				</div>
			</div>
		</div>
		@endif
		{{-- </form> --}}

		{{-- shipping new --}}

		<!-- Modal -->
		<div class="modal fade col-md-4 col-11 mx-auto rounded" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content shadow">
					<div class="modal-header">
						<i class="fa fa-chevron-left" aria-hidden="true" id="leftshippingis"></i>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						{{-- tỉnh --}}
						<div class="shippingInProduct"></div>
						{{-- end: tinh --}}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
		{{-- end shipping new --}}
		{{-- shipping --}}
		<div class="border rounded px-2 py-0 mt-3">
			<button type="button" class=" btn text-dark bg-transparent" data-toggle="modal" data-target="#myModal"
				id="btnShipping">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				{{ trans('Web::home.ProductShow.ship.title') }}
			</button>
			<button class="nameLocationShipProduct text-info btn bg-transparent text-none"></button>
			<div class="shipping bg-light mt-3 px-5 rounded py-3">
				<p class="py-0 my-0">
					{{ trans('Web::home.ProductShow.ship.shippingis') }} <b><span class="countShip"></span> ₫</b>
				</p>
				<p class="py-0 my-0">
					{{ trans('Web::home.ProductShow.ship.time') }}
				</p>
			</div>
		</div>
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
					<h2>{{@$category->name}}</h2>
					@else
					, <h2>{{@$category->name}}</h2>
					@endif
					@php $i =2; @endphp
				@endforeach
				@endif
			</div>
			{{-- end: xử lý màu sắc --}}
	</div>
</div>
</div>
{{-- bình luận và cmt --}}
<div class="col-12 border-bottom border-top py-0 mt-5 text-center px-0">
	<button class=" bg-transparent  border-bottom border-earth btnTabProduct" id="info">{{ trans('Web::home.ProductShow.info') }}</button>
	<button class=" bg-transparent btnTabProduct border-earth" id="comment">{{ trans('Web::home.ProductShow.comments.title') }}</button>
	<button class=" bg-transparent btnTabProduct border-earth" id="star">{{ trans('Web::home.ProductShow.star') }}</button>
</div>
<div class="container px-3 py-5">
	<div id="pageinfo" data-aos="fade-up">
		{!! @$data->note !!}
		<br>
		{!! @$data->description !!}
	</div>
	<div id="pageComment" style="display:none">
		{{-- thông tin bình luận --}}
		<div id="contentComment">
		</div>
		<div class="btn-cont mt-5 col-12 py-2 text-center">
			<a class="btn" id="loadMoreComment">{{ trans('Web::home.ProductViewed.more') }}
				<span class="line-1"></span>
				<span class="line-2"></span>
				<span class="line-3"></span>
				<span class="line-4"></span>
			</a>
		</div>
		
		{{-- form cmt--}}
		<div class="col-12 px-0 mt-4">
			<form action="{{route('addComment')}}" method="POST" id="formCommentProduct">
				@csrf
				<input type="hidden" name="product_id" value="{{@$data->product_id}}">
				<input type="hidden" name="user_id" value="{{@Auth::id()}}" id="checkLogin">
				@if(Auth::check())
				
				<input type="hidden" name="name" value="{{@Auth::user()->name}}" placeholder="Họ tên"
					pattern="[a-zA-Z0-9\ ]{1,150}" title="Không được để trống">
				<input type="hidden" name="email" value="{{@Auth::user()->email}}" placeholder="Địa chỉ Email">
				@else
				<p class="my-0 py-1"><b>{{ trans('Web::home.ProductShow.comments.name') }}
						<span class="text-danger">*</span></b></p>
				<input type="text" name="name" value="{{@Auth::user()->name}}" placeholder="Họ tên"
					pattern="[a-zA-Z0-9\ ]{1,150}" title="Không được để trống" class="col-12 mb-4 text-left" required>
				<p class="my-0 py-1"><b>Email <span class="text-danger">*</span></b></p>
				<input type="email" name="email" value="{{@Auth::user()->email}}" placeholder="Địa chỉ Email"
					class="col-12 mb-4 text-left" required>
				@endif
				<p class="my-0 py-1"> <b>{{ trans('Web::home.ProductShow.comments.content') }}<span
							class="text-danger">*</span></b></p>
				<textarea name="comment" required class="text-left"></textarea>

				<div class="col-12 lynessa-newsletter style-04 text-center"><button
					class="button btn-submit submit-newsletter px-5 position-relative mt-3">{{ trans('Web::home.ProductShow.comments.add') }}</button>
				</div>

			</form>
		</div>
		{{-- end form cmt --}}
	</div>
	{{-- page đánh giá --}}
	<div id="pageStar" style="display:none">
		<div class="row">
			<div class="col-md-3 col-12 text-center mt-2">
				<p class="text-center" style="font-size:5em">
					{{ @$data->evaluate->where('status','A')->avg('star') != null ? $data->evaluate->where('status','A')->avg('star').'/5' : '0'}}
				</p>
				<p class="py-2">
					{{ @$data->evaluate->where('status','A')->count() .' lược đánh giá'}}
				</p>
				<div class="col-12 px-md-5 px-md-0 px-4">
					<div class="row">
						@for($j=1;$j<=5;$j++) <div class="col-7 text-right">
							<div class="star-rating"><span style="width:{{@$j*20}}%">Rated <strong class="rating"></strong> out of 5</span></div>
					</div>
					<div class="col-5 px-0 text-right">
						{{ @$data->evaluate->where('status','A')->where('star',$j)->count()}}
						{{ trans('Web::home.ProductShow.stars.title') }}
					</div>
					@endfor
				</div>
			</div>
			{{-- end form đánh giá --}}
		</div>
		<div class="col-md-9 col-12" id="">
			<div class="col-12" id="contentEvaluate">
				@if(@$data->evaluate->where('status','A')->count()<=0) <div class="alert alert-dark" role="alert">
					{{ trans('Web::home.ProductShow.stars.none') }}
			</div>
			@endif
		</div>

		<div class="btn-cont mt-5 col-12 py-2 text-center">
			<a class="btn" id="loadMoreEvaluate">{{ trans('Web::home.ProductViewed.more') }}
				<span class="line-1"></span>
				<span class="line-2"></span>
				<span class="line-3"></span>
				<span class="line-4"></span>
			</a>
		</div>


	</div>
	<div id="demo" class="col-12">
		<form action="{{route('addevaluate')}}" method="POST" class="contact-form text-left mt-5"
			enctype='multipart/form-data' id="formStarProduct">
			@csrf
			<!-- start of star -->
			<ul class="list-inline star py-3">
				<span>Your Rate <span class="text-danger">*</span></span>
				<li class="d-inline"><i class="fa fa-star-o clickstar" aria-hidden="true" id="star_1"></i></li>
				<li class="d-inline"><i class="fa fa-star-o clickstar d-inline" aria-hidden="true" id="star_2"></i></li>
				<li class="d-inline"><i class="fa fa-star-o clickstar d-inline" aria-hidden="true" id="star_3"></i></li>
				<li class="d-inline"><i class="fa fa-star-o clickstar d-inline" aria-hidden="true" id="star_4"></i></li>
				<li class="d-inline"><i class="fa fa-star-o clickstar d-inline" aria-hidden="true" id="star_5"></i></li>
			</ul>
			<input type="hidden" name="product_id" value="{{$data->product_id}}">
			<input type="hidden" max="5" min="0" name="star" id="starAdd" value="0">
			<div class="row">
				@if(Auth::check())
				<input type="hidden" name="user_id" value="{{@Auth::user()->id}}">
				<div class="col-xs-12 col-sm-6">
					<input type="hidden" name="name" class="form-control border" placeholder="Your name*" id="name"
						value="{{@Auth::user()->name}}">
				</div>
				<div class="col-xs-12 col-sm-6">
					<input type="hidden" name="email" class="form-control border" placeholder="Email address*"
						id="email" value="{{@Auth::user()->email}}">
				</div>
				@else
				<div class="col-md-6 col-12 mt-2"><b>
						{{ trans('Web::home.ProductShow.stars.name') }}
						<span class="text-danger">*</span></b>
					<input type="text" name="name" class="form-control border mt-2 text-left" placeholder="Your name*"
						id="name" value="{{@Auth::user()->name}}" required>
				</div>
				<div class="col-md-6 col-12 mt-2"><b>Email <span class="text-danger">*</span></b>
					<input type="email" name="email" class="form-control border mt-2 text-left"
						placeholder="Email address*" id="email" value="{{@Auth::user()->email}}" required>
				</div>
				@endif
			</div>
			<div class="row">
				<div class="col-xs-12 mt-2 col-12"><b>
						{{ trans('Web::home.ProductShow.stars.content') }}
						<span class="text-danger">*</span></b>
					<textarea name="content" rows="3" class="mt-2 form-control btn border col-12 text-left"
						placeholder="Your review*" id="message" required></textarea>
				</div>
			</div>
			<div class="col-md-5 col-12 mx-auto mt-2">

				<div class="row">
					<div class="col-5 text-left border px-md-2 px-0">
						<input type="file" name="image[]" multiple accept="image/x-png,image/gif,image/jpeg"
							class="d-none" id="fileImage" />
						<span onClick="(function(){
										$('#fileImage').click();
									})();return false;" class="btn py-2">
							<span class="phototask mr-2 mt-3"><i class="fa fa-camera "
									aria-hidden="true mr-1"></i></span> Gửi ảnh
						</span>
					</div>

					<div class="col-7 lynessa-newsletter style-04"><button
						class="button btn-submit submit-newsletter px-5 position-relative col-12 translate-4">{{ trans('Web::home.ProductShow.stars.add') }}</button>
					</div>

					<div class="galleryEvaluate text-left">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>
<div id="productViewed"></div>
@if (count($relatedproducts)> 0)
<div class="lynessa-heading style-01 mt-5 pt-5" data-aos="fade-up">
	<div class="heading-inner">
		<h3 class="title">
			{{ trans('Web::home.ProductShow.productRelation.title') }}<span></span>
		</h3>
		<div class="subtitle">
			{{trans('Web::home.ProductShow.productRelation.content')}}
		</div>
	</div>
</div>
<div class="lynessa-products style-05 container" data-aos="fade-up">
	<div class="response-product product-list-owl owl-slick equal-container better-height"
		data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
		data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
		@foreach(@$relatedproducts as $product)
		@php
		// dd($product);
		@endphp
		<div class="product-item best-selling style-05 rows-space-0 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple"
			data-aos="fade-up">
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
					<div class="yith-wcwl-add-to-wishlist wishlistbtn bg-danger"
						id="loveselling_{{$product->product_id}}">
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
							style="width:{{@$product->evaluate->where('status','A')->avg('star') != null ? @$product->evaluate->where('status','A')->avg('star')*20 : '0'}}%">Rated
							<strong class="rating"></strong>
							out of 5</span></div>
					<span class="review"></span>
				</div>
				<!-- kt cos gia khuyen mai ko -->
				@if(@$product->sell_price>0)
				<span class="price">
					<del>
						<span class="lynessa-Price-amount amount">
							{{Number_format(@$product->org_price)}}
							₫
						</span>
					</del>
					<ins>
						<span class="lynessa-Price-amount amount">
							{{Number_format(@$product->sell_price)}} ₫
						</span>
					</ins>
				</span>
				@else
				<span class="price">
					<ins>
						<span class="lynessa-Price-amount amount">
							{{Number_format(@$product->org_price)}}₫
						</span>
					</ins>
				</span>
				@endif
			</div>
		</div>
	</div>
	@endforeach
</div>
@endif
<style>
	.btnOptionAdd{
		display:none;
	}
	.btnOptionAddAction{
		display:inline-block;
	}
	.noteOptionAdd #noteOptionAdd
	{
		position: relative!important;
    	transform: translate(0,-4px);
	}
</style>

{{--  khu vuc đầu web --}}
{{-- end: nội dung web --}}
<input type="hidden" id="id_evaluate" value="{{$data->product_id}}">
<input type="hidden" id="color">
<input type="hidden" id="size">
<input type="hidden" id="id" value="{{$data->product_id}}">
</div>
<script src="{{asset('assets/js/slick.js')}}"></script>
<script src="{{asset('js/newpage/product/show.js')}}"></script>
<script>
	   $(".btnOptionAdd button").on("click", function () {
		//    alert($('#count').val());
		if($('#count').val()==''){
			$(".alertAjax").removeClass("alert-success");
            $(".alertAjax").addClass("alert-warning");
                $(".alertAjax .content").html('Xin hảy nhập số lượng!');
                $(".alertAjax").show();
                $(".alert").delay(5000).fadeOut();
			return;
		}
		b = $('#id_product').val();
		id_btn = $(this).attr('id');
        $(".animationloadpage").show();
        $.ajax("/addcartAjax/" + b +"?count="+$('#count').val(), {
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

					// chuyển trang nếu là mua ngay
					if(id_btn=='btnAddCheckout'){
						window.location="/checkout";
					}
                }else{
                    $(".alertAjax").removeClass("alert-success");
                    $(".alertAjax").addClass("alert-warning");
                }
                $(".alertAjax .content").html(a.message),
                $(".alertAjax").show(),
                $(".alert").delay(5000).fadeOut()
            }
        })
        
	});
	


	//  check nếu chỉ có 1 màu hoặc 1 size thì chọn sẳng 
	
	var numItemsColor = $('.btnFeatureColor').length;
	var numItemsSize = $('.btnFeatureSize').length;
	if(numItemsColor == '1'){
		$('.btnFeatureColor').click();
	}else{
		if(numItemsSize == '1'){
			$('.btnFeatureSize').click();
		}
	}
</script>
@endsection