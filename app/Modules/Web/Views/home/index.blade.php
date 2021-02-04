@extends('home.main')
@section('title') {{@$generals['SHOP']['seo_title']}} @endsection
@section('head')
{{-- SCHEMA HERE --}}
@php
	echo '<script type="application/ld+json">';
		@endphp {!! @$schema->value !!} @php
	echo '</script>';
@endphp
{{-- SCHEMA HERE --}}
@section('meta')
<meta name="keywords" content="{{@$generals['SHOP']['seo_keyword']}}"> 
<meta name="description" content="{{@$generals['SHOP']['seo_description']}}">
<meta name="DC.title" lang="vi" content="{{@$generals['SHOP']['seo_title']}}">
<meta name="DC.creator" content="Thiết kế web chuyên nghiệp - CTRL MEDIA">
<meta name="DCTERMS.abstract" content="{{@$generals['SHOP']['seo_description']}}">
<meta property="og:title" content="{{@$generals['SHOP']['seo_title']}}">
<meta property="og:description" content="{{@$generals['SHOP']['seo_description']}}">
<meta property="og:image" content="{{asset('storage/banner/org/'.@$slides->first()->avatar)}}">
@endsection

@section('content')
   @php
	   $policies = @$generals['POLICY'];
	   $countHots = @$generals['COUNTHOT'];
	   $Expertise = @$generals['EXPERTISE'];
	   $Pricing = @$generals['PRICING'];
   @endphp
<h1 style="display:none">Ctrl Media</h1>
<section class="text-rotator">
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		<div id="paralax-slider" class="owl-carousel">
			@if(count($slides)>0)
			@foreach ($slides as $slide)
			@if(empty($imgSlide))
				@if(!empty($slide->avatar))
					@php
						$imgSlide = get_image_banner_webp($slide->avatar);
					@endphp
				@endif 
			@endif
			<div class="item">
				<div class="item-content text-center">
				  <p>{{@$slide->name}}</p>
				  <h2>{{@$slide->description}}</h2>
				</div>
			  </div>
			@endforeach
			<style>
				.text-rotator{
					background:url({{ @$imgSlide }})!important;
				}
			</style>
			@endif
		
		 
		  
		</div>
		
		</div>
	  </div>
	</div>
  </section>
  
  <!--What We Offer-->
@if(!empty($policies))
<section class="section-padding padding" id="about">
	<div class="container">
		<div class="col-md-12 text-center wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
			<p class="title">Những giá trị của dịch vụ chúng tôi</p>
			<h2 class="heading">CHÚNG TÔI CUNG CẤP</h2>
		</div>
	  <div class="row">
		@for ($i = 0; $i < 6; $i++)
		@if(!empty($policies['icon'][$i]))
		@php
		$colorPo = rand(1,6);
	@endphp
		  <div class="col-md-4 col-sm-4 canvas-box magin30 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="300ms"> 
			  <span class="text-center color{{$colorPo}}">{!! $policies['icon'][$i] !!}</span>
			  <h4 class="color{{$colorPo}}">{{$policies['name'][$i]}}</h4>
			  <p>{{$policies['desc'][$i]}}</p>
			</div>
		@endif
  @endfor
