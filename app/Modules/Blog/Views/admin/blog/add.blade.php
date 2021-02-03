@extends('admin.main')

@section('title')
{{ trans('Blog::blog.add.header_title') }}
@endsection
{{-- <script src="//cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script> --}}
<script type="text/javascript" src="{{asset('js/crud/ckeditor1/ckeditor.js')}}"></script>
@section('content')

<div class="container">
    <div class="col-12 pb-3 pt-5 rounded">
        <form method="post" class="form-horizontal" role="form" action="{{route('blog-add-post')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Mobile Toggle-->
                        <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
                            id="kt_subheader_mobile_toggle">
                            <span></span>
                        </button>
                        <!--end::Mobile Toggle-->
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a
                                    href="{{ route('blog-list') }}" class="text-dark text-hover-success"><i
                                        class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>{{ trans('Blog::blog.add.header_title') }}
                            </h5>
                            <!--end::Page Title-->
                            <!--begin::Breadcrumb-->

                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <!--begin::Button-->
                        <a href="{{ route('blog-list') }}"
                            class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-1x text-dark-50 flaticon2-back-1"></i>
                            {{ trans('Blog::blogcategory.add.header_btn_back') }}</a>
                        <!--end::Button-->

                        <!--begin::Dropdown-->
                        <div class="btn-group ml-2">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                {{ trans('Blog::blogcategory.add.header_btn_save') }}
                            </button>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->

                <!--end::Subheader-->

                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container container-cus">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content mt-0">
                                    <div class="tab-pane fade active show" id="tab-general" role="tabpanel"
                                        aria-labelledby="general-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <!--begin::List Widget 14-->
                                                <div class="card card-custom gutter-b">
                                                    <!--begin::Header-->
                                                    <div class="card-header border-0">
                                                        <h3 class="card-title font-weight-bolder text-dark">{{ trans('Blog::blog.add.form.header_general_info') }}</h3>
                                                        <div class="card-toolbar"></div>
                                                    </div>
                                                    <!--end::Header-->
                                                    <div class="separator separator-solid"></div>
                                                    <!--begin::Body-->
                                                    <div class="card-body pt-5">
                                                        {{-- <div class="col-lg-12">
                                                            <!--begin::Body-->
                                                            <div class="form-group row">
                                                                <label class="col-form-label">Tiêu đề <span
                                                                        class="label-text-error">*</span></label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="title" placeholder=""
                                                                    value="">
                                                                <span class="form-text text-error name-error">
                                                                    @if($errors->has('title'))
                                                                    <p class="text-danger"> {{$errors->first('title')}}</p>
                                                                    @endif</span>
                                                            </div>  
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label">Tên tiêu đề ngắn</label>
                                                                <input type="name" class="form-control" name="title_short" value="">
                                                                @if($errors->has('title_short'))
                                                                <p class="text-danger"> {{$errors->first('title_short')}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label">Slug</label>
                                                                <input type="name" class="form-control" name="slug" value="">
                                                                @if($errors->has('slug'))
                                                                <p class="text-danger"> {{$errors->first('slug')}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label" style="width: 100%">Mô tả
                                                                    <span class="label-text-error">*</span></label>
                                                                <textarea id="blog_description"  class="ckeditor" name="description" rows="3"></textarea>
                                                                @if($errors->has('description'))
                                                                    <p class="text-danger"> {{$errors->first('description')}}</p>
                                                                @endif
                                                            </div>
        
                                                            <div class="form-group row">
                                                                <label class="col-form-label" style="width: 100%">Nội dung bài viết 
                                                                    <span class="label-text-error">*</span></label>
                                                                    <textarea id="blog_content"  class="ckeditor" name="content" rows="3"></textarea>
                                                                    @if($errors->has('content'))
                                                                    <p class="text-danger"> {{$errors->first('content')}}</p>
                                                                    @endif
                                                            </div>
        
        
                                                            <div class="form-group row">
                                                                <label class="col-form-label">Trạng thái
                                                                    <span class="label-text-error">*</span>
                                                                </label>
                                                                <select class="form-control custom-select" name="status">
                                                                    <option disabled >---Chọn Trạng Thái---</option>
                                                                    <option value="D">Ẩn</option>
                                                                    <option value="A" selected="">Kích hoạt</option>
                                                                </select>
                                                                @if($errors->has('status'))
                                                                    <p class="text-danger"> {{$errors->first('status')}}</p>
                                                                @endif
                                                            </div>
                                                            <!--end::Body-->
                                                        </div> --}}
                                                        @include('Blog::admin.blog.form.general')
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::List Widget 14-->
                                            </div>
                                            <div class="col-lg-4">
                                                {{-- <div class="row">
                                                    <!--begin::Access-->
                                                    <!--end::Access-->
                                                    
                                                    <!--begin::Avatar-->
                                                    <div class="col-lg-12">
                                                        <!--begin::List Widget 10-->
                                                        <div class="card card-custom card-stretchs gutter-b">
                                                            <!--begin::Header-->
                                                            <div class="card-header border-0">
                                                                <h3 class="card-title font-weight-bolder text-dark">Ảnh đại diện
                                                                </h3>
                                                                <div class="card-toolbar">
        
                                                                </div>
                                                            </div>
                                                            <!--end::Header-->
                                                            <div class="separator separator-solid"></div>
                                                            <!--begin::Body-->
                                                            <div class="card-body pt-5">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="image-input image-input-outline"
                                                                            id="kt_image" style="width: 100%">
                                                                            <div class="image-input-wrapper min-h-265px"
                                                                                style="background-image: url({{ asset('storage/editor/thumbnail_placeholder.png') }}); width: 100%">
                                                                            </div>
                                                                            <label
                                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow"
                                                                                data-action="change" data-toggle="tooltip"
                                                                                title="" data-original-title="Đổi ảnh">
                                                                                <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                                                                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                                                            </label>
                                                                            <span
                                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip"
                                                                                title="" data-original-title="Huỷ ảnh">
                                                                                <i
                                                                                    class="icon-x text-dark-50 flaticon-delete-1"></i>
                                                                            </span>
                                                                        </div>
                                                                        <span class="form-text text-muted">Cho phép định dạng:
                                                                            png, jpg, jpeg.</span>
                                                                    </div>
                                                                    @if($errors->has('image'))
                                                                        <p class="text-danger"> {{$errors->first('image')}}</p>
                                                                    @endif
                                                                    <span class="form-text text-error avatar-error"></span>
                                                                </div>
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!-- begin::SEO -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <!--begin::List Widget 10-->
                                                            <div class="card card-custom card-stretchs gutter-b">
                                                                <!--begin::Header-->
                                                                <div class="card-header border-0">
                                                                    <h3 class="card-title font-weight-bolder text-dark">Tối ưu SEO</h3>
                                                                    <div class="card-toolbar">
                                                                        <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                                                                            id="accordion_seo">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <div class="card-title collapsed text-hover-primary"
                                                                                        data-toggle="collapse" data-target="#collapse_seo"
                                                                                        aria-expanded="false">
                                                                                        Thêm
                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Header-->
                                                                <div class="separator separator-solid"></div>
                                                                <!--begin::Body-->
                                                                <div class="card-body pt-5">
                                                                    <div>
                                                                        <span class="text-muted">Thêm thông tin SEO</span>
                                                                    </div>
                                                                    <div class="col-lg-12 collapse" id="collapse_seo"
                                                                        data-parent="#accordion_seo" style="">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label">Tiêu đề
                                                                                trang</label>
                                                                            <input class="form-control form-control-lg"
                                                                                type="text" name="seo_title" placeholder=""
                                                                                value="">
                                                                        </div>
                    
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label">Mô tả trang
                                                                            </label>
                                                                            <textarea class="form-control" rows="8"
                                                                                name="seo_description"></textarea>
                                                                        </div>
                    
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label">Đường dẫn</label>
                                                                            <textarea class="form-control" rows="2"
                                                                                name="seo_link"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Body-->
                                                            </div>
                                                        </div>
                                                    <!-- end::SEO -->
                                                    <!--begin::Category-->
                                                    <div class="col-lg-12">
                                                        <!--begin::List Widget 10-->
                                                        <div class="card card-custom card-stretchs gutter-b">
                                                            <!--begin::Header-->
                                                            <div class="card-header border-0">
                                                                <h3 class="card-title font-weight-bolder text-dark">Danh mục
                                                                    <span class="label-text-error">*</span></h3>
                                                                <div class="card-toolbar">
                                                                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                                                                        id="accordion_categories">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <div class="card-title collapsed text-hover-primary"
                                                                                    data-toggle="collapse"
                                                                                    data-target="#collapse_categories"
                                                                                    aria-expanded="false">
                                                                                    <a href="{{ route('blog-category-add') }}">Thêm &nbsp;&nbsp;&nbsp;&nbsp;</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Header-->
                                                            <div class="separator separator-solid"></div>
                                                            <!--begin::Body-->
                                                            <div class="card-body pt-5">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group row">
                                                                        <select class="form-control custom-select" name="blog_category_id">
                                                                            <option selected="" disabled >---Chọn Danh Mục---</option>
                                                                            @foreach($categories as $cate)
                                                                            <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                                                                            @endforeach
                                                                            
                                                                        </select>
                                                                        @if($errors->has('blog_category_id'))
                                                                        <p class="text-danger"> {{$errors->first('blog_category_id')}}</p>
                                                                        @endif
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                    </div>
                                                    <!--end::Category-->
                                                </div> --}}
                                                @include('Blog::admin.blog.form.seo')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/branch.js?v=1.0.0"></script>
<script src="js/pages/location.js?v=1.0.0"></script>


@endsection
