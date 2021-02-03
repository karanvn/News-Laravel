@extends('home.main')
@section('title') Liên hệ @endsection
<style>
	#formContact input, #formContact textarea{
		text-align: left;
	}
	.lynessa-heading.style-01 {
		padding-bottom: 12px !important;
	}
	@media only screen and (max-width: 600px) {
		.lynessa-heading.style-01 {
			padding-bottom: 5px !important;
		}
	}
</style>
@section('content')

<div id="vnt-content" style="padding: 100px 0 150px 0">
	<!--===BEGIN: BREADCRUMB===-->
	<div id="vnt-navation" class="breadcrumb">
		<div class="container">
			<div class="navation">
				<ul style="width: 225px; list-style: none; display: flex; margin: 0 auto">
					<li style="width: 45%; text-align: center"><a href="/">Trang chủ</a></li>
					<li style="width: 45%">Liên hệ</li>
				</ul>
			</div>
		</div>
	</div>
	<!--===END: BREADCRUMB===-->
	<div class="container-fluid">
	   <!--===BEGIN: BOX MAIN===-->
	   <div class="box_mid">
		  <div class="mid-content">
			 <div class="map">
				<p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2587456550787!2d106.64218331480086!3d10.791483992311308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bf146ef9a57%3A0x1bd699952b23f44c!2zRXZhc2hvcHBpbmcgLSBTaG9wIGJpa2luaSwgxJHhu5MgYsahaSBu4buvLCDDoW8gbMaw4bubaSDEkWkgYmnhu4NuLCDEkeG7kyBixqFpIHRy4bq7IGVt!5e0!3m2!1svi!2s!4v1583745455647!5m2!1svi!2s" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
				<div class="contant_main container">
				   <div class="row">
					  <!--===BEGIN: FORM LIÊN HỆ==-->
					  <div class="formContact col-md-8 col-xs-12 col-sm-8">
						 <h3>Để lại lời nhắn cho chúng tôi</h3>
						 <form id="formContact" name="formContact" method="POST" action="{{route('contact')}}" class="form validate">
							@csrf
							<div class="mt-3">
								<label for="name">Họ và tên <span>(*)</span></label>
								<input type="text" name="fullname" id="fullname" required class="form-control" placeholder="Nhập họ và tên...">
							</div>
							<div class="mt-3">
								<label for="email">Email <span>(*)</span></label>
								<input type="text" name="email" id="email" required class="form-control" placeholder="Nhập email...">
							</div>
							<div class="mt-3">
								<label for="phone">Số điện thoại <span>(*)</span></label>
								<input type="text" name="phone" id="phone" required class="form-control" placeholder="Nhập số điện thoại...">
							</div>
							<div class="mt-3">
								<label for="f-content">Nội dung <span>(*)</span></label>
								<textarea class="form-control" style="padding-left: 22px;" name="content" id="content" required rows="4" placeholder="Nhập nội dung.."></textarea>
							</div>
							<div class="col-12 text-center"><button id="b-submit" name="submit" type="submit" class="mt-4"><span>Gửi phản hồi</span></button></div>
						 </form>
					  </div>
					  <!--===END: FORM LIÊN HỆ==-->
					  <!--===BEGIN: THÔNG TIN LIÊN HỆ==-->
						<div class="col-md-4 col-xs-12 col-sm-4">
							<div class="info_contact">
								<h2 class="before fa-home"><span style="font-size: 14pt; color: white">{{@$generals['SHOP']['shop_name']}}</span></h2>
							<p class="before fa-map-marker">{{@$generals['SHOP']['address']}}</p>
							<p class="before fa-phone">Hotline : {{@$generals['SHOP']['phone']}}</p>
							<p class="before fa-globe">Website : <a href="https://evashopping.vn/">www.evashopping.vn</a></p>
							<p class="before fa fa-envelope-o">Email :  {{@$generals['SHOP']['email']}}</p>
							<p class="before fa fa-clock-o">Thời gian làm việc : 08:00 - 21:00 (mỗi ngày)</p>
							<div class="social" style="display: flex; width: 100%;">
								@if (@$generals['SOCIAL']['status_facebook'] == 1)
									<div class="icon_social" style="width: 12% !important">
										<a class="icon_facebook" href="{{@$generals['SOCIAL']['facebook']}}"><i class="fa fa-facebook" style="line-height: 47px;"></i></a>
									</div>
								@endif
								@if (@$generals['SOCIAL']['status_youtube'] == 1)
								<div class="icon_social" style="width: 18% !important">
									<a class="icon_youtube" href="{{@$generals['SOCIAL']['youtube']}}"><i class="fa fa-youtube"></i></a>
								</div>
								@endif
								@if (@$generals['SOCIAL']['status_instagram'] == 1)
								<div class="icon_social" style="width: 19% !important">
									<a class="icon_instagram" href="{{@$generals['SOCIAL']['instagram']}}"><i style="line-height: 47px" class="fa fa-instagram"></i></a>
								</div>
								@endif
								@if (@$generals['SOCIAL']['status_zalo'] == 1)
								<div class="icon_social">
									<a href="{{@$generals['SOCIAL']['zalo']}}"><img src="{{asset('Logo/icon-zalo.png')}}" style="margin-top: 4px" alt="icon_zalo"></a>
								</div>
								@endif
							</div>
							</div>
					  </div>
					  <!--===END: THÔNG TIN LIÊN HỆ==-->
				   </div>
				</div>
			 </div>
			 <!--end map-->
			 <div class="clear"></div>
		  </div>
	   </div>
	   <!--===END: BOX MAIN===-->
	</div>
</div>

@if (count($sliders)>0)
<section class="section section-gallery" style="margin-top: 186px">
	<div class="container-fluid">
		<div class="lynessa-heading style-01 mt-5 text-center aos-init aos-animate">
			<h3 class="title">Diện bikini đẹp cùng evashopping<span></span></h3>
		</div>
		<div class="container-fluid">
			<div class="carousel">
				@foreach ($sliders as $item)
				<li>
					<div class="product-thumb123">
						<img src="{{asset('storage/banner/org/'.@$item->avatar)}}" alt="img_gallery"/>
					</div>
				</li>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endif
<script src="{{asset('js/newpage/contact.js')}}"></script>
@endsection