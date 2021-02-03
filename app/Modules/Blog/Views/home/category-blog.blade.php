@extends('home.main')
@section('title')
{{ $nameCategory }}
@endsection
@section('content')
{{-- slide --}}

{{-- END SLIDE --}}
@if(!empty($slideCategorys)&&(count($slideCategorys)>0))
<div id="demo" class="carousel slide slideInCategory" data-ride="carousel">
    <!-- The slideshow -->
    <div class="carousel-inner">
        @php $j = 1; @endphp
        @foreach($slideCategorys as $slideCategory)
            @if(!empty($slideCategory->avatar))
                @if($j==1)
                <div class="carousel-item active">
                    <img src="{{asset('storage/banner/org/'.@$slideCategory->avatar)}}" alt="{{@$slideCategory->name}}">
                    <div class="carousel-caption">
                        <h5>{{@$slideCategory->name}}</h5>
                        <p class="text-dark">{{@$slideCategory->description}}</p>
                       @if(!empty($slideCategory->link))
                        <p>
                            <a class="btn" href="{{@$slideCategory->link}}">{{!empty($slideCategory->titlebutton) ? $slideCategory->titlebutton : 'SHOP NOW'}}</a>
                        </p>
                       @endif
                    </div>
                  </div>
                  @else

                  <div class="carousel-item">
                    <img src="{{asset('storage/banner/org/'.@$slideCategory->avatar)}}" alt="{{@$slideCategory->name}}">
                    <div class="carousel-caption">
                        <h5>{{@$slideCategory->name}}</h5>
                        <p class="text-dark">{{@$slideCategory->description}}</p>
                       @if(!empty($slideCategory->link))
                        <p>
                            <a class="btn" href="{{@$slideCategory->link}}">{{!empty($slideCategory->titlebutton) ? $slideCategory->titlebutton : 'SHOP NOW'}}</a>
                        </p>
                       @endif
                    </div>
                  </div>

                  @endif

                  @php $j = 2; @endphp

            @endif
      @endforeach
    </div>
  
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
  
  </div>

  <div class="banner-wrapper my-1 py-3">

    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ $nameCategory }}</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
        </div>
        <div class="container pb-4 Breadcrumbs_ProductShow">
            <ul>
                @if(!empty($categoryBlogs))
                    @php @$Breadcrumbs = $categoryBlogs; @endphp
                    <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->parent->slug, 'alias2' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a></li>
                    @if(!empty($Breadcrumbs->parent_id))
                    @php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
                        <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                        @if(!empty($Breadcrumbs->parent_id))
                        @php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
                            <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                        @endif
                    @endif
                @endif
                <li><a href="/">Home</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
            </ul>
        </div>
        <div class="container Breadcrumbs_ProductShowNew px-2">
            <ul></ul>
        </div>
    </div>
</div>

@else
<div class="banner-wrapper py-5">

    <div class="banner-wrapper-inner py-5">
        <h1 class="page-title">{{ $nameCategory }}</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
        </div>
        <div class="container pb-4 Breadcrumbs_ProductShow">
            <ul>
                @if(!empty($categoryBlogs))
                    @php @$Breadcrumbs = $categoryBlogs; @endphp
                    <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->parent->slug, 'alias2' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a></li>
                    @if(!empty($Breadcrumbs->parent_id))
                    @php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
                        <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                        @if(!empty($Breadcrumbs->parent_id))
                        @php @$Breadcrumbs = $Breadcrumbs->parent; @endphp
                            <li><a href="{{route('optimize_slug', ['alias1' => @$Breadcrumbs->slug. '.html'])}}">{{@$Breadcrumbs->title}}</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                        @endif
                    @endif
                @endif
                <li><a href="/">Home</a><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
            </ul>
        </div>
        <div class="container Breadcrumbs_ProductShowNew px-2">
            <ul></ul>
        </div>
    </div>
</div>
@endif

<style>
    .carousel-inner .carousel-item img{
        width:100%;
        height:450px;
        object-fit: cover;
    }
</style>


<main class="site-main main-container no-sidebar">
    <div class="container text-center">
            <div class="lynessa-heading style-01" >
                <div class="heading-inner">
                    <ul class="nav nav-tabs menu_news" role="tablist" style="justify-content: center;">
                        @foreach ($categories as $cate)
                            @if($cate->status == 'A' && $cate->position == 'BLOG')
                            <li> <a class="nav-item nav-link @if($nameCategory==$cate->title_short){{ 'active' }}@endif"
                                @if($nameCategory==$cate->title_short){{ 'style=color:#cf9163' }}@endif
                                href="{{ route('optimize_slug', ['alias1' => $cate->slug. '.html']) }}">{{ $cate->title_short }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        <div class="lynessa-blog style-01">
            <div class="blog-list-grid row auto-clear equal-container better-height " id="blog-pagination">
                @foreach ($blogs as $blog)
                @php
                // dd(getBlogParentID('0'));
                // dd($blog->category->parent->slug)
                    // die('<p style="color:red">************** DIE HERE **************</p>');
                @endphp
                <article class="post-item post-grid rows-space-30 col-bg-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-ts-6 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                    <div class="post-inner blog-grid">
                        <div class="post-thumb">
                            <a href="{{ route('optimize_slug',['alias1' => @$blog->category->parent->slug, 'alias2' => $blog->slug]) }}">
                                <img style src="{{ show_image_blog("storage/editor/blog/",$blog->image) }}" alt="img-blog-detail" width="300" height="300"> 
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <div class="post-author">
                                    <a> {{ @$blog->user->name }} </a>
                                </div>
                                <div class="date">
                                    <a>{{ date_format($blog->created_at,'d-m-Y') }}</a>
                                </div>
                                <div class="date">
                                    <a>({{ $blog->comments->count() }})Bình luận</a>
                                </div>
                            </div>
                            <div class="post-info equal-elem">
                                <h2 class="post-title">
                                    <a href="{{ route('optimize_slug', ['alias1' => $blog->slug]) }}">{{ $blog->title_short }}.</a>
                                </h2>
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <nav class="navigation pagination">
                    <div class="lynessa-MyAccount-content" style="width: 100%">
                        <div class="text-center">
                            <fieldset></fieldset>
                            <form method="post" >
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
        var lastPage = parseInt($('#lastPage').val());
        var currentPage = parseInt($('#currentPage').val());
        var nextPage = parseInt($('#currentPage').val())+1;
        
        $('#loadMore').on('click', function() {
            $('.animationloadpage').show();
            //currentPage = parseInt($('#currentPage').val())+1;
            if(nextPage<=lastPage)
            {
                $.ajax({
                url : "{{ route('fecatelog-blog-detail',$categoryBlogs->slug) }}?page="+nextPage,
                type : "get",
                dataType:"text",
                success : function (result){
                    var blog = $(result).find('#blog-pagination').html();
                    //console.log(blog);
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

        var lengBreadcrumbs = $('.Breadcrumbs_ProductShow ul > li').length;
for(var i_lengBreadcrumbs = lengBreadcrumbs; i_lengBreadcrumbs >= 1; i_lengBreadcrumbs--){
	$('.Breadcrumbs_ProductShowNew ul').append('<li>'+$('.Breadcrumbs_ProductShow ul li:nth-child('+i_lengBreadcrumbs+')').html()+'</li>');
}
$('.Breadcrumbs_ProductShow').remove();
    
    </script>
@endsection