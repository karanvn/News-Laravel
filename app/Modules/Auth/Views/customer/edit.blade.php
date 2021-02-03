@extends('admin.main')

@section('title')
{{ trans('Auth::customer.edit.header_title') }}
@endsection

@section('styles')

@endsection


@section('content')
<!--begin::Subheader-->
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
                <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a href="{{ route('Customer') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a> {{ trans('Auth::customer.edit.header_title') }}</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->

                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Dropdown-->

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
        <!--begin::Profile Overview-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('Auth::customer.profile')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                @include('Auth::customer.page.' . $page)
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Overview-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@section('modal')
<!--begin::Modal-->
<div class="modal fade" id="modalAddShipping" role="dialog" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true" >
    <form id="frmAddCustomerShipping" name="frmAddCustomerShipping" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
        <input type="hidden" name="user_id" value="{{ @$user->id }}" />
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('Auth::customer.add.form.shipping.header_action') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" style="width: 100%">

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success mr-2">{{ trans('Auth::customer.edit.header_btn_save') }}</button>
            </div>
        </div>
    </div>
    </form>
</div>
<!--end::Modal-->
@endsection


@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="admin/assets/js/pages/custom/profile/profile.js?v=7.0.5"></script>
<script src="js/pages/location.js"></script>
<script src="js/pages/user.js"></script>
@endsection
