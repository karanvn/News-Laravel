@extends('admin.main')

@section('title')
{{ @$banner ? trans('Banner::banner.edit.header_title') : trans('Banner::banner.add.header_title') }}
@endsection

@section('styles')

@endsection


@section('content')
<!--begin::Subheader-->
<form id="frmAddBanner" name="frmAddBanner" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a href="{{ route('Banner') }}" class="text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ @$banner ? trans('Banner::banner.edit.header_title') : trans('Banner::banner.add.header_title') }}</h5>
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
                <a href="{{ route('Banner') }}" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i class="icon-1x text-dark-50 flaticon2-back-1"></i> {{ trans('Banner::banner.add.header_btn_back') }}</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> {{ trans('Banner::banner.add.header_btn_save') }}</button>
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
            <div class="card card-custom card-stretch">
                <!--begin::Form-->
                <div class="card-body">
                @include('Banner::banner.form')
                <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</form>
@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/banner.js?v=1.0.0"></script>
@endsection
