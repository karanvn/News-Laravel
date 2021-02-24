@extends('home.main')
@section('title') Liên hệ @endsection
<style>
	#formContact input, #formContact textarea{
		text-align: left;
	}
	.lynessa-heading.style-01 {
		padding-bottom: 12px !important;
	}
	#formContact{
		background:#fff;
		box-shadow:0 0 5pc #eee;
		padding:30px;
		border-radius:5px;
	}
	.mt-3{
		margin-top:10px;
	}
	#formContact input, #formContact textarea{
		background: #FAFAFA;
		border-width:0;
	}
	#b-submit{
		padding:10px 20px;
		border-radius:20px;
		background:#00E0FB;
		color:#fff;
		margin-top:30px;
		border-width:0;
		transition: 0.3s;
	}
	#b-submit:hover{
		background:#4f7b80;

	}
	.icon_social{
		padding:6px 0;
		transition:0.3s;
		font-size:17px;
	}
	.icon_social a{
		color: #08D5FF;
		transition:0.3s;
	}
	.icon_social:hover a{
		color: #D876FB;
	}
	.icon_social:hover{
		transform: translate(5px, 0);
	}
	.col-lienhe{
		display:inline-block;
		width:30.333%;
		background:#fff;
		box-shadow:0 0 5pc #eee;
		padding:10px;
		border-radius:5px;
		margin:1%;
		text-align:center;
		
	}
	.col-lienhe i{
		font-size:4em;
		padding:10px;
		opacity:0.7;
		transition:0.3s;
	}
	.col-lienhe:hover i{
		color:#D876FB;
	}
	.col-lienhe p{
		margin-bottom:10px;
	}
	@media only screen and (max-width: 600px) {
		.lynessa-heading.style-01 {
			padding-bottom: 5px !important;
		}
	}
</style>
@section('content')
<section class="innerpage-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right text-light">
          <h2>LIÊN HỆ</h2>
        </div>
      </div>
    </div>
</section>

<div id="vnt-content" style="padding: 100px 0 150px 0">
	<!--===BEGIN: BREADCRUMB===-->
	
	<!--===END: BREADCRUMB===-->
	<div class="container-fluid">
	   <!--===BEGIN: BOX MAIN===-->
	   <div class="box_mid">
		  <div class="mid-content">
				<div class="contant_main container">
				   <div class="row">
					  <!--===BEGIN: FORM LIÊN HỆ==-->
					  <div class="formContact col-md-6 col-xs-12 col-sm-6">
						 <form id="formContact" name="formContact" method="POST" action="{{route('contact')}}" class="form validate">
							@csrf
							<div class="mt-3">
								<input type="text" name="fullname" id="fullname" required class="form-control" placeholder="Nhập họ và tên...">
							</div>
							<div class="mt-3">
								<input type="email" name="email" id="email" required class="form-control" placeholder="Nhập email...">
							</div>
							<div class="mt-3">
								<input type="text" name="phone" id="phone" required class="form-control" placeholder="Nhập số điện thoại...">
							</div>
							<div class="mt-3">
								<textarea class="form-control" style="padding-left: 22px;" name="content" id="content" required rows="4" placeholder="Nhập nội dung.."></textarea>
							</div>
							<div class="col-12 text-center" style="text-align:right"><button id="b-submit" name="submit" type="submit" class="mt-4"><span>Gửi phản hồi</span></button></div>
						 </form>
					  </div>
					  <!--===END: FORM LIÊN HỆ==-->
					  <!--===BEGIN: THÔNG TIN LIÊN HỆ==-->
						<div class="col-md-6 col-xs-12 col-sm-6">
							<p style="color:#08D5FF">Kinh doanh hiệu quả cùng Ctrl Media</p>
							<h3>Hợp tác cùng Ctrl Media xây dựng những website ấn tượng chuẩn SEO.</h3>
							<p style="margin-top:15px;opacity:0.7">Chúng tôi không chỉ xây dựng một website bán hàng theo công nghệ hiện đại, đáp ứng các tiêu chuẩn mới phục vụ cho Quý khách bán hàng, mà đến với CTRLVN MEDIA Quý khách sẽ được tư vấn chiến lược kinh doanh ngắn hạn và dài hạn tối ưu và phù hợp nhất với ngân sách của từng thời điểm, từng quy mô.</p>
							<div class="info_contact">
							
							<div class="social">
								@if (!empty($generals['SOCIAL']['facebook']))
									<div class="icon_social">
										<a class="icon_facebook" href="{{@$generals['SOCIAL']['facebook']}}">Facebook</a>
									</div>
								@endif
								@if (!empty($generals['SOCIAL']['youtube']))
								<div class="icon_social">
									<a class="icon_youtube" href="{{@$generals['SOCIAL']['youtube']}}">Youtube</a>
								</div>
								@endif
								@if (!empty($generals['SOCIAL']['instagram']))
								<div class="icon_social">
									<a class="icon_instagram" href="{{@$generals['SOCIAL']['instagram']}}">Instagram</a>
								</div>
								@endif
								@if (!empty($generals['SOCIAL']['zalo']))
								<div class="icon_social">
									<a href="{{@$generals['SOCIAL']['zalo']}}">Zalo</a>
								</div>
								@endif
							</div>
							</div>
					  </div>
					  <!--===END: THÔNG TIN LIÊN HỆ==-->
				   </div>
				</div>
			 <!--end map-->
			 <div class="clear"></div>
		  </div>
	   </div>
	   <!--===END: BOX MAIN===-->
	</div>
</div>
<h3 class="col-md-12 text-center" style="color:#817EA7;margin:30px 0 ">
	Hãy gặp nhau
</h3>
<p class="col-md-12 text-center">Cách thức liên lạc khác</p>
<div class="meet-Ctrl container" style="margin-bottom:30px">
		<div class="col-lienhe">
			<i class="fa fa-mobile" aria-hidden="true"></i>
			<p><b>Điện thoại</b></p>
			<p>{{@$generals['SHOP']['phone']}}</p>
		</div>
		<div class="col-lienhe">
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			<p><b>Địa chỉ</b></p>
			<p>{{@$generals['SHOP']['address']}}</p>
		</div>
		<div class="col-lienhe">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<p><b>Mail</b></p>
			<p>{{@$generals['SHOP']['email']}}</p>
		</div>
</div>

<p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2587456550787!2d106.64218331480086!3d10.791483992311308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bf146ef9a57%3A0x1bd699952b23f44c!2zRXZhc2hvcHBpbmcgLSBTaG9wIGJpa2luaSwgxJHhu5MgYsahaSBu4buvLCDDoW8gbMaw4bubaSDEkWkgYmnhu4NuLCDEkeG7kyBixqFpIHRy4bq7IGVt!5e0!3m2!1svi!2s!4v1583745455647!5m2!1svi!2s" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>

<script src="{{asset('js/newpage/contact.js')}}"></script>
@endsection