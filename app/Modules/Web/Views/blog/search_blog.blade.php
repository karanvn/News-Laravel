@extends('home.main')
@section('title')
{{!empty($search) ? 'Kết quả tìm kiếm cho '. $search : 'Tìm kiếm'}}
@endsection
@section('head')

@endsection

@section('content')

<section class="innerpage-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right">
          <h2>{{!empty($search) ? 'Kết quả tìm kiếm cho '. $search : 'Vui lòng nhập từ khóa tìm kiếm'}}</h2>
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
            <div class="blog-list-grid row auto-clear equal-container better-height " id="blog-pagination">
                <section id="area-main" class="padding">
                    <h5 class="hidden">hidden</h5>
                      <div class="container">
                        <div class="row">
                          <div class="col-md-8 col-sm-8">
                              @if(!empty($search))
                              @if(count($blogs)<=0)
                              Không tìm thấy kết quả cho từ khóa {{@$search}}
                              @else
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
                @endif
                @else
                   <i> Vui lòng nhập từ khóa cần tìm</i>
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
       
  </div>
</section>

@endsection

@section('script')
   
@endsection