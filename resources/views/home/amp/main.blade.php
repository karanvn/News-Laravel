<!DOCTYPE html>
<html amp lang="vi" ⚡>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('style')
   
    @yield('meta')
    @include('home.amp.header')
    @yield('head')
</head>
<body class="single single-product">
    <amp-sidebar id='sidebar' layout='nodisplay' side="left">
        <form method="POST" action-xhr="{{route('searchBlog')}}" target="_top">
            <input type="search" placeholder="Search" name="name">
            @csrf
            <i class="fa fa-search"></i>
          </form>
        <ul class="menu_mobile">
            <li class="lever_1">
                <a href="/">Trang chủ</a>
            </li>
            <li class="lever_1">
                    <a href="#about">GIỚI THIỆU</a>
            </li>
            @foreach ($blogCategories->where('id','34') as $blogCategorie)
            <li class="lever_1">
                              <a class="page-scroll" href="{{@$blogCategorie->slug}}">{{@$blogCategorie->title}}</a>
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              <ul>
                                  @foreach ($blogCategories->where('parent_id','34') as $blogCategori)
                                        <li class="lever_1">
                                        <a class="page-scroll" href="{{@$blogCategori->slug}}">{{@$blogCategori->title}}</a>
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        <ul>
                                       @foreach ($blogCategories->where('parent_id',$blogCategori->id) as $blogCategor)
                                       <li class="lever_1">
                                          <a class="page-scroll" href="{{@$blogCategor->slug}}">{{@$blogCategor->title}}</a>
                                         </li>
                                    @endforeach
                                        </ul>
                                    </li>
                                    
                                  @endforeach
                                </ul>
                          </li> 
                      @endforeach
                      @foreach ($blogCategories->where('id','41') as $blogCategorie)
                      <li class="lever_1">
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach

                      @foreach ($blogCategories->where('id','35') as $blogCategorie)
                      <li class="lever_1">
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach

                      @foreach ($blogCategories->where('id','49') as $blogCategorie)
                      <li class="lever_1">
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach
                    

        </ul>
        <div class="divhot">
            <div><i class="fa fa-phone" aria-hidden="true"></i>HOTLINE : <a href="tel:0708669789">0708.669.789</a></div>
            <div><i class="fa fa-map-marker" aria-hidden="true"></i>STORE : <a rel="nofollow"  href="https://goo.gl/maps/hgoqfuL7vet">200 Bàu Cát, P.11, Q.Tân Bình, TPHCM</a></div>
        </div>
    </amp-sidebar> 

    <header class="header_menu" id="header">
        <div class="menu_left col-5">
            <button class="menu_bar" on='tap:sidebar.toggle' style="background:#fff;font-size: 2em;"><i class="fa fa-bars" aria-hidden="true"></i></button>
            {{-- <div class="search_icon"><i class="fa fa-search" aria-hidden="true"></i></div> --}}
        </div>
        <div class="menu_center col-7" style="text-align:right">
            <amp-img src="/Logo/logo.png" width="90" height="40"></amp-img>
        </div>
       
    </header>
    @if(session()->has('addcart'))
    <div class="alert alert-success alert-dismissible fade show addcart" role="alert">
        <strong>Tuyêt!</strong> {{ session('addcart') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show addcart_success" role="alert">
        <strong>Tuyêt!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show col-md-5 col-9 addcart_error" role="alert">
         {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="fullwidth-template">
        @yield('content')
    </div>
    <!-- start of page footer -->
    <!-- end of page footer -->


    @include('home.amp.footer')
  
    @yield('script')
</body>
</html>