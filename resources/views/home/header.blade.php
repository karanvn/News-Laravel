@if(!empty($slides))
  @foreach($slides as $slide)
  <link rel="preload" as="image" href="{{ get_image_banner_webp($slide->avatar)}}" />
  @endforeach
@endif
    <link rel="dns-prefetch" href="https://ajax.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://www.youtube.com">
    <link rel="dns-prefetch" href="https://i.ytimg.com"> 
    <link rel="dns-prefetch" href="https://i9.ytimg.com"> 
    <link rel="dns-prefetch" href="https://s.ytimg.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//connect.facebook.net">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    {{-- <link rel='stylesheet' id='add-google-fonts-css' href='//fonts.googleapis.com/css?family=Encode+Sans%3A400%2C500%2C600%2C700%2C8...ay=swap' type='text/css' media='all' /> --}}
    <link href="/css/pages/fontrelaway.css" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/bootstrap.min.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/font-awesome.min.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/icomoon-fonts.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/animate.min.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/settings.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/owl.carousel.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/owl.transitions.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/jquery.fancybox.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/zerogrid.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/jPushMenu.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="{{asset('template/css/onepage.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'"> 
    <link href="{{asset('css/ctrl.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'"> 
    <link href="{{asset('css/reponsive_ctrl.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'"> 
    {{-- <link href="{{asset('template/css/loader-colorful.css')}}" rel="preload" as="style" onload="this.rel='stylesheet'"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .loader {
            position: fixed;
            background: #fff;
            z-index: 11000;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }
        .spinner {
    margin: auto;
    width: 70px;
    height: 40px;
    position: relative;
    text-align: center;
    position: absolute;
    left: 50%;
    right: 50%;
    margin-left: -20px;
    top: 50%;
    -webkit-animation: sk-rotate 2.0s infinite linear;
    animation: sk-rotate 2.0s infinite linear;
}
.spinner > div {
    width: 18px;
    height: 18px;
    background-color: #333;
    border-radius: 100%;
    display: inline-block;
    -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}
.spinner .bounce1 {
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
    background-color: #82B440;
}
.spinner .bounce2 {
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
    background-color: #07AAA5;
}
.spinner .bounce3 {
    background-color: #EC768C;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% { 
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
} --}}
.navbar-brand img{
  height: 40px;
}
header{
  display: none;
}
body {
    margin: 0;
}

#slide_home{
    height: 100vh;
  }
.innerpage-banner{
    height:440px;
   
}
@media only screen and (max-width: 768px) {
  #slide_home{
    height: 50vh;
  }
  
}
#fixed-collapse-navbar li .clidLi{
  display: none;
    position: absolute;
    background: #eef;
    width: max-content;
    left: 50%;
    transform: translate(-50%, 0px);
    border-radius:4px;
}
#fixed-collapse-navbar li .clidLi ul li{
  padding:5px;
}
#fixed-collapse-navbar li .clidLi ul li:nth-child(1){
  font-weight: bold;
}
#fixed-collapse-navbar li:hover .clidLi{
 display: block;
}

#fixed-collapse-navbar li .clidLi ul{
  display: inline-table;
  padding:15px;
}

</style>



