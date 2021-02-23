@extends('home.main')
@section('title')
{{!empty($categoryBlogs->seo_title) ? $categoryBlogs->seo_title : @$categoryBlogs->title}}
@endsection
@section('head')

@endsection
{{-- section meta --}}
@if(!empty($categoryBlogs))
    @section('meta')
    <meta name="description" content="{{@$categoryBlogs->seo_description}}"/>
    <meta name="keywords" content="{{@$categoryBlogs->seo_keywords}}"/>
    <meta name="DC.title" lang="vi" content="{{!empty($categoryBlogs->seo_title) ? $categoryBlogs->seo_title : @$categoryBlogs->title}}">
    <meta name="DC.creator" content="Thiết kế web chuyên nghiệp - CTRL MEDIA">
    <meta name="DCTERMS.abstract" content="{{@$category->seo_description}}">
    <meta property="og:title" content="{{!empty($categoryBlogs->seo_title) ? $categoryBlogs->seo_title : @$categoryBlogs->title}}">
    <meta property="og:description" content="{{@$categoryBlogs->seo_description}}">
       @php 
        $bannercategory = isset($slideCategorys) ? $slideCategorys : ''; 
    @endphp
    @if(empty($bannercategory))
        @if(count($blogs)>0)
            @php $image_blogs = asset('storage/editor/blog/').'/'.@$blogs->first()->image; @endphp
            <meta property="og:image" content="{{asset(@$image_blogs)}}">
        @endif
    @else
        @if(count($bannercategory)<=0)
            @if(count($blogs)>0)
                @php
                    $image_blogs = asset('storage/editor/blog/').'/'.@$blogs->first()->image;
                @endphp
                <meta property="og:image" content="{{asset(@$image_blogs)}}">
            @endif
        @else
            <meta property="og:image" content="{{asset('storage/banner/org/'.@$bannercategory->first()->avatar)}}">
        @endif
    @endif
    @endsection
@endif
{{-- end section meta --}}

@section('content')

<style>
  .banner_service img, .banner_service iframe{
    width:100%;
    height: 500px;
}
</style>

@if(count($slideCategorys)>0)
<div class="banner_service">
@php
    $slidei = 1;
@endphp
@foreach ($slideCategorys->where('extension','youtube') as $item)
    {!!@$item->link_youtube !!}
    @php
    $slidei++;
    break;
@endphp
@endforeach

@if($slidei==1)
@foreach ($slideCategorys as $item)
    <img src="{{get_image_banner_webp(@$item->avatar)}}" alt="">
@php
break;
@endphp
@endforeach
@endif
</div>
@else

<section class="innerpage-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right">
          <h1>{{@$categoryBlogs->title}}</h1>
        </div>
      </div>
    </div>
  </section>
@endif






<div class="container blogList-Ctrl" id="blog-pagination">
        @foreach ($blogs as $blog)
        @php
            $slug   = $blog->category;
            $slug_1 = $slug->slug;
        @endphp
        {{-- <article class="item-news">
                    <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}">
                        <img src="{{get_image_blog_webp(@$blog->image)}}" alt="img-blog-detail"> 
                    </a>
                    <div class="blog-content">
                            <h3>{{ @$blog->title }}</h3>
                            <ul class="blog-author">
                                <li><a href="#."><i class="fa fa-user"></i>By Admin</a></li>
                                <li><a href="#."><i class="fa fa-comment-o"></i>({{ $blog->comments->count() }})Bình luận</a></li>
                                <li><a href="#."><i class="fa fa-clock-o"></i>{{ !empty($blog->created_at) ? date_format($blog->created_at,'d-m-Y') : ''}}</a></li>
                            </ul>
                            <div class="content-info">
                                {!!@$blog->description !!}
                            </div>
                    {{-- <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}" class="btn-common btn-green bounce-top">Đọc thêm</a> --}}
                {{--</div>
        </article> --}}

        <div class="col-md-6 item-news">
            <div class="item-news-col">
                <div class="news-col-right">
                    <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}" title="{{ @$blog->title }}">
                        <img src="{{get_image_blog_webp(@$blog->image)}}" alt="{{ @$blog->title }}" title="{{ @$blog->title }}" class="imgboxdv ls-is-cached ">
                    </a>
                </div>
                <div class="news-col-left">
                    <h3>
                        <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}" title="{{ @$blog->title }}">
                            {{ @$blog->title }}
                        </a>
                    </h3>
                    <p style="opacity: 0.9">
                    <i class="fa fa-bars" aria-hidden="true" style="margin-right:5px"></i> <a href="#."> By Admin</a>	
                    <i class="fa fa-user-o" aria-hidden="true" style="margin:0 10px"></i> {{ !empty($blog->created_at) ? date_format($blog->created_at,'d-m-Y') : ''}} </p>
                </div>
                
            </div>
        </div>

        @endforeach

</div>

</section>
<div class=" text-center" style="margin: 30px 0">
    @if($blogs->hasMorePages())
    <input type="hidden" value="1" id="lastPage">
    <input type="hidden" value="{{@$categoryBlogs->id}}" id="category_id">
        <button id="seeMoreBlog" class="btn btn-success">
            Xem thêm
        </button>
    @endif
</div>

@endsection

@section('script')
    <script>
        var lastPage    = parseInt($('#lastPage').val());
        var currentPage = parseInt($('#currentPage').val());
        var nextPage    =lastPage+1;
        
        $('#seeMoreBlog').on('click', function() {
            $('#seeMoreBlog').html('Đang tải');
                $.ajax({
                url : "{{ route('moreBlog', ['slug' => $categoryBlogs->slug]) }}?page="+nextPage,
                type : "get",
                dataType:"json",
                success : function (result){
                    $('#blog-pagination').append(result.html);
                    nextPage++;
                    if(result.more=='0'){
                        $('#seeMoreBlog').hide();
                    }
            $('#seeMoreBlog').html('Xem thêm');

                }
                });
        });

        var lengBreadcrumbs = $('.Breadcrumbs_ProductShow ul > li').length;
        for(var i_lengBreadcrumbs = lengBreadcrumbs; i_lengBreadcrumbs >= 1; i_lengBreadcrumbs--){
            $('.Breadcrumbs_ProductShowNew ul').append('<li>'+$('.Breadcrumbs_ProductShow ul li:nth-child('+i_lengBreadcrumbs+')').html()+'</li>');
        }
        $('.Breadcrumbs_ProductShow').remove();
    
    </script>
@endsection