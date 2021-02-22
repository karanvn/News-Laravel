@if(count($blogs)>0)
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
@endif