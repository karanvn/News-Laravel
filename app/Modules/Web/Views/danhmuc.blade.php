@extends('home.main')
@section('title')
@if(!empty($category))
{{!empty($category->seo_name) ? $category->seo_name : $category->name}}
@else
DANH MỤC
@endif
@endsection
@section('head')
    <style>
        .btnboloc{
            border: 1px solid #e4e4e4!important;
            padding: 12px!important;
        }
        .orderby{
            border-radius: 3px;
        }
        .icon-orderby{
            position: absolute; 
            top: 0%; 
            right: 15px; 
            color: #9d8888;
        }
        .carousel-inner .carousel-item img{
            width:100%;
            height:450px;
            object-fit: cover;
        }
        .den{
            position: absolute;
            width: 100%;
            bottom: 0;
            left: 0;
            height: 110px;
            background-image: linear-gradient(to top, white, transparent);
        }
        .see_more{
            padding: 10px 26px !important; 
            margin-top: 20px; 
            border-radius: inherit !important; 
            font-size: 12px !important; 
            width: fit-content; 
            font-family: Tinos,serif;
        }
        .post_list{
            margin-right: 30px; 
            width: 360px; 
            /* border: 1px solid #eadfdf;  */
            border-radius: 5px 5px 0 0; 
            padding: 14px;
        }
        /* .post-thumb{
            border-bottom: 1px solid #eadfdf
        } */
        .post-thumb img{
            width: 100%;
        }
        .seeMoreList{
            font-family: Tinos,serif;
        }
    </style>
    @php echo '<script type="application/ld+json">'; @endphp
        {!! @$schemaCategory !!} 
    @php echo '</script>';  @endphp
@endsection
@php
    $policies = @$generals['POLICY'];
@endphp
{{--meta--}}
@if(!empty($category))
    @section('meta')
    <meta name="description" content="{{@$category->seo_description}}"/>
    <meta name="keywords" content="{{@$category->seo_keywords}}"/>
    <meta name="DC.title" lang="vi" content="{{!empty($category->seo_name) ? $category->seo_name : $category->name}}">
    <meta name="DC.creator" content="Thiết kế web chuyên nghiệp - CTRL MEDIA">
    <meta name="DCTERMS.abstract" content="{{@$category->seo_description}}">
    <meta property="og:title" content="{{!empty($category->seo_name) ? $category->seo_name : $category->name}}">
    <meta property="og:description" content="{{@$category->seo_description}}">
    @php $bannercategory = $category->banners; @endphp
    @if(empty($bannercategory))
        @if(!empty($products))
            @php $image_ogproduct = asset('storage/editor/thumbs').'/'.@$products->first()->product_id.'/'.     @$products->first()->images[0]->image_path;
            @endphp
            <meta property="og:image" content="{{asset(@$image_ogproduct)}}">
        @endif
    @else
        @if($category->banners->count()>0)
            @php $imageCategoryMeta = $category->banners->first()->avatar; @endphp
            <meta property="og:image" content="{{asset(config('banner.image.org_path') . $imageCategoryMeta )}}">
        @else
            @if(count($products)>0)
                @php
                    $image_ogproduct = asset('storage/editor/thumbs').'/'.@$products->first()->product_id.'/'.@$products->first()->images[0]->image_path;
                @endphp
                <meta property="og:image" content="{{asset(@$image_ogproduct)}}">
            @endif
        @endif
    @endif
    @endsection
@endif
{{-- end:meta --}}
@section('content')
{{-- check filter --}}
@php  
    $colorurl   = @$color;
    $color      = explode(",", @$color);
    $sizeurl    = @$size; 
    $size       = explode(",", @$size); 
    $patternurl = @$pattern;
    $pattern    = explode(",", @$pattern);
@endphp
{{-- end check filter --}}

