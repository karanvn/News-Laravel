@extends('home.main')
@section('title')
Blog Eva
@endsection
@section('content')
<style>
    .page-title{
        text-transform: uppercase;
    }
</style>
<!-- start of product-detail -->
<div class="banner-wrapper">
    {{-- <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    {{-- <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Blog Eva</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{ asset('') }}"><span>Home</span></a></li>
                <li class="trail-item trail-end"><a href="{{ route('optimize_slug') }}"><span>Blog Eva</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<main class="site-main main-container no-sidebar">
    <div class="container">
        
        <div class="lynessa-heading style-01">
            <div class="heading-inner">
                {{-- <ul class="nav nav-tabs menu_news" role="tablist" style="justify-content: center;">
                    @foreach ($categories as $cate)
                        @if(@$cate->status == 'A' && $cate->position == 'BLOG')
                    <li> <a class="nav-item nav-link"  href="{{route('optimize_slug', ['alias1' => $cate->slug.'.html'])}}">{{ $cate->title_short }}</a></li>
                        @endif
                    @endforeach
                </ul> --}}
                <ul class="" role="tablist" style="justify-content: center;">
                    @foreach ($categories as $cate)
                        @if(@$cate->status == 'A' && $cate->position == 'BLOG')
                    <li class="btn_filter"> <a class=""  href="{{route('optimize_slug', ['alias1' => $cate->slug.'.html'])}}">{{ $cate->title_short }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="lynessa-blog style-01">
            <div class="blog-list-grid row auto-clear equal-container better-height" id="blog-pagination">
                @foreach ($blogs as $blog)
                @php
                    $slug1 = @$blog->category->parent->slug;
                    $slug2 = @$blog->category->slug;
                    $slug3 = @$blog->slug;
                @endphp
                <article class="post-item post-grid rows-space-30 col-bg-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-ts-12 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                    <div class="post-inner blog-grid">
                        <div class="post-thumb">
                            <a href="{{ route('optimize_slug', ['alias1' => @$slug1, 'alias2'=> @$slug2, 'alias3' => @$slug3]) }}">
                                <img style src="{{get_image_blog_webp(@$blog->image)}}" alt="img-blog-detail" width="300" height="300"> 
                            </a>
                        </div>
                        <div class="post-content" style="padding: 3px">
                            <div class="list-post-meta">
                                <div class="list-post-author">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a> {{ @$blog->user->name }} </a>
                                </div>
                                <div class="date-time">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <a>{{ date_format(@$blog->created_at,'d-m-Y') }}</a>
                                </div>
                                <div class="list-post-comment">
                                    <a>({{ @$blog->comments->count() }})Bình luận</a>
                                </div>
                            </div>
                            <div class="post-info equal-elem">
                                <h2 class="post-title">
                                    <a href="{{ route('optimize_slug', ['alias1' => @$slug1, 'alias2'=> @$slug2, 'alias3' => @$slug3]) }}">{{@$blog->title_short }}.</a>
                                </h2>
                                {!! split_description_blog($blog->description, 0, 20) !!}......
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div class="shop-control shop-after-control">
            <nav class="lynessa-pagination">
                {{-- {!! $blogs->links() !!} --}}
            </nav>
            {{-- <p class="lynessa-result-count">Showing 1–12 of 20 results</p> --}}
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <nav class="navigation pagination">
                    <div class="lynessa-MyAccount-content" style="width: 100%">
                        <div class="text-center">
                            <fieldset></fieldset>
                            <form method="post">
                                <input type="hidden" name="limit" id="limit" value="{{$limit}}">
                                <input type="hidden" id="currentPage" value="{{$blogs->currentPage()}}">
                                <input type="hidden" id="lastPage" value="{{$blogs->lastPage()}}">
                                <div class="btn-cont">
                                    <a class="btn" id="loadMore" style="display: block;">Xem thêm
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
                            {{-- <p class="lynessa-result-count show-category-blogs">hiển thị</p> --}}
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    </div>
</main>

@endsection

@section('script')
    <script>
        var lastPage    = parseInt($('#lastPage').val());
        var currentPage = parseInt($('#currentPage').val());
        var nextPage    = parseInt($('#currentPage').val())+1;
        var limit       = $("#limit").val();

        $('#loadMore').on('click', function() {
            $('.animationloadpage').show();
            //currentPage = parseInt($('#currentPage').val())+1;
            if(nextPage<=lastPage)
            {
                $.ajax({
                url : "{{ route('blog') }}?page="+nextPage,
                type : "get",
                dataType:"text",
                success : function (result){
                    var blog = $(result).find('#blog-pagination').html();
                    var count_per_page = (blog.match(/post-item/g) || []).length;
                    if(count_per_page < Number(limit)){
                        $('#loadMore').hide();
                    }
                    $('#blog-pagination').append(blog);
                    $('#currentPage').val(nextPage);
                    nextPage++;
                    $('.animationloadpage').hide();
                }
                });
            }
            else{
                $('#loadMore').remove();
                $('.animationloadpage').hide();
            }
        });
        
    
    </script>
@endsection