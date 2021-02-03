<form id="frmAddCustomer" name="frmAddCustomer" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
<input type="hidden" name="page" value="general" />
<div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">{{ trans('Auth::customer.edit.header_general') }}</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">{{ trans('Auth::customer.edit.sub_general') }}</span>
        </div>
        <div class="card-toolbar">
            <button type="submit" class="btn btn-success mr-2"><i class="icon-x fas fa-save"></i> {{ trans('Auth::customer.edit.header_btn_save') }}</button>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
        @include('Auth::customer.form.general_item')
    <!--end::Form-->
</div>
</form>
