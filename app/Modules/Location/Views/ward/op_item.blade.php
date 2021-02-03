<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::ward.add.form.name') }} <span class="label-text-error">*</span> </label>
    <div class="col-lg-6 col-xl-6">
        <select class="form-control select2" id="seWard" name="ward_id" selected-id="{{ @$ward_id }}">

        </select>
        <span class="form-text text-error ward_id-error"></span>
    </div>
</div>
