<!DOCTYPE html>
<html lang="vi">
<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <title>@yield('title')</title>
    @yield('style')
    {{-- <base href="{{asset('')}}"> --}}
    @yield('meta')
    @include('home.header')
    @yield('head')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116660152-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-116660152-1');
    </script>
    {{-- Chèn link code --}}
    @php
        if(@$generals['LINK_CODE']['status_1'] == 1 && @$generals['LINK_CODE']['position_1'] == 'header'){
            echo @$generals['LINK_CODE']['code_1'];
        }
    @endphp
</head>
<body id="page-top" data-spy="scroll" data-target="#fixed-collapse-navbar" data-offset="120">

    {{-- <div class="loader">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
    </div> --}}
    
    

    
    <!-- Main-Navigation -->
     <header id="main-navigation">
      <div id="navigation" data-spy="affix" data-offset-top="20">
        <div class="container">
          <div class="row">
          <div class="col-md-12">
          <ul class="top-right text-right">
                <li><a href="{{@$generals['SOCIAL']['facebook']}}" class="facebook"  style="display:list-item"><i class="fa fa-facebook"></i></a></li>
                <li><a href="{{@$generals['SOCIAL']['twitter']}}" class="twitter" style="display:list-item"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{@$generals['SOCIAL']['instagram']}}" class="instagram" style="display:list-item"><i class="icon-instagram"></i></a></li>
              </ul>
              
            <nav class="navbar navbar-default">
              <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fixed-collapse-navbar" aria-expanded="true"> 
                <span class="icon-bar top-bar"></span> <span class="icon-bar middle-bar"></span> <span class="icon-bar bottom-bar"></span> 
                </button>
               <a class="navbar-brand"><img src="/Logo/logo.png" alt="logo" class="img-responsive"></a> 
             </div>
              
            
                <div id="fixed-collapse-navbar" class="navbar-collapse collapse navbar-right ">
                  <ul class="nav navbar-nav nav-ctrl">
                    <li class="hidden">
                       <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li class="active">
                      <a href="/" class="page-scroll">TRANG CHỦ</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">GIỚI THIỆU</a>
                    </li>
                    <li><a>DỊCH VỤ</a>
                    <ul class="child-Ctrl">
                     @foreach($blogCategories->where('id','34')->where('status','A')->where('parent_id','0') as $blogCategorie)
                        <li class="col-50">
                          <a href="/{{@$blogCategorie->slug}}"><b>Thiết kế website chuyên nghiệp</b></a> <i class="fa fa-chevron-right i_menu" aria-hidden="true" id="i_{{@$blogCategorie->id}}"></i>
                          <p><small>Nền tảng của thành công trên internet</small></p>
                          <ul class="menu_{{@$blogCategorie->id}}">
                          @foreach($blogCategories->where('parent_id',@$blogCategorie->id)->where('status','A') as $blogCategori)
                            <li>
                              <a href="/{{@$blogCategori->slug}}">{{@$blogCategori->title}}</a> 
                              <ul>
                                @foreach($blogCategories->where('parent_id',@$blogCategori->id)->where('status','A') as $blogCategor)
                                <li>
                                  <a href="/{{@$blogCategor->slug}}">{{@$blogCategor->title}}</a>
                                </li>
                           @endforeach
                              </ul>

                            </li>
                       @endforeach
                      </ul>
                        </li>
                     @endforeach
                     <li class="col-50"><a><b>DỊCH VỤ</b></a>  <i class="fa fa-chevron-right i_menu" aria-hidden="true" id="i_dichvu"></i>
                      <p><small>Nền tảng của thành công trên internet</small></p>
                    <ul class="menu_dichvu">
                      @foreach ($blogCategories->whereIn('id',['41','35'])->where('status','A') as $blogCategorie)
                      <li class="d-block">
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach
                        
                    
                    </ul></li>
                    </ul>
                    </li>
                      @foreach ($blogCategories->where('id','49')->where('status','A') as $blogCategorie)
                      <li>
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach
                    <li>
                      <a href="/blog.html" class="page-scroll">BLOG</a>
                      <ul class="child-Ctrl-blog">
                        @foreach ($blogCategories->where('parent_id','2')->where('status','A') as $blogCategori)
                             <li>
                              <a class="page-scroll" href="{{ route('optimize_slug',['alias1'=>'blog', 'alias2'=>$blogCategori->slug.'.html']) }}">{{@$blogCategori->title}}</a>
                              <ul>
                                @foreach ($blogCategories->where('parent_id',$blogCategori->id)->where('status','A') as $blogCategor)
                                <li>
                                 <a class="page-scroll" href="{{ route('optimize_slug',['alias1'=>'blog','alias2'=>@$blogCategori->slug,'alias3'=>$blogCategor->slug.'.html']) }}">{{@$blogCategor->title}}</a>
                                </li>
                           @endforeach
                              </ul>
                             </li>
                            
                        @endforeach
                    </ul>
                    </li>
                    <li>
                      <a href="#contact" class="page-scroll">LIÊN HỆ</a>
                    </li>
                  </ul>
                </div>
             </nav>
           </div>
           </div>
         </div>
      </div>
    </header>  
    
    @yield('content')
    
    @include('home.footer')
    @yield('script')

</body>
</html>



