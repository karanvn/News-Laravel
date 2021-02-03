<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$partner->id }}" />
<div class="card-body">

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.invoice_name') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="invoice_name" placeholder="" value="{{ @$partner->invoice_name }}">
            <span class="form-text text-error invoice_name-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.invoice_code') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="invoice_code" placeholder="" value="{{ @$partner->invoice_code }}">
            <span class="form-text text-error invoice_code-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.invoice_address') }} </label>
        <div class="col-lg-9 col-xl-6">
            <textarea class="form-control form-control-solid" rows="2" name="invoice_address">{{ @$partner->invoice_address }}</textarea>
        </div>
    </div>


</div>
<!--end::Body-->