</div>
</div>
</section>
@endif
  
  
  
  
  <!-- Paralax Effect Section -->
  <div style="position:relative;">
  <section id="bg-paralax">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center">
		  <p>Bạn đang cần hổ trợ tư vấn</p>
		  <h2 class="magin30">Chúng tôi luôn sẳng sàng giải đáp thắc mắc?</h2>
		  
		  <a class="btn-green btn-common bounce-top page-scroll" href="#contact">Liên hệ</a>
		</div>
	  </div>
	</div>
  </section>
  
  </div>
  
  
  
  
  
  <!-- Responsive image with left -->
  <section id="responsive" class="padding">
	@if(count($topblogs)>0)
	@foreach ($topblogs as $topblog)
	
	<div class="container-fluid">
		<div class="row responsive-pic">
		  <div class="col-md-6 col-sm-6 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="600ms"> 
			  <img data-src="{{get_image_blog_webp(@$topblog->image)}}" alt="img-blog-detail" class="img-responsive lazyload"> 
		  </div>
		  <div class="container wow fadeInRight" data-wow-duration="500ms" data-wow-delay="900ms">
			<div class="row">
			  <div class="col-md-6 col-sm-6 r-test">
				<h3 class="magin30">{{@$topblog->title }}</h3>
				<p>{!! @$topblog->description !!}</h3></p>
				{{-- <h4>Features</h4>
				<ul class="r-feature">--}}
				{!! str_replace('<ul>','<ul class="r-feature">',@$topblog->content) !!}
				<div class="screens"> <i class="icon-laptop2"></i> <i class="icon-tablet2"></i> <i class="icon-icons202"></i> </div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>

	@endforeach
