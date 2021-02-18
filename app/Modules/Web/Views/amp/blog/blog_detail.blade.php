@extends('home.amp.main')
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

@section('content')

<div class="banner-wrapper">
    {{-- <amp-img src="{{ asset('assets/images/banner-for-all2.jpg') }}" class="img-responsive attachment-1920x447 size-1920x447"
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
  
@endif

    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ @$breadcrumb->title_short }}</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            @php @$Breadcrumbs = @$categoryBlogs; @endphp
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{ route('home') }}"><span>Home</span></a><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li class="trail-item trail-end"><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->parent->slug. '.html'])}}">{{@$Breadcrumbs->parent->title}}</a><i class="fa fa-angle-right" aria-hidden="true"></i>                </li>
                <li class="trail-item trail-end"><a href="{{ route("optimize_slug",['alias1' => @$Breadcrumbs->parent->slug, 'alias2' => @$Breadcrumbs->slug. '.html']) }}">{{ @$breadcrumb->title }}</a><i class="fa fa-angle-right" aria-hidden="true"></i>                </li>
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
            <div>
            {{-- <div class="main-content col-md-10 col-sm-12"> --}}
                <article
                    class="mx-auto blog-detail">
                    <div class="single-post-info">
                        <h2 class="post-title">{{ @$blog->title }}</h2>
                        <div class="post-meta">   
                            <div class="post-author col-4">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {{ @$blog->user->name }} 
                            </div>
                            <div class="date col-4">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <a href="#">{{ @date_format($blog->created_at,'d-m-Y') }} </a>
                            </div>
                            <div class="post-comment col-4" style="text-align:left">
                                ({{ $comments->count() }})Bình luận
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd($breadcrumb) }} --}}
                    <div class="single-post-thumb">
                        <div class="post-thumb">
                            <amp-img src="{{asset('storage/editor/blog')}}/{{ @$blog->image }}" class="attachment-full size-full wp-post-image"
                                alt="img" width="300" height="300"></amp-img>
                        </div>
                    </div>

                    <div id="post-content">
                       
                        @php $contentBlog = str_replace("<img","<amp-img width='700' height='403'",@$blog->content); @endphp

                            @php
                            $content = str_replace("https://www.youtube.com/embed/","",@$contentBlog);
                            $html = preg_replace('/<iframe\s+.*?\s+src=(".*?").*?<\/iframe>/', '<amp-youtube
                            data-videoid=$1
                            layout="responsive"
                            width="480" height="270"></amp-youtube>', $content);
                            echo $html;
                            @endphp
                    </div>
                    <div class="post-footer">
                        <div class="categories">
                            <span>Categories: </span>
                            <a href="{{route('optimize_slug', ['alias1' => $blog->category->parent->slug, 'alias2' => @$blog->category->slug. '.html'])}}">{{ @$blog->category->title_short }}</a>
                        </div>
                    </div>
                    <div class="bg-light mt-4 px-2 mb-3">
                        <div class="list_post_care">
                            <div><span><b><h4>Có thể bạn quan tâm</h4></b></span></div><hr>
                            <div class="gird-viewed py-0 my-0">
                                @foreach($blogsCare as $blogCare)
                                @php
                                    $slug   = $blogCare->category;
                                    $slug_1 = @$slug->slug;
                                @endphp
                                @if(@$blogCare->category->position == 'BLOG')
                                <div class="item  py-0 my-0">
                                    <div class="i-title  py-0 my-0">
                                        <div class="post-meta py-0 my-0">
                                            <a href="{{route('optimize_slug', ['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blogCare->slug])}}">
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
                        <h3 class="title">Bài viết liên quan<span></span></h3>
                        <div class="subtitle">Danh sách các bài viết liên quan</div>
                    </div>
                </div>
            <div  id="respond" class="comment-respond">
                <div class="lynessa-blog style-01">
                    <div class="blog-list-owl owl-slick equal-container better-height"
                        data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}"
                        data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @foreach($blogCates as $blogCate)
                        @php
                            $slug   = $blogCate->category;
                            $slug_1 = $slug->slug;
                        @endphp
                        <article class="post-item post-grid rows-space-0 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                            <div class="post-inner blog-grid">
                                <div class="post-thumb">
                                    <a href="{{ route("optimize_slug",['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blogCate->slug]) }}" tabindex="0">
                                        <amp-img src="{{ asset(show_image_blog("storage/editor/blog/",$blogCate->image))}}" class="img-responsive attachment-370x330 size-370x330" alt="img" width="370" height="330"></amp-img></a>
                                </div>
                                <div class="post-content">
                                    <div class="list-post-meta">
                                        <div class="list-post-author col-4">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a> {{ @$blogCate->user->name }} </a>
                                        </div>
                                        <div class="date-time col-4" style="text-align:center">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <a>{{ date_format(@$blog->created_at,'d-m-Y') }}</a>
                                        </div>
                                        <div class="list-post-comment col-4" style="text-align:center">
                                            <a>({{ @$blogCate->comments->count() }})Bình luận</a>
                                        </div>
                                    </div>
                                    <div class="post-info equal-elem">
                                        <h2 class="post-title"><a href="{{ route("optimize_slug",['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blogCate->slug]) }}" tabindex="0">{{ $blogCate->title_short }}.</a></h2>
                                        {!! split_description_blog($blogCate->description, 0, 20) !!}......
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
                        <form method="post" action-xhr="/comment" class="comment-form">
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
                            <p class="form-submit px-0">
                                <input name="submit" id="submit" value="Gửi bình luận" type="submit">
                            </p>
                           
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
                                <div>
                                    <div class="info_answer"><b class="qtv">Quản trị viên</b>Trả lời : </div>
                                    <div><p>{{ $reply->comment }}</p></div>
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
