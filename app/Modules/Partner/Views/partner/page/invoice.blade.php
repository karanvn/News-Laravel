<form id="frmAddPartner" name="frmAddPartner" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <input type="hidden" name="page" value="invoice" />
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{ trans('Partner::partner.edit.header_invoice') }}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">{{ trans('Partner::partner.edit.sub_invoice') }}</span>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-success mr-2">{{ trans('Partner::partner.edit.header_btn_save') }}</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
            @include('Partner::partner.form.invoice_item')
        <!--end::Form-->
    </div>
    </form>