{{-- slide --}}
@if(!empty($slideCategorys)&&(count($slideCategorys)>0))
<div id="slideCarousel" class="carousel slide slideInCategory" data-ride="carousel">
    <!-- The slideshow -->
    <div class="carousel-inner">
        @php $j = 1; @endphp
        @foreach($slideCategorys as $slideCategory)
            @if(!empty($slideCategory->avatar))
                @if($j==1)
                <div class="carousel-item active">
                    <img src="{{get_image_banner_webp(@$slideCategory->avatar)}}" alt="{{@$slideCategory->name}}">
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
                    <img data-src="{{get_image_banner_webp(@$slideCategory->avatar)}}" alt="{{@$slideCategory->name}}" class="lazyload">
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
    <a class="carousel-control-prev" href="#slideCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#slideCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
  </div>

  <div class="banner-wrapper my-1 py-3">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{$category!='' ? $category->name : 'DANH MỤC'}}</h1>
        <div class="categoryOne">
            @if(!empty($category))
                <div>
                    <li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => @$category->parent->slug, 'alias2' => @$category->slug.'.html'])}}"><span>{{@$category->name}}</span></a></li>
                </div>
                @php	@$Breadcrumbs = $category;	@endphp
                @if(!empty($Breadcrumbs->parent_id))
                    @php	@$Breadcrumbs = $Breadcrumbs->parent; @endphp
                    <div><li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => $Breadcrumbs->slug.'.html'])}}"><span>{{@$Breadcrumbs->name}}</span></a></li>
                    </div>
                    @if(!empty($Breadcrumbs->parent_id))
                        @php @$Breadcrumbs = $Breadcrumbs->parent;	@endphp
                        <div><li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => $Breadcrumbs->slug.'.html'])}}"><span>{{@$Breadcrumbs->name}}</span></a></li></div>
                    @endif
                @endif
                <div><li class="trail-item"><a href="/"><span>Home</span></a></li></div>
            @endif
        </div>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb"></ul>
        </div>
    </div>
</div>
@else
<div class="banner-wrapper">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{$category!='' ? $category->name : 'DANH MỤC'}}</h1>
        <div class="categoryOne">
            @if(!empty($category))
                <div>
                    <li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => @$category->parent->slug, 'alias2' => @$category->slug.'.html'])}}"><span>{{@$category->name}}</span></a></li>
                </div>
                @php	@$Breadcrumbs = $category;	@endphp
                @if(!empty($Breadcrumbs->parent_id))
                    @php	@$Breadcrumbs = $Breadcrumbs->parent;	@endphp
                    <div><li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => $Breadcrumbs->slug.'.html'])}}"><span>{{@$Breadcrumbs->name}}</span></a></li>
                    </div>
                    @if(!empty($Breadcrumbs->parent_id))
                        @php	@$Breadcrumbs = $Breadcrumbs->parent;	@endphp
                        <div><li class="trail-item"><a href="{{route('optimize_slug', ['alias1' => $Breadcrumbs->slug.'.html'])}}"><span>{{@$Breadcrumbs->name}}</span></a></li></div>
                    @endif
                @endif
                <div><li class="trail-item"><a href="/"><span>Home</span></a></li></div>
            @endif
        </div>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb"></ul>
        </div>
    </div>
