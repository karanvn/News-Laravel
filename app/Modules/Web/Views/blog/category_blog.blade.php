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

<section class="innerpage-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right">
          <h2>{{@$categoryBlogs->title}}</h2>
        </div>
      </div>
    </div>
  </section>
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

@endif

            <div class="blog-list-grid row auto-clear equal-container better-height " id="blog-pagination">
                <section id="area-main" class="padding">
                    <h5 class="hidden">hidden</h5>
                      <div class="container">
                        <div class="row">
                          <div class="col-md-8 col-sm-8">
                @foreach ($blogs as $blog)
                @php
                    $slug   = $blog->category;
                    $slug_1 = $slug->slug;
                @endphp
                <article class="blog-item-v3">
                            <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}">
                                <img src="{{get_image_blog_webp(@$blog->image)}}" alt="img-blog-detail" class="img-responsive" style="width:100%"> 
                            </a>
                            <div class="blog-content" style="margin-top:20px">
                                    <h3>{{ @$blog->title }} </h3>
                                    <ul class="blog-author">
                                        <li><a href="#."><i class="fa fa-user"></i>By Admin</a></li>
                                        <li><a href="#."><i class="fa fa-comment-o"></i>({{ $blog->comments->count() }})Bình luận</a></li>
                                        <li><a href="#."><i class="fa fa-clock-o"></i>{{ !empty($blog->created_at) ? date_format($blog->created_at,'d-m-Y') : ''}}</a></li>
                                <p>
                                    {!!@$blog->description !!}
                                </p>
                            <a href="{{ route('optimize_slug',['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blog->slug]) }}" class="btn-common btn-green bounce-top">Đọc thêm</a>
                        </div>
                </article>
                @endforeach

    @if (count($blogs) >= $limit)
        <div class="row col-12">
            <div class="col-md-4 mx-auto">
                <nav class="navigation pagination">
                    <div class="lynessa-MyAccount-content" style="width: 100%">
                        <div class="text-center">
                            <fieldset></fieldset>
                            <form method="post">
                                <input type="hidden" name="limit" id="limit" value="{{$limit}}">
                                <input type="hidden" id="currentPage" value="{{$blogs->currentPage()}}">
                                <input type="hidden" id="lastPage" value="{{$blogs->lastPage()}}">
                                <div class="btn-cont">
                                    <a class="btn" id="loadMore" style="display: block;">
                                        Xem thêm
                                        <span class="line-1"></span>
                                        <span class="line-2"></span>
                                        <span class="line-3"></span>
                                        <span class="line-4"></span>
                                    </a>
                                </div>
                                <div class="animationloadpage" style="display: none;">
                                    <div class="img"><img src="css/load.gif" alt=""></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
      
        @endif 
        </div>
        {{-- @if (count($blogs) >= $limit)
        <div class="row">
            <div class="col-md-4 mx-auto">
                <nav class="navigation pagination">
                    <div class="lynessa-MyAccount-content" style="width: 100%">
                        <div class="text-center">
                            <fieldset></fieldset>
                            <form method="post">
                                <input type="hidden" name="limit" id="limit" value="{{$limit}}">
                                <input type="hidden" id="currentPage" value="{{$blogs->currentPage()}}">
                                <input type="hidden" id="lastPage" value="{{$blogs->lastPage()}}">
                                <div class="btn-cont">
                                    <a class="btn" id="loadMore" style="display: block;">
                                        Xem thêm
                                        <span class="line-1"></span>
                                        <span class="line-2"></span>
                                        <span class="line-3"></span>
                                        <span class="line-4"></span>
                                    </a>
                                </div>
                                <div class="animationloadpage" style="display: none;">
                                    <div class="img"><img src="css/load.gif" alt=""></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
      
        @endif --}}

    <aside class="col-md-4 col-sm-4">
        <div class="widget search_box"> 
          <form method="GET" action="{{route('searchBlog')}}">
            <input type="search" placeholder="Search" name="name">
            <i class="fa fa-search"></i>
          </form>
        </div>
      
        <div class="widget"> 
          <h4>Danh mục</h4>
          <ul class="category">
              @foreach($blogCategories->where('position','BLOG')->where('parent_id','0') as $category)
            <li><a href="{{ route('optimize_slug',['alias1'=>$category->slug.'.html']) }}">{{@$category->title}}</a></li>
            @endforeach
          </ul>
        </div>
        {{-- <div class="widget"> 
          <h4>tags</h4>
          <ul class="tag-cloud">
            <li><a href="#.">ANALYSIS</a></li>
            <li><a href="#.">BOARD</a></li>
            <li><a href="#.">CAREERS</a></li>
            <li><a href="#.">DIVIDEND</a></li>
            <li><a href="#.">EMPLOYMENT</a></li>
            <li><a href="#.">FINANCE</a></li>
            <li><a href="#.">news</a></li>
            <li><a href="#.">office</a></li>
            <li><a href="#.">ANALYSIS</a></li>
            <li><a href="#.">BOARD</a></li>
            <li><a href="#.">CAREERS</a></li>
            <li><a href="#.">DIVIDEND</a></li>
            <li><a href="#.">EMPLOYMENT</a></li>
            <li><a href="#.">FINANCE</a></li>
          </ul>
        </div>
      </aside>
    </div> --}}
  </div>
</section>

@endsection

@section('script')
    <script>
        var lastPage    = parseInt($('#lastPage').val());
        var currentPage = parseInt($('#currentPage').val());
        var nextPage    = parseInt($('#currentPage').val())+1;
        var limit       = $("#limit").val();
        
        $('#loadMore').on('click', function() {
            if(nextPage<=lastPage)
            {
                $.ajax({
                url : "{{ route('optimize_slug', ['alias1' => $categoryBlogs->slug]) }}?page="+nextPage,
                type : "get",
                dataType:"text",
                success : function (result){
                    var blog = $(result).find('#blog-pagination').html();
                    $('#blog-pagination').append(blog);
                    $('#currentPage').val(nextPage);
                    nextPage++;
                }
                });
            }
            else{
                $('#loadMore').remove();
                $('.animationloadpage').hide();
            }
        });

        var lengBreadcrumbs = $('.Breadcrumbs_ProductShow ul > li').length;
        for(var i_lengBreadcrumbs = lengBreadcrumbs; i_lengBreadcrumbs >= 1; i_lengBreadcrumbs--){
            $('.Breadcrumbs_ProductShowNew ul').append('<li>'+$('.Breadcrumbs_ProductShow ul li:nth-child('+i_lengBreadcrumbs+')').html()+'</li>');
        }
        $('.Breadcrumbs_ProductShow').remove();
    
    </script>
@endsection