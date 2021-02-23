@php
    $getTwitter   = explode('/', @$generals['SOCIAL']['twitter']);
    $current_link = url()->current();
    $current_link = !empty(@$keyword) ? $current_link . '?q='. @$keyword : $current_link;
    $title_search = 'Kết quả tìm kiếm '. @$keyword .' - '.$generals['SHOP']['shop_name'];
@endphp

<meta name="amp-google-client-id-api" content="googleanalytics">
<meta content="index,follow" name="googlebot">
<meta name="copyright" content="{{@$generals['SHOP']['coppyright']}}">
<meta name="robots" content="INDEX,FOLLOW">
<meta name="geo.region" content="VN-Hồ Chí Minh" />
<meta name="geo.placename" content="{{@$generals['SHOP']['address']}}" />
<meta name="geo.position" content="{{@$generals['SHOP']['position']}}" />
<meta name="ICBM" content="{{@$generals['SHOP']['position']}}" />  
<meta name="DC.identifier" scheme="DCTERMS.URI" content="{{$current_link}}">
<link rel="DCTERMS.replaces" hreflang="vi" href="{{$current_link}}">
<meta name="DCTERMS.issued" scheme="DCTERMS.W3CDTF" content="Saturday, 28 Nov 2020 11:23:28am ">
<meta name="DC.format" scheme="DCTERMS.IMT" content="text/html">
<meta name="DC.type" scheme="DCTERMS.DCMIType" content="Text">
<meta property="og:type" content="article">
<meta property="og:url" content="{{$current_link}}">
<link rel="canonical" href="{{$current_link}}">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{@$getTwitter[3]}}">
<meta name="twitter:title" content="{{ isset($keyword) ? $title_search : @$generals['SHOP']['seo_title']}}">
<meta name="twitter:description" content="{{@$generals['SHOP']['seo_description']}}">

<script async="" src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
<script custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js" async=""></script>
<script custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js" async=""></script>
<script custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js" async=""></script>
<script custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js" async=""></script>
<script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css2?family=Tinos&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom>
body{
        max-width:700px;
        margin:auto;
        position:fixed;
        top:0;
        left:50%;
        transform: translate(-50%,0);
    }
