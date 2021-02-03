@extends('home.main')
@section('title')
   {{ $blog->title_short }}
@endsection
@section('head')
{{--JSON-LD markup. Schema for Article--}}
@php
echo '<script type="application/ld+json">';
	@endphp {!! @$schema !!} @php
echo '</script>';
@endphp
{{-- JSON-LD markup for Breadcrumb --}}
@php
echo '<script type="application/ld+json">';
	@endphp {!! @$schemaBreadcrumbList !!} @php
echo '</script>';
@endphp
@endsection
@section('style')
<style>
    .avatar{
        width: 35px; 
        height: 35px;
        background: #C30; 
        text-align: center;
        color: #dfb99e;
        border-radius: 30px; 
        float: left;
    }
    .toc-blog{
        background-color: #fffbf8 ;
        border: 2px outset #ffdcc3 ;
        border-radius: 10px;
        text-indent:20px;
    }
    .vnt-viewed{
        border: 2px solid #bc8f9c;
        background-color:#fffbf8;
        text-indent:10px;
    }
</style>
@endsection

@section('content')
@if(session('message'))
    <input type="hidden" id="message" value="{{ session('message') }}">
    <script>
        var message = $("#message").val();
        alert(message);
    </script>
@endif
<div class="banner-wrapper">
    {{-- <img src="{{ asset('assets/images/banner-for-all2.jpg') }}" class="img-responsive attachment-1920x447 size-1920x447"
        alt="img"> --}}

    @if ($errors->any())
    @php
        $err="";
        foreach($errors->all() as $error)
        {
            $err .=$error."\n"; 
        }
    @endphp
    <input type="hidden" id="error" value="{{ @$err }}">
    <script>
        var message = $("#error").val();
        alert(message);
    </script>
@endif

    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ @$breadcrumb->title_short }}</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{ route('home') }}"><span>Home</span></a></li>
                <li class="trail-item trail-end"><a href="{{ route('feblog') }}"><span>Blog</span></a></li>
                <li class="trail-item trail-end"><a href="{{ route("optimize_slug",['alias1' => $breadcrumb->slug.'.html']) }}"><span>{{ @$breadcrumb->title_short }}</span></a></li>
                <li class="trail-item trail-end"><a><span>{{ $blog->title }}</span></a>
            </li>
            </ul>
        </div>
    </div>