</div>
@endif
{{-- end:slide --}}
<!-- start of product-detail -->
<div class="row container mx-auto mt-5">
    @if(count($products)>0)
    <div class="col-12">
        <div class="row">
            <div class="col-md-2 col-6 btnboloc px-3 mb-3 btn text-left"><i class="fa fa-filter mr-2" aria-hidden="true"></i>Bộ lọc</div>
            <div class="col-md-7 col-4 d-md-block d-none"></div>
            <div class="col-md-3 col-6 px-0 py-0 mb-2 text-right  d-md-block d-none">
                <form class="lynessa-ordering d-inline" id="filter_sort" method="get" enctype="multipart/form-data">
                    <select title="product_cat" name="orderBy" class="orderby">
                       <option value="" selected="selected">Mới nhất</option>
                       <option value="slug-asc">Từ A-Z</option>
                       <option value="slug-desc">Từ Z-A</option>
                       <option value="org_price-asc">Giá từ thấp đến cao</option>
                       <option value="org_price-desc">Giá từ cao đến thấp</option>
                    </select>
                  
                    <i class="fa fa-caret-down icon-orderby" aria-hidden="true"></i>
                </form>
            </div>

            <div class="col-md-3 col-6 px-0 py-0 mb-2 text-right  d-md-none d-block">
                <form class="lynessa-ordering d-inline" id="filter_sort" method="get" enctype="multipart/form-data">
                    <select title="product_cat" name="orderBy" class="orderby">
                       <option value="" selected="selected">Sắp xếp</option>
                       <option value="slug-asc">Từ A-Z</option>
                       <option value="slug-desc">Từ Z-A</option>
                       <option value="org_price-asc">Giá từ thấp đến cao</option>
                       <option value="org_price-desc">Giá từ cao đến thấp</option>
                    </select>
                  
                    <i class="fa fa-caret-down icon-orderby" aria-hidden="true"></i>
                </form>
            </div>

        </div>
    </div>
    <!-- begin: filter -->
    <form id="frmSeachproduct" name="frmAddProduct" method="get" class="form-horizontal col-12 px-0 mx-0" role="form" enctype="multipart/form-data">
        <div class="col-12 boloc bg-light mb-2">
            <div class="buttonX btnboloc d-md-none d-block">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <input type="hidden" name="status" value="A">
            <input type="hidden" name="name" id="name" value="{{@$name}}">
            <input type="hidden" name="page" id="page" value="1">
            <input type="hidden" name="limit" id="limit" value="{{$limit}}">
            <input type="hidden" name="order" value="" id="order">
            @if(!empty(@$categoryarr_ids))
                @foreach(@$categoryarr_ids as $category_id)
                    <input type="hidden" name="categoryarr_ids[]" value="{{$category_id}}">
                @endforeach
            @endif

            @csrf
            <div class="row">
                @if(count($features)>0)
                <div class="d-none">
                    <ul>
                        @php $cha = 0; @endphp
                        @foreach($features as $feature)
                            @if($cha != $feature->parent_id)
                            @php $cha = $feature->parent_id; @endphp
                            @if($cha == 1)
                    </ul>
                </div>
                <div class="col-md-3 col-12">
                    <ul class="filter filtercolor row pb-3 d-md-none d-block">
                        <li class="col-12 py-3 text-uppercase"><b>Bộ lọc</b></li>
                    </ul>
                    <ul class="filter filtercolor row pb-3">
                        <li class="col-12 py-3 text-uppercase">{{$feature->parent()->first()->name}} <i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                        @if(!in_array(@$feature->slug, $color))
                        <li class="col-2" title="{{@$feature->name}}"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none colorInput" id="feature_{{$feature->id}}" data="{{@$feature->slug}}">
                            <div class="formcolor clickform " style="background:{{@$feature->option}}" id="value_{{$feature->id}}">
                            </div>
                        </li>
                        @else
                        <li class="col-2" title="{{@$feature->name}}"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none colorInput" id="feature_{{$feature->id}}" data="{{@$feature->slug}}" checked>
                            <div class="formcolor clickform active" style="background:{{@$feature->option}}" id="value_{{$feature->id}}">
                            </div>
                        </li>
                        @endif
                        @endif
                        @if(@$cha==2)
                    </ul>
                </div>
                <div class="col-md-3 col-12">
                    <ul class="filter filtertype row pb-3">
                        <li class="col-12 py-3 text-uppercase">{{@$feature->parent()->first()->name}}<i class="fa fa-chevron-right" aria-hidden="true"></i> </li>
                        @if(!in_array(@$feature->slug, $size))
                        <li class="col-4"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none sizeInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}">
                            @if(!empty(@$feature->option))
                                <div class="formtype clickform" id="value_{{$feature->id}}">{{@$feature->option}}</div>
                            @else
                                <span class="clickform" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                            @endif
                        </li>
                        @else
                        <li class="col-4"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none sizeInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}" checked>
                            @if(!empty(@$feature->option))
                                <div class="formtype clickform active" id="value_{{$feature->id}}">{{@$feature->option}}</div>
                            @else
                                <span class="clickform" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                            @endif
                        </li>
                        @endif
                        @endif
                        @if((@$cha!=2)&&(@$cha!=1))
                    </ul>
                </div>
                <div class="col-md-3 col-12">
                    <ul class="filter filterOrter row pb-3">
                        <li class="col-12 py-3 text-uppercase">{{@$feature->parent()->first()->name}}<i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                        <li class="col-12">
                            @if(!in_array(@$feature->slug, $pattern))
                            <input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform formHoaTiet" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}">
                                <span class="" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                            @else
                            <input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform formHoaTiet" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}" checked>
                            <span id="value_{{$feature->id}}">{{@$feature->name}}</span>
                            @endif
                        </li>
                        @endif
                        @else
                            @if($cha == 1)
                            @if(!in_array(@$feature->slug, $color))
                                <li class="col-2" title="{{@$feature->name}}"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none colorInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}">
                                    <div class="formcolor clickform" style="background:{{@$feature->option}}" id="value_{{$feature->id}}">
                                    </div>
                                </li>
                                @else
                                <li class="col-2" title="{{@$feature->name}}"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none colorInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}" checked>
                                    <div class="formcolor clickform active" style="background:{{@$feature->option}}" id="value_{{$feature->id}}">
                                    </div>
                                </li>
                                @endif
                            @endif
                            @if(@$cha==2)
                            @if(!in_array(@$feature->slug, $size))
                                <li class="col-4"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none sizeInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}">
                                    @if(!empty(@$feature->option))
                                        <div class="formtype clickform" id="value_{{$feature->id}}">{{@$feature->option}}</div>
                                    @else
                                        <span class="clickform" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                                    @endif
                                </li>
                                @else
                                <li class="col-4"><input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform d-none sizeInput" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}" checked>
                                    @if(!empty(@$feature->option))
                                        <div class="formtype clickform active" id="value_{{$feature->id}}">{{@$feature->option}}</div>
                                    @else
                                        <span class="clickform" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                                    @endif
                                </li>
                                @endif
                            @endif
                            @if((@$cha!=2) && (@$cha!=1))
                            <li class="col-12">
                                @if(!in_array(@$feature->slug, $pattern))
                                <input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform formHoaTiet" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}">
                                    <span class="" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                                @else
                                <input type="checkbox" value="{{$feature->id}}" name="id_FeaturesInParent[]" class="mr-2 optionform formHoaTiet" id="feature_{{$feature->id}}"  data="{{@$feature->slug}}" checked>
                                <span class="" id="value_{{$feature->id}}">{{@$feature->name}}</span>
                                @endif
                            </li>
                            @endif
                        @endif
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="col-md-3 col-12">
                    <ul class="filter pb-3 row">
                        <li class="py-3 col-12 text-uppercase">Giá trị<i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                        @if(empty($price))
                        <input type="radio" value="0-1000000000000000000" class="d-none" checked name="price">
                        @else
                        <input type="radio" value="0-1000000000000000000" class="d-none" name="price">
                        @endif
                        <li class="col-12"><input type="radio" value="0-200000" name="price" class="mr-2 optionform optionPrice" data="0-200000"  @if(@$price == '0-200000') checked @endif>0-200.000 VND</li>
                        <li  class="col-12"><input type="radio" value="200000-400000" name="price" class="mr-2 optionform optionPrice" data="200000-400000"  @if(@$price == '200000-400000') checked @endif>200.000->400.000VND</li>
                        <li class="col-12"><input type="radio" value="400000-800000" name="price" class="mr-2 optionform optionPrice" data="400000-800000"  @if(@$price == '400000-800000') checked @endif>400.000->800.000VND</li>
                        <li class="col-12"><input type="radio" value="800000-10000000000" name="price" class="mr-2 optionform optionPrice" data="800000-10000000000"  @if(@$price == '800000-10000000000') checked @endif> Từ 800.000VND</li>
                    </ul>
                </div>
            </div>
        </div>
        <button type="submit" id="submit" name="submit" class="btn btn-success d-none font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i>Tìm kiếm</button>
    </form>
    @endif
    <div class="container pt-1 pb-3 px-0">
        @if(!empty($ArrColor))
            <div class="searchfilter border">
                Màu sắc: <b>
                @php $j = 0; @endphp
                @foreach($ArrColor as $value)
                    @if($j==0)
                        {{$value->name}}
                    @else
                        , {{$value->name}}
                    @endif
                    @php $j++; @endphp
                @endforeach
                </b>
                <i class="fa fa-times x-filter" aria-hidden="true" id="color"></i>
            </div>
        @endif
        {{-- size --}}
        @if(!empty($ArrSize))
           <div class="searchfilter border">
               Kích thước: <b>
               @php $j = 0; @endphp
               @foreach($ArrSize as $value)
               @if($j==0)
               {{$value->name}}
               @else
                  , {{$value->name}}
               @endif
               @php $j++; @endphp
               @endforeach
               </b>
               <i class="fa fa-times x-filter" aria-hidden="true" id="size"></i>
           </div>
        @endif
        {{-- cai khac --}}
        @if(!empty($ArrPattern))
            <div class="searchfilter border">
                Họa tiết: <b>
                @php $j = 0; @endphp
                @foreach($ArrPattern as $value)
                    @if($j==0)
                        {{$value->name}}
                    @else
                        , {{$value->name}}
                    @endif
                    @php $j++; @endphp
                @endforeach
                </b>
                <i class="fa fa-times x-filter" aria-hidden="true" id="pattern"></i>
            </div>
        @endif
        @if(!empty($price))
        @php
            $pricefilter = explode('-', $price);
        @endphp
        <div class="searchfilter border"> {{ Number_format(@$pricefilter[0])}}₫ - {{ Number_format(@$pricefilter[1])}}₫ <i class="fa fa-times x-filter" aria-hidden="true" id="price"></i></div>
        @endif

    </div>
    <!-- end: filter -->
    <div class="col-12 px-0">
        <div class="row " id="listitem">
            @if(count($products)>0)
            <div class="col-12 text-center">
            <img src="/system/images/load.gif" alt="Load icon" width="80px">
            </div>
            @endif
        </div>
    </div>
    <p class="text-center col-12 mt-3">
        <svg class="arrows">
            <path class="a1" d="M0 0 L30 32 L60 0"></path>
            <path class="a2" d="M0 20 L30 52 L60 20"></path>
            <path class="a3" d="M0 40 L30 72 L60 40"></path>
        </svg>
        <div class="btn-cont">
            <a class="btn" id="seeMoreList">
                Xem nhiều hơn
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
                <span class="line-4"></span>
            </a>
        </div>
    </p>
