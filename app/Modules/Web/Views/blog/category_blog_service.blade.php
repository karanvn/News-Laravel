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


@if(count($slideCategorys)>0)
<div class="banner_service">
    @php
        $slidei = 1;
    @endphp
    @foreach ($slideCategorys->where('extension','youtube') as $item)
    @php
     $link_youtube_banner = preg_replace('/[a-zA-Z0-9-]+$/', '$0?autoplay=1&amp;mute=1&amp;loop=1&amp;controls=1&amp;showinfo=0?autoplay=1&amp;mute=1&amp;loop=1&amp;controls=0&amp;showinfo=0&amp;playlist=$0', $item->link_youtube);
    @endphp
            <iframe src="{{$link_youtube_banner}}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="width:100%" class=" lazyloaded"></iframe>
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

@endif

 <div class="container-fuild">
     <h1 class="text-center" style="padding:15px">{{@$categoryBlogs->title}}</h1>
     <div class="col-12" style="padding:50px 20px">
        <div class="row">
            <div class="container">
                <h3>Giới thiệu</h3>
                {!!@$categoryBlogs->description!!}
                <br>
                {!! @$categoryBlogs->content !!}
            </div>
        </div>
     </div>
     @if(count($questions)>0)

     <div class="col-12" style="padding:50px 20px;background:#22CB88;" id="cauHoi">
         <div class="row">
             <div class="container text-center">
                 <h2 style="color:#fff;margin: auto;width: 589px;max-width: 80vw;">
                    Một số câu hỏi thường gặp khi
                    thiết kế web bán hàng</h2>

                    <div class="container" style="background:#fff;padding:30px;margin-top:70px;border-radius:7px; text-align:left">
                       <ul>
                           @foreach ($questions as $key => $question)
                            
                           <li id="hoi_{{@$question->id}}"><span>{{@$key + 1}}. {{@$question->questions}}</span>
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                               <div class="content">
                                {{@$question->reply}}
                               </div>
                           </li>
                              
                           @endforeach
                          

                       </ul>
                    </div>
             </div>
         </div>
     </div>
     @endif
     @if(count($blogCategories->where('parent_id',$categoryBlogs->id))>0)
     <div class="col-12 text-center" style="padding:50px 10px">
        <small style="color:#096F47">Bạn đang kinh doanh lỉnh vực nào?</small>
        <h2 style="color:#096F47;margin: auto;width: 589px;max-width: 88vw;font-weight:bold">
            Ctrl Media mang đến giải pháp dành riêng cho bạn    
        </h2>
        <div class="container">
         @if(!empty($blogCategories))
           <div class="row" style="margin-top:70px">
            @foreach ($blogCategories->where('parent_id',$categoryBlogs->id) as $blogCategorie)
                @if($blogCategorie->showHome == 'A')

                <div class="col-md-3 text-center childSerive">
                    <div class="img">
                        <a href="/{{@$blogCategorie->slug}}">
                            <img src="/storage/editor/blog/category/{{(@$blogCategorie->image)}}" alt="">
                        </a>
                    </div>
                    <a href="/{{@$blogCategorie->slug}}"><b>{{@$blogCategorie->title}}</b></a>
                </div>
                @endif

                @foreach ($blogCategories->where('parent_id',$blogCategorie->id) as $blogCategori)
                @if($blogCategori->showHome == 'A')

                <div class="col-md-3 text-center childSerive">
                    <div class="img">
                        <a href="/{{@$blogCategori->slug}}">
                            <img src="/storage/editor/blog/category/{{(@$blogCategori->image)}}" alt="">
                        </a>
                    </div>
                    <a href="/{{@$blogCategori->slug}}"><b>{{@$blogCategori->title}}</b></a>
                </div>
                @endif

            @endforeach

            @endforeach
           </div>
         @endif
        </div>
     </div>
     @endif
 </div>

@endsection
@section('script')
<script>
    $('#cauHoi li').on('click', function(){
        var id  = $(this).attr('id');
        id = id.split("_");
        id = id[1];
        if($('#hoi_'+id + ' .content').css('display') == 'none'){
            $('#cauHoi li .content').slideUp('200');
            $('#cauHoi li').css('border-width','1px');
            $('#cauHoi li span').css('font-weight','normal');
            $('#cauHoi li i:nth-child(3)').hide();
            $('#cauHoi li i:nth-child(2)').show();
            $('#hoi_'+id + ' .content').slideDown('200');
            $('#hoi_'+id).css('border-width','0');
            $('#hoi_'+id + ' span').css('font-weight','bold');
            $('#hoi_'+id + ' i:nth-child(2)').hide();
            $('#hoi_'+id + ' i:nth-child(3)').show();
        }
    })
    $('.fa-minus-circle').on('click', function(){
        $('#cauHoi li .content').slideUp('200');
        $('#cauHoi li').css('border-width','1px');
        $('#cauHoi li span').css('font-weight','normal');
        $('#cauHoi li i:nth-child(3)').hide();
        $('#cauHoi li i:nth-child(2)').show();
    })
</script>
@endsection