</div>
<div class="main-container no-sidebar">
    <!-- POST LAYOUT -->
    <div class="container">
        <div class="row">
            <div style=" width:100%">
            {{-- <div class="main-content col-md-10 col-sm-12"> --}}
                <article
                    class="col-md-10 col-12  mx-auto blog-detail">
                    <div class="single-post-info">
                        <h2 class="post-title"><a href="#">{{ @$blog->title }}</a></h2>
                        <div class="post-meta">   
                            <div class="post-author">
                                By: {{ @$blog->user->name }} 
                            </div>
                            <div class="date">
                                <a href="#">{{ @date_format($blog->created_at,'d-m-Y') }} </a>
                            </div>
                            <div class="post-author">
                                <a href="#"> {{ $breadcrumb->title_short }} </a>
                            </div>
                            <div class="post-author">
                                ({{ $comments->count() }})Bình luận
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd($breadcrumb) }} --}}
                    <div class="single-post-thumb">
                        <div class="post-thumb">
                            <img src="storage/editor/blog/category/{{ $breadcrumb->image }}" class="attachment-full size-full wp-post-image"
                                alt="img">
                        </div>
                    </div>

                    <div id="post-content">
                        <div class="bg-light py-4 my-4 px-3">
                            <p style="color:#4f4f4f;font-size:20px" class=" mb-2"><b>Mục lục:</b></p>
                            <ol data-toc="#post-content" data-toc-headings="h2" id="toc-blog" style="">
                            </ol>
                        </div>
                        {!! @$blog->content !!}
                    </div>
                    {{-- <div class="tags"><a href="#" rel="tag">Just In</a>, <a href="#" rel="tag">Life Style</a></div> --}}
                    <div class="post-footer">
                        <div class="lynessa-share-socials">
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href={{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}%2F&layout=button&size=small&width=76&height=20&appId" width="76" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>
                        <div class="categories">
                            <span>Categories: </span>
                            <a href="{{asset($blog->category->slug.'.html')}}">{{ @$blog->category->title_short }}</a>
                        </div>
                    </div>

                    <div class="bg-light mt-4 px-2 mb-3">
                        <div class="">
                            <div><span><b><h4>Có thể bạn quan tâm</h4></b></span></div><hr>
                            <div class="gird-viewed py-0 my-0">
                                @foreach($blogsCare as $blogCare)
                                @if(@$blogCare->category->position == 'BLOG')
                                <div class="item  py-0 my-0">
                                    <div class="i-title  py-0 my-0">
                                        <div class="post-meta py-0 my-0"><a href="/{{$blogCare->slug }}">
                                                <i class="fa fa-angle-double-right"></i>
                                                {{ $blogCare->title }} </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        
                    </div>


                </article>
                <br>
               
           
                {{-- BEGIN::BLOG-REF --}}
                <div class="lynessa-heading style-01" data-aos="fade-up">
                    <div class="heading-inner">
                        <h3 class="title">
                           Bài viết liên quan<span></span>
                        </h3>
                        <div class="subtitle">
                           Danh sách các bài viết liên quan
                        </div>
                    </div>
                </div>
            <div  id="respond" class="comment-respond">
                <div class="lynessa-blog style-01">
                    <div class="blog-list-owl owl-slick equal-container better-height"
                        data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}"
                        data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @foreach($blogCates as $blogCate)
                        <article class="post-item post-grid rows-space-0 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                            <div class="post-inner blog-grid">
                                <div class="post-thumb">
                                    <a href="{{ route("optimize_slug",['alias1' => $blogCate->slug]) }}" tabindex="0">
                                        <img src="{{ show_image_blog("storage/editor/blog/",$blogCate->image) }}"
                                            class="img-responsive attachment-370x330 size-370x330" alt="img"
                                            width="370" height="330"> </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <div class="post-author">
                                            <a href="{{ route("optimize_slug",['alias1' => $blogCate->slug]) }}"> {{ @$blogCate->user->name }} </a>
                                        </div>
                                        <div class="date">
                                            <a href="{{ route("optimize_slug",['alias1' => $blogCate->slug]) }}">{{ $blogCate->created_at }}</a>
                                        </div>
                                    </div>
                                    <div class="post-info equal-elem">
                                        <h2 class="post-title"><a href="{{ route("optimize_slug",['alias1' => $blogCate->slug]) }}" tabindex="0">{{ $blogCate->title_short }}.</a></h2>
                                        {{$blog->description }}
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                {{-- END:BLOG-REF --}}                    
                <div id="comments" class="comments-area">
                    <div id="respond" class="comment-respond">
                        <h3 id="reply-title" class="comment-reply-title">Bình luận của bạn</h3>
                        <form method="post" action="{{ route('comment') }}" class="comment-form">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" class="text-left"/>
                            <p class="comment-notes"><span id="email-notes">Địa chỉ email của bạn sẽ không hiển thị tại bình luận.</span>
                                Vui lòng điền đầy đủ các trường có dấu <span class="required">*</span></p>
                            <p class="comment-reply-content">
                                <input name="name" id="name" class="input-form name text-left" placeholder="Nhập tên của bạn*" type="text">
                            </p>
                            <p class="comment-reply-content"><input name="email" id="email" class="input-form email text-left" placeholder="Nhập Email*" type="text"></p>
                            <p class="comment-form-comment"><textarea class="input-form text-left" id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="Bình luận..."></textarea>
                            </p>
                            <p class="form-submit col-12 px-0">
                                <input name="submit" id="submit" class="col-12" value="Gửi bình luận" type="submit">
                            </p>
                            <div class="animationloadpage" style="display: none;">
                                <div class="img"><img src="css/load.gif" alt=""></div>
                            </div>
                        </form>
                    </div><!-- #respond -->
                </div>
                <!-- #respond -->
            </div><!-- #comments -->
                {{-- BEGIN::COMMENT --}}
                <div class="grid-comment">
                    @if(count($comments)>0)
                    <label><h1>Bình luận</h1></label>
                    <hr>
                    @endif
                    <!--start node-->
                    {{-- {{ dd($comments) }} --}}
                    @foreach ($comments as $comment)
                    @if(!$comment->parent_id)
                    <div class="node-commnet">
                        <div class="avatar">
                            <span class="yotpo-user-letter">{{ $comment->name['0'] }}</span>
                            <span class="yotpo-icon yotpo-icon-circle-checkmark yotpo-action-hover" data-type="toggleFade" data-target="yotpo-tool-tip" data-target-container="yotpo-header"></span>
                        
                        </div>
                        <div class="info-comment">
                            <div class="info-preson">
                                <span class="name"><b>{{ $comment->name }}</b></span>
                            </div>
                            <div class="comment">
                                {{ $comment->comment }}
                                
                                @foreach($comments as $reply)
                                @if($reply->parent_id==$comment->id)
                                <div style="text-indent:50px">
                                    <div class="info_answer"><b class="qtv">Quản trị viên</b>Trả lời : </div>
                                    <div>
                                        <p>{{ $reply->comment }}</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <br>
                    @endif
                    @endforeach
                    <!--end node-->
                </div>
                {{-- END::COMMENT --}}
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#submit").on("click", function(){
        $('.animationloadpage').show();
    });
    $(window).on("load",function() {
        var count_toc_blog = $("#toc-blog li").length;
        if(count_toc_blog<=1)
        {
            $(".toc-blog").remove();
        }
    });
    
</script>
<script src="js/jquery.toc/jquery.toc.js"></script>
<script src="js/jquery.toc/jquery.toc..min.js"></script>

<style>
      .blog-detail{
           transition: 0.4s;
           box-shadow:0 0 2px #e4e4e4;
        }
     .blog-detail:hover{
            box-shadow:0 0 15px #F2F2F2;
            transform:translate(0,-14px)!important;
        }
</style>
@endsection