@endif
  </section>
  
  <!--Counter-->
  @if(!empty($countHots))
  <section id="facts">
	<h3 class="hidden">hidden</h3>
	<div class="container-fluid">
	  <div class="row number-counters"> 
		  @php
			  $arrCountHot = ['blue','purple','pink','green'];
		  @endphp
		<!-- first count item -->
		@for ($i = 0; $i < 4; $i++)
		@if(!empty($countHots['icon'][$i]))
		<div class="col-md-3 col-sm-3 col-xs-12 text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="300ms">
		  <div class="counters-item {{@$arrCountHot[$i]}} row">
			{!! $countHots['icon'][$i] !!}
		  <h2><strong data-to="{{$countHots['count'][$i]}}">0</strong></h2>
			<p>{{$countHots['name'][$i]}}</p>
		  </div>
		</div>
		@endif
		@endfor
	
		<!-- end first count item --> 
	  </div>
	</div>
  </section>
  @endif
  
  
  
  <!-- Skills With Round Pattern -->
  @if(!empty($Expertise))
  <section id="experties" class="padding">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center">
		  <p class="title">Những chuyên môn chính</p>
		  <h2 class="heading">Chuyên môn</h2>
		</div>
		<div class="col-md-12">
		<div class="some clearfix text-center">
			@php
			$arrCountHot = ['#07aaa5','#74C8B8','#EC768C','#C183D6','#31AAE1'];
				
			@endphp
			@for($i=0; $i< count($Expertise['name']); $i++)
		<div class="myStat2" data-text="{{@$Expertise['count'][$i]}}%" data-width="10" data-fontsize="14" data-percent="{{@$Expertise['count'][$i]}}" data-fgcolor="{{@$arrCountHot[$i]}}" data-bgcolor="#eee" data-bordersize="15"> 
		<p>{{@$Expertise['name'][$i]}}</p>
		</div>
		@endfor
	   </div>
		</div>
	  </div>
	</div>
  </section>
  @endif
  
  
  
  
  @if(count($whatWedos)>0)
 
  <!-- What We Do Section -->
  <section class="we-do bg-grey padding">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center wow fadeIn"> 
		  <p class="title">Dịch vụ của chúng tôi giúp bạn luôn hạnh phúc</p>
		  <h2 class="heading">Ctrl Media</h2>
		</div>
		@php
			  $arrCountHot = ['blue','purple','pink','green'];
		  @endphp
		@foreach ($whatWedos as $key => $whatWedo)
		<div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="200ms"> 
			<div class="do-wrap text-center"> 
			  <div class="{{@$arrCountHot[$key]}} top"></div> 
			  <span class="{{@$arrCountHot[$key]}}">{!!@$whatWedo->icon!!}</span>
			  <h4>{{@$whatWedo->title}}</h4>
			 
			{!!@$whatWedo->description!!}
			  
			<p>
				@php
				$slug1 = @$whatWedo->category->parent->slug;
				$slug2 = @$whatWedo->category->slug;
				$slug3 = @$whatWedo->slug;
			@endphp
				<a href="{{route('optimize_slug', ['alias1' => @$slug1, 'alias2'=> @$slug2, 'alias3' => @$slug3]) }}" class="readmore {{@$arrCountHot[$key]}}-text">Xem thêm</a>
			</p>
		  </div>
	  </div>
		@endforeach
		
		
		
	  </div>
	</div>
  </section>
  @endif
  
  
  
  <!-- Crteative Thinker -->
  @if(count($userAdmins)>0)
  <section id="thinkers" class="section-padding padding">
	<div class="container">
	  <div class="row text-center">
		<div class="col-md-12 wow fadeIn">
		  <p class="title">Danh sách những nhà sáng lập</p>
		  <h2 class="heading">Nhà sáng lập</h2>
		</div>
		@foreach ($userAdmins as $userAdmin)
		<div class="col-md-4 col-sm-4 wow fadeInUp zoomIn" data-wow-duration="500ms" data-wow-delay="400ms"> 
			<div class="thinker-wrap"> 
			  <div class="thinker-image">
				  <img data-src="{{asset('/storage/user/thumb/'.@$userAdmin->avatar)}}" alt="Richard" class="img-responsive lazyload">
				<div class="overlay">
				  <div class="overlay-inner">
					<ul class="social-link">
					<li><a href="{{@$userAdmin->fb}}" class="text-center"><i class="fa fa-facebook"></i><span></span></a></li>
					<li><a href="{{@$userAdmin->twiter}}" class="text-center"><i class="fa fa-twitter"></i><span></span></a></li>
					<li><a href="{{@$userAdmin->intagram}}" class="text-center"><i class="icon-instagram"></i><span></span></a></li>
				  </ul>
				  </div>
				</div>
			  </div>
			  <h3>{{@$userAdmin->name}}</h3>
			  <small>{{@$userAdmin->position}}</small>
			  <p>{{@$userAdmin->note}}</p>
			</div>
		  </div>
		@endforeach
	  </div>
	</div>
  </section>
  @endif
  
  
  
  <!-- Work Project GALLERY -->
  @if(count($galleris)>0)
  <section id="project" class="wow fadeInUp section-padding" data-wow-duration="500ms" data-wow-delay="900ms">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center">
		  <p class="title">what we do</p>
		  <h2 class="heading">Thư viện</h2>
		  <div class="work-filter">
			<ul class="text-center">
			   <li><a href="javascript:;" data-filter="all" class="active filter">All</a></li>
			   <li><a href="javascript:;" data-filter=".PROJECT" class="filter">Dự án</a></li>
			   <li><a href="javascript:;" data-filter=".DESIGN" class="filter">Thiết kế</a></li>
			   <li><a href="javascript:;" data-filter=".GRAPHIC" class="filter">Đồ họa</a></li>
			</ul>
		   </div>
		</div>
	  </div>
	</div>
	@php
		$styleGa = ['col-full','col-2-4','col-2-4','col-1-4','col-1-4','col-1-2'];
	@endphp
	
	<div class="container-fluid project-wrapper">
	  <div class="zerogrid">
		<div class="wrap-container clearfix">
		  <div class="row wrap-content">
			<div class="col-1-2">
				@php
					$sttGa = 0;
				@endphp
				@foreach ($galleris as $galleri)
				@if($sttGa>=3)
					@php
						break;
					@endphp
				@endif

				<div class="{{@$styleGa[$sttGa]}} mix work-item {{@$galleri->type}}">
					<div class="wrap-col">
						<div class="item-container"> 
						  <a class="fancybox overlay text-center" data-fancybox-group="gallery" href="{{get_image_banner_webp($galleri->avatar)}}">
								  <div class="overlay-inner">
								  <h4 class="pink-text">{{@$galleri->name}}</h4>
							<div class="line"></div>
								  <p>{{@$galleri->description}}</p>
							</div>
							  </a>
						  <img data-src="{{get_image_banner_webp($galleri->avatar)}}" alt="work" class="lazyload"/> 
						</div>
					  </div>
					</div>

				@php
					$sttGa++;
				@endphp

				@endforeach
			</div>
			@if(count($galleris)>3)
			@php
					$sttGa = 0;
				@endphp
			@foreach ($galleris as $galleri)
			@if($sttGa>2)
			
			

			<div class="{{@$styleGa[$sttGa]}} mix work-item {{@$galleri->type}}">
				<div class="wrap-col">
					<div class="item-container"> 
					  <a class="fancybox overlay text-center" data-fancybox-group="gallery" href="{{get_image_banner_webp($galleri->avatar)}}">
							  <div class="overlay-inner">
							  <h4 class="pink-text">{{@$galleri->name}}</h4>
						<div class="line"></div>
							  <p>{{@$galleri->description}}</p>
						</div>
						  </a>
					  <img data-src="{{get_image_banner_webp($galleri->avatar)}}" alt="work" class="lazyload"/> 
					</div>
				  </div>
				</div>
				@endif

			@php
				$sttGa++;
			@endphp

			@endforeach
			@endif
		   
				
	

		  </div>
		</div>
	  </div>
	</div>
  </section>
  @endif
  
