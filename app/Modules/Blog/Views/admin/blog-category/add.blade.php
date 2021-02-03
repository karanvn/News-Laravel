@extends('admin.main')

@section('title')
{{ trans('Blog::blogcategory.add.header_title') }}
@endsection
{{-- <script src="//cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script> --}}
<script type="text/javascript" src="{{asset('js/crud/ckeditor1/ckeditor.js')}}"></script>
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <form method="post" class="form-horizontal" role="form" action="{{route('blog-category-add-post')}}" enctype="multipart/form-data">
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
                                    href="{{ route('blog-category-list') }}" class="text-dark text-hover-success"><i
                                        class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>{{ trans('Blog::blogcategory.add.header_title') }}
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
                        <a href="{{ route('blog-category-list') }}"
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
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container container-cus">
                <!--begin::Card-->
                <div class="d-flex flex-row">
                    <div class="flex-row-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-lg-7">
                                <!--begin::List Widget 14-->
                                <div class="card card-custom gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0">
                                        <h3 class="card-title font-weight-bolder text-dark">
                                            {{trans('Blog::blogcategory.add.header_title') }}</h3>
                                        <div class="card-toolbar">

                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <div class="separator separator-solid"></div>
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        @include('Blog::admin.blog-category.form.general')
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List Widget 14-->
                            </div>
                            
                            <div class="col-lg-5">
                                @include('Blog::admin.blog-category.form.seo')
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </form>
</div>

@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/branch.js?v=1.0.0"></script>
<script src="js/pages/location.js?v=1.0.0"></script>


@endsection