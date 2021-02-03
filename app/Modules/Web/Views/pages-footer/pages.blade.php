@extends('home.main')
@section('title')
{{ @$footerPage->title_short }}
@endsection
@section('content')
<br><br><br><br><br><br>
<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside"">
    <div class="wrapper container">
        <div class="mod-content row">
            <div class="lynessa-listitem style-01 col-md-3 col-xs-12 col-sm-4">
                
                @foreach(@$categoryLefts as $categoryLeft)
                <div class="listitem-inner">
                    <div class="title">
                        <h4>{{ @$categoryLeft->title_short }}</h4>
                    </div>
                    <div class="mc-content">
                        <ul class="listitem-list">
                            @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','top') as $catePages)                          
                            <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                    title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                            @endforeach
                            @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','<>','top')->where('position_show','<>','bottom') as $catePages)                          
                            <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                    title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                            @endforeach
                            @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','bottom') as $catePages)                          
                            <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                    title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                <!--End menu cat-->
            </div>
            <!--end md3-->
            <div class="col-md-9 col-xs-12 col-sm-8">
                <!--===BEGIN: BOX MAIN===-->
                <div class="box_mid">
                    <div class="mid-title">
                        <div class="titleR"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="mid-content">
                        <div class="desc-onenews">
                            {!! @$footerPage->content !!}
                        </div>
                    </div>
                    <!--===END: BOX MAIN===-->
                </div>
                <div class="clear"></div>
            </div>
            <!--end md9-->

        </div>
    </div>
    <!--=== END: CONTENT ===-->
<script src="{{asset('js/newpage/product/category.js')}}"></script>
@endsection