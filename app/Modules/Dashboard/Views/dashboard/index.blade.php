@extends('admin.main')


@section('title')
{{ trans('Dashboard::dashboard.header') }}
@endsection

@section('styles')
<link href="admin/assets/css/pages/wizard/wizard-4.css?v=7.0.5" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!--begin::Subheader-->
<input type="hidden" id="message_loading" value="" />
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-50 flaticon-statistics"></i><a class="text-dark text-hover-success" href="{{ route('Dashboard') }}"> {{ trans('Dashboard::dashboard.header') }}</a></h5>
            <!--end::Page Title-->
            {{--<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">11 Tổng</span>
            </div>--}}
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            <div>
                <div class='input-group' id='filter_daterangepicker' style="min-width: 260px">
                    <input type='text' class="form-control form-control" readonly="readonly" placeholder="{{ trans('Dashboard::dashboard.filter.choose') }}"/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="icon-2x text-dark-50 flaticon-calendar-with-a-clock-time-tools"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!--end::Dropdowns-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <!--begin::Dashboard-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom card-transparent">
                    <div class="card-body p-0">
                        <!--begin: Wizard-->
                        <div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-clickable="true">
                            <!--begin: Wizard Nav-->
                            <div class="wizard-nav">
                                <div class="wizard-steps">
                                    @include('Dashboard::dashboard.wizard_step')
                                </div>
                            </div>
                            <!--end: Wizard Nav-->
                            <!--begin: Wizard Body-->
                            <div class="card card-custom card-shadowless rounded-top-0">
                                <div class="card-body p-0">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <!--begin: Wizard Step 1-->
                                            <div class="p-8 wizard-step-1" data-wizard-type="step-content">

                                            </div>
                                            <!--end: Wizard Step 1-->

                                            <!--begin: Wizard Step 2-->
                                            <div class="p-8 wizard-step-2" data-wizard-type="step-content">

                                            </div>
                                            <!--end: Wizard Step 2-->

                                            <!--begin: Wizard Step 3-->
                                            <div class="p-8 wizard-step-3" data-wizard-type="step-content">

                                            </div>
                                            <!--end: Wizard Step 3-->

                                            <!--begin: Wizard Step 4-->
                                            <div class="p-8 wizard-step-4" data-wizard-type="step-content">
                                                <h6 class="text-primary">{{ trans('Dashboard::dashboard.select_note') }}</h6>
                                            </div>
                                            <!--end: Wizard Step 4-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Wizard Bpdy-->
                        </div>
                        <!--end: Wizard-->
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card card-custom gutter-b mt-8">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">{{ trans('custom.recent_notification') }}</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-body pt-6">
                        <div class="timeline timeline-3">
                            <div class="timeline-items" id="timeline_logs">
                                @include('Dashboard::dashboard.log')
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    @if(count($logs) > 0)
                    <div class="card-body pt-6">
                        <div class="text-center">
                            <button type="button" class="btn btn-success text-white mr-3 btn_load_mores" rel="1">
                                {{ trans('Dashboard::dashboard.log.load_more') }} :
                                <span class="text-white">1 - 10 / {{ $logs->total() }}</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <!--end::Dashboard-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

@section('scripts')
<script src="js/pages/wizard.js"></script>
@endsection
