@extends('admin.main')

@section('title')
{{ trans('Rule::rule.edit.header_title') }}
@endsection

@section('styles')

@endsection


@section('content')
<!--begin::Subheader-->
<form id="frmAddRule" name="frmAddRule" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('Rule') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ trans('Rule::rule.edit.header_title') }}</h5>
                <!--end::Title-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="{{ route('Rule') }}" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base text-hover-success"><i class="icon-1x text-dark-50 flaticon2-back-1"></i> {{ trans('Rule::rule.add.header_btn_back') }}</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> {{ trans('Rule::rule.add.header_btn_save') }}</button>
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
                @include('Rule::rule.form')
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
<script src="js/pages/rule.js"></script>
@endsection
