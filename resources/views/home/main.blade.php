<!DOCTYPE html>
<html lang="vi">
<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <title>@yield('title')</title>
    @yield('style')
    <base href="{{asset('')}}">
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
              
            
                <div id="fixed-collapse-navbar" class="navbar-collapse collapse navbar-right">
                  <ul class="nav navbar-nav">
                    <li class="hidden">
                       <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li class="active">
                      <a href="/" class="page-scroll">TRANG CHỦ</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">GIỚI THIỆU</a>
                    </li>
                      @foreach ($blogCategories->where('id','34') as $blogCategorie)
                            <li>
                              <a class="page-scroll" href="{{@$blogCategorie->slug}}">{{@$blogCategorie->title}}</a>
                              <div class="clidLi">
                                  @foreach ($blogCategories->where('parent_id','34') as $blogCategori)
                                     <ul>
                                       <li>
                                        <a class="page-scroll" href="{{@$blogCategori->slug}}">{{@$blogCategori->title}}</a>
                                       </li>
                                       @foreach ($blogCategories->where('parent_id',$blogCategori->id) as $blogCategor)
                                         <li>
                                          <a class="page-scroll" href="{{@$blogCategor->slug}}">{{@$blogCategor->title}}</a>
                                         </li>
                                    @endforeach
                                     </ul>
                                  @endforeach
                              </div>
                          </li> 
                      @endforeach

                      @foreach ($blogCategories->where('id','41') as $blogCategorie)
                      <li>
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach

                      @foreach ($blogCategories->where('id','35') as $blogCategorie)
                      <li>
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach

                      @foreach ($blogCategories->where('id','49') as $blogCategorie)
                      <li>
                        <a href="/{{@$blogCategorie->slug}}" class="page-scroll">{{@$blogCategorie->title}}</a>
                      </li>
                      @endforeach
                    
                    <li>
                      <a href="#publication" class="page-scroll">BLOG</a>
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