body,html{
font-family:Tinos,serif;
font-size : 14px;
line-height:26px;
color:#666}
label{font-weight:600;
color:#000}
    .list_post_care{
        padding: 1.5rem 0.5rem;
    }
    .post-meta{
        margin-bottom: 5px;
        padding-bottom:10px;
    }
    .post-author{
        width: 24%;
    }
    .date{
        width: 18%;
    }
    .post-comment{
        width: 8%;
        text-align: right;
    }
    .post-content .post-meta .post-author{
        width: 50%;
    }
    .post-content .post-meta .date{
        width: 50%;
        text-align: right;
    }
    .post-item .post-meta > div:not(:last-child)::after{
        display: none;
    }
    li.menu-item-228 .submenu{
            background: url('{{asset('assets/images/blog-bg.jpg')}}') right no-repeat white;
        }
        li.menu-item-228 .submenu{
            background: url('{{asset('assets/images/blog-bg.jpg')}}') right no-repeat white;
        }

       .menu-header-amp{
    padding: 0;
    margin: 0;
    position: fixed;
    top: 62px;
    left: 0;
    z-index: 123456;
    background: #fff;
    width: 70%;
    display:none;
    box-shadow: 0 0 5px #eee;
    height: 90%;
    overflow: auto;
    list-style:none;
    }
    .menu-header-amp ul{
        
    }
    .menu-header-amp li{
      padding:10px 0;
    border-top: 1px solid #A39F9D;
    }
    .menu-header-amp ul ul li:nth-child(1) a{
     font-weight: bold;
     color:#CF9163;
      }
        .menu-header-amp ul{
        display:none;
    }
    .menu-header-amp li:hover ul{
        display:block;
    }
    .menu-header-amp li:nth-child(1){
    border-top: 0px solid #555;
    }
    .menu-header-amp ul li:nth-child(1){
    border-top: 1px solid #A39F9D;
    }
    .menu-header-amp ul{
   margin-top:10px;
    }
    .menu-header-amp li a{
  color:#555;
  margin: 10px;
  
    }
    a{
        text-decoration: none;
    color:#555;

    }
    header{
        padding-top: 8px;
        height: 41px;
        box-shadow: 0 0 5px #eee;

    }
    header .logo{
        transform: translate(0px, 10px);
    text-align: right;
    }
    header #btn-menu{
   
    padding: 10px;
    background: transparent;
    border-width: 0;
    font-size: 2em;
    }
    .col {
  float: left
}

.col-left {
  float: left
}

.col-1 {
  width: 8.33333%;
  float: left;
}

.col-2 {
  width: 16.66667%;
  float: left;
}

.col-3 {
  width: 25%;
  float: left;
}

.col-4 {
  width: 33.33333%;
  float: left;
}

.col-5 {
  width: 41.66667%;
  float: left;
}

.col-6 {
  width: 50%;
  float: left;
}

.col-7 {
  width: 58.33333%;
  float: left;
}

.col-8 {
  width: 66.66667%;
  float: left;
}

.col-9 {
  width: 75%;
  float: left;
}

.col-10 {
  width: 83.33333%;
  float: left;
}

.col-11 {
  width: 91.66667%;
  float: left;
}

.col-12 {
  width: 100%;
  float: left;
}
.page-title{
    text-align:center;
    position: relative;
}
.page-title::before {
    content: '';
    width: 70px;
    height: 4px;
    background-color: #cf9163;
    position: absolute;
    bottom: -5px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    z-index: -1;
}
.breadcrumb{
    width:100%;
    list-style: none;
    text-align:center;
    padding:0;
}
.breadcrumb li{
    display:inline-block;
    position: relative;
    padding: 0 10px 0 5px;
}
.breadcrumb a{
    color:#555;
}
.breadcrumb li i{
    padding-left: 10px;
}
.blog-detail{
    padding:10px;
    box-shadow: 0 0 2px #e4e4e4;
}
.list_post_care{
   background:#eee;
}
..list_post_care a{
    color:#555;
}
.lynessa-heading.style-01 .title {
    position: relative;
    margin-bottom: 15px;
    display: table;
    margin-left: auto;
    margin-right: auto;
    font-size: 24px;
    padding-bottom: 10px;
    background-image: url(/assets/images/title-bg.png);
    background-position: center bottom -6px;
    background-repeat: no-repeat;
    background-size: cover;
    min-width: 271px;
}

.lynessa-heading.style-01 .heading-inner {
    text-align: center;
    overflow: hidden;
    margin-bottom:10px;
}
.lynessa-heading.style-01 .title span {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 4px;
    height: 4px;
    margin-left: -2px;
    background-color: #cf9163;
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
.lynessa-heading.style-01 .title span::before {
    position: absolute;
    content: '';
    bottom: 14px;
    left: -14px;
    width: 4px;
    height: 4px;
    background-color: #cf9163;
}
.lynessa-heading.style-01 .title span::after {
    position: absolute;
    content: '';
    bottom: -14px;
    right: -14px;
    width: 4px;
    height: 4px;
    background-color: #cf9163;
}
.comment-respond{
    text-align:center;
}
.blog-grid{
    margin-bottom:15px;
}
.blog-grid .post-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    position: relative;
}
h1, h2, h3, h4, h5, h6 {
    line-height: 1.2;
    color: #000;
    margin-top: 12px;
    margin-bottom: 18px;
    font-weight: 500;
}
.post-title {
    margin: 0 0 3px 0;
}
.post-content{
    padding: 0 20px;
    margin-bottom:10px;
}
.post-title{
    float: left;
    padding-top: 0px;
    text-align: left;
    width:100%;
}
.post-title a{
    color:#555;
}
.post-info, .post-info p{
    text-align: left;
    float: left;    padding-bottom: 30px
}
.comment-respond .comment-reply-title {
    font-size: 22px;
    margin-bottom: 25px;
    margin-top: 0;
}

.comments-area p {
    margin-bottom: 16px;
}
.comment-form .comment-form-author, .comment-form .comment-form-email, .comment-form .comment-reply-content {
    width: 100%;
    float: none;
}
.comment-form .comment-form-author input, .comment-form .comment-form-email input, .comment-form .comment-reply-content input {
    width: 75%;
    height: 50px;
    padding: 4px 30px;
}
input[type="number"], input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="search"], input[type="url"], textarea, select {
    border: 1px solid #ebebeb;
    background-color: transparent;
    font-size: 14px;
    color: #868686;
    line-height: 40px;
    border-radius: 0;
    width:80%;
}
.comment-form .form-submit #submit {
    vertical-align: middle;
    height: 44px;
    line-height: 44px;
    min-width: 170px;
    font-size: 12px;
    letter-spacing: 0.1em;
    font-weight: 600;
    color: #ffffff;
    background-color: #1b1b1b;
    text-transform: uppercase;
    padding: 0 15px;
    text-align: center;
    display: inline-block;
}
button, input[type="submit"], input[type="button"], .dreaming-btn {
    background: #1b1b1b;
    border: none;
    border-radius: 0;
    transition: color 0.25s, border-color 0.25s, background-color 0.25s, opacity 0.25s, width 0.25s ease 0s;
}
.section-036 {
    padding-top: 60px;
    padding-bottom: 50px;
}
.footer.style-06 {
    background-color: #f4f4f4;
}
.lynessa-listitem.style-01 .title, .lynessa-listitem.style-02 .title {
    margin-top: 0;
    margin-bottom: 15px;
    position: relative;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 600;
    color: #cf9163;
}
.lynessa-newsletter.style-04 .title {
    margin-top: 0;
    margin-bottom: 22px;
    position: relative;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 600;
    color: #cf9163;
}
.lynessa-listitem li a {
    font-size: 14px;
    position: relative;
    display: inline-block;
}
#footer{
    padding:10px;
}
#footer ul{
  list-style: none;
  color:#555;
  padding:0;
}
#footer li{
  padding:5px 0;
}
#footer ul a{
  color:#555;
}
.lynessa-newsletter .newsletter-form-inner {
    position: relative;
}
.lynessa-newsletter.style-04 .email-newsletter {
    width: 69%;
    height: 50px;
    line-height: 50px;
    background-color: #fff;
    padding-right: 70px;
    border-radius: 0;
}
.lynessa-newsletter.style-04 .submit-newsletter {
    position: absolute;
    top: 4px;
    right: 4px;
    height: 42px;
    line-height: 42px;
    border-radius: 0;
    padding: 0 46px;
    min-width: 50px;
    background: #1e1e1e;
    text-align: center;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

input[type="number"], input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="search"], input[type="url"], textarea, select {
    border: 1px solid #ebebeb;
    padding: 0 20px;
    max-width: 100%;
    font-size: 14px;
    color: #868686;
}
amp-img img{
    object-fit:contain;
}
amp-img{
    max-width:100%;
}
.menu_mobile{
    background:#fff;
    margin:0;
    padding:0;
}
.menu_mobile li{
    padding:10px 0;
    list-style: none;
    border-top:1px solid #ebebeb;
  
}
.menu_mobile li a{
   color:#555;
   padding:0 0 0 10px;
}
.menu_mobile ul{
   max-height:0;
   overflow: hidden;
   transition:0.5s;
   padding:0;
}
.menu_mobile li:hover>ul{
    max-height:60vh;
    margin-top:10px;
}
.menu_mobile li li a{
    padding-left:34px;
}
.menu_center {
    transform:translate(0, -4px);
}
.menu_mobile li span{
    float:right;
    transform: translate(-10px,0);
}
.menu_mobile li:hover>span{
    transform: translate(-10px,0) rotate(90deg);
}
.divhot div{
    padding:10px;
    background:rgb(250, 247, 247);
    border-bottom:1px solid #ebebeb;
}
.divhot div i{
    margin-right:10px;
}
h1{
    font-size : 32px;
}
h2{
    font-size : 28px;
}
h3{
    font-size  : 25px;
}
h4{
    font-size: 23px;
}
h5{
    font-size: 22px;
}
h6{
    font-size: 21px;
}
img
{
  max-width: 100%;
}
iframe
{
  width: 100%;
}
.ampstart-image-fullpage-hero>amp-img {
  max-height: calc(100vh - 3.5rem)
}

