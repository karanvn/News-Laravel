@extends('admin.main')

@section('title')
{{ trans('Mail::mail.block.add.header_title') }}
@endsection

@section('styles')

@endsection


@section('content')
<!--begin::Subheader-->
<form id="frmAddMailBlock" name="frmAddMailBlock" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('Block') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ trans('Mail::mail.block.add.header_title') }}</h5>
                <!--end::Title-->
                <!--begin::Separator-->

                <!--end::Separator-->
                <!--begin::Search Form-->

                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="{{ route('Block') }}" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i class="icon-1x text-dark-50 flaticon2-back-1"></i> {{ trans('Mail::mail.block.add.header_btn_back') }}</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i>{{ trans('Mail::mail.block.add.header_btn_save') }}</button>
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
            <div class="d-flex flex-row">
                <div class="flex-row-fluid">
                    <div class="row">
                        <div class="col-lg-6">
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
                                        <!--begin::Form-->
                                        @include('Mail::block.form')
                                        <!--end::Form-->
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 14-->
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--begin::List Widget 10-->
                                    <div class="card card-custom card-stretchs gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header border-0">
                                            <h3 class="card-title font-weight-bolder text-dark">Xem trước</h3>
                                        </div>
                                        <!--end::Header-->
                                        <div class="separator separator-solid"></div>
                                        <!--begin::Body-->
                                        <div class="card-bodys pb-6 pt-6">
                                            {!! @$block->html !!}
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</form>
@endsection

@section('scripts')
<script src="js/crud/ckeditor/ckeditor.js"></script>
<script src="js/pages/mail.js"></script>
@endsection