@if(!empty($Pricing))
  <section class="section-padding padding" id="pricing">
  <div class="container">
  <div class="row">
  <div class="col-md-12 text-center">
  <p class="title">Đam mê sự hoàn hảo</p>
   <h2 class="heading">Bảng giá dịch vụ</h2>
  </div>
  <div class="col-md-12">
  <div class="pricing pricing_tenzin">
	  @php
		  $colorPri = ['pink','active','blue'];
	  @endphp
	  @for ($i = 0; $i<3; $i++)
	  <div class="pricing_item {{@$colorPri[$i]}}">
		<h3 class="pricing_title">{{@$Pricing['type'][$i]}}</h3>
		<div class="pricing_price"><span class="pricing_currency">đ</span>{{ Number_format(@$Pricing['price'][$i])}}</div>
		<p class="pricing_sentence">{{@$Pricing['name'][$i]}}</p>
		{!! @$Pricing['discription'][$i] !!}
		<a class="pricing_action text-center" href="#contact">Chọn lựa</a>
	</div>
	  @endfor

			  </div>
  </div>
  </div>
  </div>
			  
  </section>
  @endif
  
  
  <!-- Testinomials -->
  @if(count($raitings)>0)
  <div style="position:relative;">
  <section id="testinomial" class="padding">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center">
		  <p class="title">Phản hồi từ khách hàng</p>
		  <h2 class="heading">Phản hồi từ khách hàng</h2>
		  <div id="testinomial-slider" class="owl-carousel">
			@foreach ($raitings as $raiting)
				<div class="item">
					<p>{{@$raiting->content}}</p>
					<h5>{{@$raiting->name}}</h5>
				<p>
					@for($i=1; $i<=$raiting->star;$i++)
					<i class="fa fa-star-o" aria-hidden="true" style="color:yellow"></i>
					@endfor
				</p>
				</div>
			@endforeach
		  </div>
		</div>
	  </div>
	</div>
  </section>
  </div>
  @endif
  
  
  <!-- Latest Publications -->
  @if(count($blogFooters)>0)
  <section id="publication" class="section-padding padding">
	<div class="container">
	  <div class="row">
		<div class="col-md-12 text-center">
		  <p class="title">Stay always updated</p>
		  <h2 class="heading">Bài viết mới nhất</h2>
		</div>
	  </div>
	  <div class="row">
		<div id="publication-slider" class="owl-carousel">
		 @foreach ($blogFooters as $blogFooter)
		 @php
		 $slug1 = @$blogFooter->category->parent->slug;
		 $slug2 = @$blogFooter->category->slug;
		 $slug3 = @$blogFooter->slug;
	 @endphp
		 <div class="item"> 
			<div class="image"><a href="{{ route('optimize_slug', ['alias1' => @$slug1, 'alias2'=> @$slug2, 'alias3' => @$slug3]) }}"><img data-src="{{get_image_blog_webp(@$blogFooter->image)}}" class="lazyload" alt="publication Image"></a></div>
			  <h5>{{ date_format(@$blogFooter->created_at,'d-m-Y') }}</h5>
			  <h4>{{@$blogFooter->title}}</h4>
			  <p>by <a href="#." class="name">Admin </a></p>
			  <p>{!! @$blogFooter->description !!}</p>
			  <a href="{{ route('optimize_slug', ['alias1' => @$slug1, 'alias2'=> @$slug2, 'alias3' => @$slug3]) }}">Xem thêm</a>  
			</div>
		 @endforeach
		</div>
	  </div>
	</div>
  </section>
  @endif
  
  <section id="slogan" class="wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms"> 
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		  <h5 class="hidden">hiddens</h5>
		  <p class="pull-left">Hảy để lại lời nhắn chúng tôi sẽ chủ động liên lạc với bạn sớm nhất!</p>
		</div>
	  </div>
	</div>
  </section>
  <!-- Contact Us -->
  <section class="info-section" id="contact">
	<div class="row">
	  <div class="col-md-6 block text-center wow fadeInLeftBig" data-wow-duration="500ms" data-wow-delay="300ms" style="padding:50px 5%">
		<div class="center">
		  <p class="title">Luôn sẳng sàng!</p>
		  <h2>CHÚNG TÔI Ở ĐÂY</h2>
		  <p class="margen">
			Tránh xa những người cố gắng coi thường tham vọng của bạn Những người nhỏ bé luôn làm vậy nhưng thực sự vĩ đại Thân thiện.
		  </p>
		  <p><strong>Địa chỉ:</strong> {{@$generals['SHOP']['address']}}</p>
		  <p><strong>Số điện thoại:</strong> {{@$generals['SHOP']['phone']}}</p>
		  <p><strong>Email:</strong> <a>{{@$generals['SHOP']['email']}}</a></p>
		  <ul class="social-link">
			<li><a href="{{@$generals['SOCIAL']['facebook']}}" class="text-center"><i class="fa fa-facebook"></i><span></span></a></li>
			<li><a href="{{@$generals['SOCIAL']['twitter']}}" class="text-center"><i class="fa fa-twitter"></i><span></span></a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md-6 block light text-center wow fadeInRightBig" data-wow-duration="500ms" data-wow-delay="300ms">
		<div class="center">
		  <p class="title">Bạn đang cần hổ trợ</p>
		  <h2>Liên hệ với chúng tôi</h2>
		  <form class="form-inline" id="contact-form" onSubmit="return false">
			<div class="row">
			  <div class="col-md-12 center" style="display: none"><div id="result"></div> </div>
			</div>
			
			<div class="row">
			  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
				<input type="text" class="form-control"  placeholder="Your Name" name="name" id="name_feedback">
			  </div>
			  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
				<input type="email" class="form-control"  placeholder="E-mail Address" name="email" id="email_feedback">
			  </div>
			  <div class="col-xs-12 col-md-12">
				<textarea placeholder="Message..." class="form-control" name="content" id="content_feedback"></textarea>
				<button type="submit" class="btn-black btn-blue bounce-green" id="btn_submit_feedback">Gửi đi</button>
				<p>
					<p class="text-danger" id="err_fb"></p>
					<p class="text-success" id="ok_fb"></p>
				</p>
			  </div>
			</div>
		  </form>
		</div>
	  </div>
	</div>
  </section>
@endsection