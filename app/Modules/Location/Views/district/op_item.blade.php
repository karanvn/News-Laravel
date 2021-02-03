<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::district.add.form.name') }} <span class="label-text-error">*</span> </label>
    <div class="col-lg-6 col-xl-6">
        <select class="form-control select2" id="seDistrict" name="district_id" selected-id="{{ @$district_id }}">

        </select>
        <span class="form-text text-error district_id-error"></span>
    </div>
</div>
