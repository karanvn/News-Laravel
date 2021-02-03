@extends('admin.main')

@section('title')
{{ @$tpl ? trans('Mail::mail.tpl.edit.header_title') : trans('Mail::mail.tpl.add.header_title') }}
@endsection

@section('styles')
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Subheader-->
<form id="frmAddMailTpl" name="frmAddMailTpl" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('Tpl') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ @$tpl ? trans('Mail::mail.tpl.edit.header_title') : trans('Mail::mail.tpl.add.header_title') }}</h5>
                <!--end::Title-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="{{ route('Tpl') }}" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> {{ trans('Mail::mail.tpl.add.header_btn_back') }}</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
                @if($auth->can('add admins'))
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> {{ trans('Mail::mail.tpl.add.header_btn_save') }}</button>
                </div>
                @endif
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
                        <div class="col-lg-5">
                            <!--begin::List Widget 14-->
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">{{ trans('Mail::mail.tpl.add.form.header_general_info') }}</h3>
                                    <div class="card-toolbar">

                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <input type="hidden" name="tpl_id" value="{{ @$tpl->tpl_id }}" />
                                        @include('Mail::tpl.form')
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 14-->
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--begin::List Widget 10-->
                                    <div class="card card-custom card-stretchs gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header border-0">
                                            <h3 class="card-title font-weight-bolder text-dark">{{ trans('Mail::mail.tpl.add.form.header_parterm') }}</h3>
                                            <div class="card-toolbar">
                                                <select class="form-control custom-select" id="tpl_select_block">
                                                    <option value="0" >---Chọn block---</option>
                                                    @foreach($blocks as $block)
                                                    <option value="{{ $block->block_id }}" >{{ $block->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <div class="separator separator-solid"></div>
                                        <!--begin::Body-->
                                        <div class="card-body pt-5">
                                            @include('Mail::tpl.patterm')
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                            </div>
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
@endsection

@section('scripts')
<script src="https://oms.hotdeal.vn/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="js/pages/mail.js"></script>
@endsection
