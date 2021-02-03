<!--begin::Body-->
<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$shipping->id }}" />

<div class="form-group">
    <label class="col-form-label">{{ trans('Auth::customer.add.form.name') }} <span class="label-text-error">*</span></label>
    <input class="form-control" type="text" name="name" placeholder="" value="{{ @$shipping->name }}">
    <span class="form-text text-error name-error"></span>
</div>
<div class="form-group">
    <label class="col-form-label">{{ trans('Auth::customer.add.form.phone') }} <span class="label-text-error">*</span> </label>
    <input type="text" class="form-control" name="phone" value="{{ @$shipping->phone }}" placeholder="">
    <span class="form-text text-error phone-error"></span>
</div>
<div class="form-group">
    <label class="col-form-label">{{ trans('Auth::customer.add.form.address') }} <span class="label-text-error">*</span></label>
    <input class="form-control" name="address" type="text" value="{{ @$shipping->address }}" placeholder="">
    <span class="form-text text-error address-error"></span>
</div>
@php
    $state_id = !empty($shipping->state_id) ? $shipping->state_id : 0;
    $district_id = !empty($shipping->district_id) ? $shipping->district_id : 0;
    $ward_id = !empty($shipping->ward_id) ? $shipping->ward_id : 0;
@endphp

<div class="form-group" >
    <label class="col-form-label">{{ trans('Location::state.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seState" name="state_id" selected-id="{{ @$state_id }}">
    </select>
    <span class="form-text text-error state_id-error"></span>
</div>
<div class="form-group">
    <label class="col-form-label">{{ trans('Location::district.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seDistrict" name="district_id" selected-id="{{ @$district_id }}">
    </select>
    <span class="form-text text-error district_id-error"></span>
</div>
<div class="form-group">
    <label class="col-form-label">{{ trans('Location::ward.add.form.name') }} <span class="label-text-error">*</span> </label>
    <select class="form-control select2" id="seWard" name="ward_id" selected-id="{{ @$ward_id }}">

    </select>
    <span class="form-text text-error ward_id-error"></span>
</div>

<div class="form-group">
    {{-- <labelclass="col-form-label">trans('Auth::customer.add.form.position').'/'.trans('Auth::customer.add.form.status')</label>--}}
    <div class="input-daterange input-group">
        <div class="input-group-append">
            <span class="input-group-text">
                {{ trans('Auth::customer.add.form.position') }}
            </span>
        </div>
        <input class="form-control" type="number" min="0" name="position" value="{{ !empty($shipping->position) ? $shipping->position : 0 }}">

        <div class="input-group-append">
            <span class="input-group-text">
                {{ trans('Auth::customer.add.form.status') }}
            </span>
        </div>
        <select class="form-control custom-select" name="status">
            @foreach(get_user_statuses() as $key => $value)
            <option value="{{ $key }}" {{ @$shipping->status == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<!--end::Body-->