.ampstart-image-fullpage-hero>amp-img img {
  -o-object-fit: cover;
  object-fit: cover
}
.list_post_care {
    padding: 1.5rem 0.5rem;
}
#footer .footerLiAmp .listitem-list{
    max-height:0;
    overflow: hidden;
    transition: 0.3s;
}
#footer .footerLiAmp:hover .listitem-list{
    max-height: 500px;
}
.lynessa-listitem.style-01 .title span, .lynessa-listitem.style-02 .title span{
    float:right;
    padding-right:5px;
    transition: 0.3s;
}
.lynessa-listitem.style-01 .title:hover span, .lynessa-listitem.style-02 .title:hover span{
  transform: rotate(90deg);
}
.post-thumb img{
    width:100%;
    height:auto;
    object-fit: cover;
    
}
.blog-infomartion, .blog-infomartion-3{
    list-style: none;
    width: 100%;
    display: flex;
    padding: 0;
}
.blog-infomartion li{
  width:25%;
  display: inline;
  text-align: center;
  white-space: nowrap;
}
.blog-infomartion-3 li{
  width:33.33333%;
  display: inline;
  text-align: center;
  white-space: nowrap;
}
.lever_1 i{
    float: right;
    margin: 8px;
    opacity:0.6;
    transition:0.3s;
    font-size: 0.7em;
}
/* .lever_1:hover i{
    transform:rotate(90deg);
} */



</style>
