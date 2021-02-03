@extends('admin.main')

@section('title')
{{ trans('Location::ward.edit.header_title') }}
@endsection

@section('styles')
<link href="{{ 'admin/assets/css/pages/wizard/wizard-4.css?v=7.0.5' }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<!--begin::Subheader-->
<form id="frmAddWard" name="frmAddWard" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('Ward') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ trans('Location::ward.edit.header_title') }}</h5>
                <!--end::Title-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="{{ route('Ward') }}" class="btn btn-default text-dark text-hover-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-1x text-dark-50 flaticon2-back-1"></i> {{ trans('Location::ward.add.header_btn_back') }}</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> {{ trans('Location::ward.add.header_btn_save') }}</button>
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
                @php
                    $district_id = !empty($ward->district_id) ? $ward->district_id : 0;
                    $district = $ward->district()->get()->first();
                    $state_id = $district ? $district->state_id : 0;
                @endphp
                @include('Location::ward.form')
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</form>
@endsection

@section('scripts')
<script src="js/pages/location.js?v=1.0.0"></script>
@endsection
