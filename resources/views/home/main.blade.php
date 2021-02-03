<!DOCTYPE html>
<html lang="vi">
<head>
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    @yield('style')
    <base href="{{asset('')}}">
    @yield('meta')
    @include('home.header')
    @yield('head')
   
    {{-- Chèn link code --}}
    @php
        if(@$generals['LINK_CODE']['status_1'] == 1 && @$generals['LINK_CODE']['position_1'] == 'header'){
            echo @$generals['LINK_CODE']['code_1'];
        }
    @endphp
</head>
<body id="page-top" data-spy="scroll" data-target="#fixed-collapse-navbar" data-offset="120">

    <div class="loader">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
    </div>
    
    
    
    
    <!-- Main-Navigation -->
     <header id="main-navigation">
      <div id="navigation" data-spy="affix" data-offset-top="20">
        <div class="container">
          <div class="row">
          <div class="col-md-12">
          <ul class="top-right text-right">
                <li><a href="{{@$generals['SOCIAL']['facebook']}}" class="facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="{{@$generals['SOCIAL']['twitter']}}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{@$generals['SOCIAL']['instagram']}}" class="instagram"><i class="icon-instagram"></i></a></li>
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
                      <a href="/" class="page-scroll">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">GIỚI THIỆU</a>
                    </li>
                     <li>
                        <a class="page-scroll" href="#thinkers">ĐỘI NGỦ</a>
                    </li>
                    <li>
                      <a href="#project" class="page-scroll">THƯ VIỆN</a>
                    </li>
                    <li>
                      <a href="#pricing" class="page-scroll">GIÁ</a>
                    </li>
                    
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
</body>
</html>



