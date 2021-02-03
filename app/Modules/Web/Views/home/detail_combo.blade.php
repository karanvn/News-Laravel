@extends('home.main')
{{-- @section('title'){{$data->name}}@endsection --}}
@section('head')
{{-- <meta name="description" content="{{!empty(@$data->seo_description) ? @$data->seo_description : ''}}"> --}}
{{-- <meta name="keywords"content="{{!empty(@$data->seo_keywords) ? @$data->seo_keywords : ''}}"> --}}
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
	@php
		// dd($combo->image);
	@endphp
	@if(count(@$productsCombos)>0)
	<div class="carouselhomeZoom px-0 container">
		@foreach(@$productsCombos as $data)
				@php
					// dd($data->images()->first());
					$image_product = show_image(config('product.image.product.source_path').$data->product_id, @$data->images()->first()->image_path, config('product.image.product.no_image'));
				@endphp
				<div class="px-0">
					<div class="item">
						<img src="{{ $image_product }}" alt="Image product">
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
		<li>{{@$combo->name}}</li>
		<li><a href="/">Home</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
	</ul>
</div>
<div class=" Breadcrumbs_ProductShowNew px-0 pb-md-0 pb-3" data-aos="fade-right">
	<ul class="list_breadcrumb bg-light py-5 mb-md-5 mb-0"></ul>
</div>
<div class="productDetail px-0 mx-0 col-12">
	<div class="container mx-auto pageProduct">
		<div class="row mt-2">
			{{-- slide destop --}}
			<div class="col-md-6 col-12 d-md-block d-none" data-aos="fade-up">
				{{-- begin: slide --}}
				<div class="single-left">
					<div class="lynessa-product-gallery lynessa-product-gallery--with-images lynessa-product-gallery--columns-4 images">
						<div class="flex-viewport">
							<figure class="lynessa-product-gallery__wrapper">
							
								<div class="lynessa-product-gallery__image">
									<img src="{{'/storage/combo/org/'.@$combo->image}}" alt="lazyload" style="width:1000px" class="lazyload">
								</div>
							
							</figure>
						</div>
						<ol class="flex-control-nav flex-control-thumbs">
							@if(count(@$productsCombos)>0)
							@foreach(@$productsCombos as $item)
							@php
								// dd($item->images()->first());
								$image_product = show_image(config('product.image.product.source_path').$item->product_id, @$item->images()->first()->image_path, config('product.image.product.no_image'));
							@endphp
							<li><img src="{{ $image_product }}" title="{{$item->name .'-'. number_format($item->org_price, 0, '.', ',')}}đ" alt="{{ !empty($item->name) ? $data->name : 'image_not_found' }}" class="lazyload">
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
				@if(count(@$productsCombos)>0)
				@php
					$price_combo_total = $total = $tmp = 0;
				@endphp
				@foreach(@$productsCombos as $data)
				@php
					$total += $data->org_price;
					// dd($data->images()->first());
					$image_product = show_image(config('product.image.product.source_path').$data->product_id, @$data->images()->first()->image_path, config('product.image.product.no_image'));
					$tmp++;
				@endphp
				
				<li><img src="{{ $image_product }}" title="{{$price_combo_total}}đ" alt="{{ !empty($data->name) ? $data->name : 'image_not_found' }}" class="lazyload">
				</li>
				@endforeach
				@php
					// $real_price_total += $data->org_price;  // price real
					if($combo->unit == 1){
						// $price_combo_total += $data->org_price * ($combo->price/100);  //price combo %
						$price_combo_total = round(($total * ($combo->price/100))/$tmp, -3);  //price combo %
					}else{
						$price_combo_total = round($combo->price/$tmp, -3);  //price combo VND
					}
					// dd($price_combo_total);
				@endphp 
				@else
					<img src="{{asset('admin/assets/media/products/no_product.svg')}}" alt="image_product_notfound">
				@endif
			</div>
			<div class="col-md-6 col-12">
				<h1>{{$combo->name}}</h1>
				<div class="px-0 py-1 priceProduct">
					<span style="font-size:1.5em; color: red">
						{{-- <b class="sell">180,000₫</b> --}}
						<b class="sell">Giảm {{$combo->price. trans('Combo::combo.add.form.units.'.$combo->unit)}}</b>
				   	</span>
				   
				</div>
				<div class="col-12 py-0 mb-3 mt-3" style="background:#F4F4F4">
				<div class="row">
					<div class="col px-0">
						<div class="lynessa-iconbox style-03">
							<div class="iconbox-inner">
							<div class="icon">
								<span class="fa fa-facebook"></span>
							</div>
							<div class="content">
								<p class="title">chính sách giao hàng 123</p>
								<div class="desc"><small>thiss is a tesst</small></div>
							</div>
							</div>
						</div>
					</div>
					<div class="col px-0">
						<div class="lynessa-iconbox style-03">
							<div class="iconbox-inner">
							<div class="icon">
								<span class="pe-7s-rocket"></span>
							</div>
							<div class="content">
								<p class="title">chính sách giao hàng</p>
								<div class="desc"><small>chính sách giao hàng</small></div>
							</div>
							</div>
						</div>
					</div>
					<div class="col px-0">
						<div class="lynessa-iconbox style-03">
							<div class="iconbox-inner">
								<div class="icon">
									<span class="fa fa-facebook"></span>
								</div>
								<div class="content">
									<p class="title">WORLDWIDE DELIVERY</p>
									<div class="desc"><small>chính sách giao hàng</small></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<p class="py-0 my-0">{{$combo->notes}}</p>
				<form action="{{route('cart_combo')}}" method="post">
					@csrf
					<input type="hidden" name="count_cart" value="{{count($productsCombos)}}">
					<input type="hidden" name="id_combo" value="{{$combo->id}}">
					<input type="hidden" name="price_combo_total" value="{{$price_combo_total}}">
					<input type="hidden" name="id_products" value="{{$id_products}}">
					<div class="col-md-4 col-12 lynessa-newsletter style-04 mt-md-0 mt-3 px-0 pr-md-3 pr-0"><button class="button btn-submit submit-newsletter px-0 col-12">MUA NGAY</button>
					</div>
				</form>
		</div>
		{{-- @if (count($combos)>0)
		<section class="section section-comcbo-relative">
			<div class="container-fluid">
				<div class="lynessa-heading style-01 text-center aos-init aos-animate">
					<h3 class="title">DANH SÁCH COMBO<span></span></h3>
				</div>
				<div class="container-fluid">
					<div class="carousel_combo">
						@foreach ($combos as $item)
						<li>
							<div class="product-thumb-combo">
								<a href="{{route('optimize_slug', ['alias1'=>$item->slug.'.html'])}}"><img src="{{asset('storage/combo/org/'.@$item->image)}}" style="cursor: pointer" alt="img_combo"/></a>
							</div>
						</li>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		@endif --}}
	</div>
</div>

</div>
<script src="{{asset('assets/js/slick.js')}}"></script>
<script src="{{asset('js/newpage/product/show.js')}}"></script>
<script>
	$(document).ready(function () {
		$(".carousel_combo").slick({
			slidesToShow: 4,
			dots: !0,
			autoplay: false,
			centerMode: !1,
			slidesMargin: 10,
			prevArrow: $(".prev"),
			nextArrow: $(".next"),
			responsive: [{ breakpoint: 768, settings: { slidesToShow: 2, autoplay: !0, slidesToScroll: 1 } }],
		});
	});
</script>





@endsection