</div>
@if (!empty($policies))
<div class="section-014 py-md-5 py-0 policyShop">
    <div class="container px-0">
        <div class="row">
            @for ($i = 0; $i <= 3; $i++)               
            <div class="col-6 col-lg-3 py-md-0 py-3 border-md-0 border-1">
                <div class="lynessa-iconbox style-02">
                    <div class="iconbox-inner">
                        <div class="icon">
                            <span class="{{$policies['icon'][$i]}}"></span>
                        </div>
                        <div class="content">
                            <h4 class="title">{!! $policies['name'][$i] !!}</h4>
                            <div class="desc">{!! $policies['desc'][$i] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endif

<div class="container">
    @if(!empty($category->description))
    <div class="row">
        <div class="description">{!! @$category->description !!}
            <div class="den"></div>
        </div>
        <div class="description_hidden">{!! @$category->description !!}</div>
        <div class="btn-cont">
            <a class="btn see_more">
                <span>Xem tiếp</span>
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
                <span class="line-4"></span>
            </a>
        </div>
    </div>
    @endif
    <div class="row mt-3">
        <ul class="list_tag mx-auto">
            {{-- cateogry --}}
            @foreach ($list_category as $item)
                <li class="tag readmore"><a href="{{route('optimize_slug', ['alias1' => $item->slug.'.html'])}}">{{$item->name}}</a></li>
            @endforeach
            {{-- shop --}}
            @if(empty($category))
            @foreach ( @$menuProducts->where('parent_id','0') as $item)
                <li class="tag readmore"><a href="{{route('optimize_slug', ['alias1' => $item->slug.'.html'])}}">{{$item->name}}</a></li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
{{-- begin: blog in category --}}
@if(!empty($category))
@php $blogs = $category->blog()->get(); @endphp
    @if(count($blogs)>0)
        <div class="lynessa-heading style-01 mt-4">
            <div class="heading-inner">
                <h3 class="title">
                    {{trans('Web::home.category.blog.title')}} <span></span>
                </h3>
                <div class="subtitle">
                    {{trans('Web::home.category.blog.description')}}
                </div>
            </div>
        </div>

        <div class="lynessa-blog style-01 container blog_news">
            <div class="carousel">
                @foreach ($blogs as $blog)
                @php
                    $slug1 = @$blog->category->parent->slug;
                    $slug2 = @$blog->category->slug;
                    $slug3 = @$blog->slug;
                @endphp
                <div class="wrapper col-12 pb-5 post_list">
                    <div class="post-thumb">
                        <a href="{{ route('optimize_slug', ['alias1'=> $slug1, 'alias2' => $slug2, 'alias3' => $slug3]) }}">
                            <img src="{{ asset('storage/editor/blog/'.@$blog->image) }}" alt="img-blog-detail" width="300" height="300"> 
                        </a>
                    </div>
                    <div class="post-content">
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
                            <h4 class="post-title">
                                <a href="{{ route('optimize_slug', ['alias1'=> $slug1, 'alias2' => $slug2, 'alias3' => $slug3]) }}">{{@$blog->title_short }}.</a>
                            </h4>
                            {!! split_description_blog($blog->description, 0, 20) !!}......
                        </div>
                    </div>
                    <div class="text"></div>
                </div>
                @endforeach
            </div>
        </div>

    @endif
@endif
{{-- end: blog in category --}}
<input type="hidden" id="textUrlFeature" value=",{{@$colorurl}}">
<input type="hidden" id="textUrlType" value=",{{@$sizeurl}}">
<input type="hidden" id="textUrlHoaTiet" value=",{{@$patternurl}}">
<input type="hidden" id="textUrlPrice" value="{{@$price}}">
<script src="{{asset('js/newpage/product/category.js')}}"></script>
<script src="{{asset('js/newpage/raiting.js')}}"></script>

<script>
    $(document).ready(function () {
        $(".blog_news .carousel").slick({ slidesToShow: 3, dots: !0, autoplay: !0, centerMode: !1, prevArrow: $(".prev"), nextArrow: $(".next"), responsive: [{ breakpoint: 768, settings: { slidesToShow: 1, slidesToScroll: 1 } }] })
    });

    $('.boloc .filter').on('click', function(){
     if($(window).width()<768){
        if($(this).css('max-height')=='40px'){
            $(this).css('max-height','60vh');
        }else{
            $(this).css('max-height','40px');
        }
     }
 })

</script>

@endsection