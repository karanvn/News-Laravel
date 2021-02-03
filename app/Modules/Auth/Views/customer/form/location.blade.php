<div class="form-group row">
    <label class="col-form-label">{{ trans('Location::state.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seState" name="state_id" selected-id="{{ @$state_id }}">
    </select>
    <span class="form-text text-error state_id-error"></span>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Location::district.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seDistrict" name="district_id" selected-id="{{ @$district_id }}">
    </select>
    <span class="form-text text-error district_id-error"></span>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Location::ward.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seWard" name="ward_id" selected-id="{{ @$ward_id }}">

    </select>
    <span class="form-text text-error ward_id-error"></span>
</div>
