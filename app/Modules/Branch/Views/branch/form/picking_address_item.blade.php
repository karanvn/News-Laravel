<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$partner->id }}" />
<div class="card-body">

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.picking_address') }} </label>
        <div class="col-lg-9 col-xl-6">
            <textarea class="form-control form-control-solid" rows="5" name="picking_address">{{ @$partner->picking_address }}</textarea>
        </div>
    </div>

</div>
<!--end::Body-->
