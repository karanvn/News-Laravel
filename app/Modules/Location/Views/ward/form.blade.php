<!--begin::Body-->
<input type="hidden" name="ward_id" value="{{ @$ward->ward_id }}" />
<div class="card-body">
    @include('Location::state.op_item')
    @include('Location::district.op_item')
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::ward.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text" name="name" placeholder="" value="{{ @$ward->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::ward.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control" name="status">
                @foreach(get_location_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$ward->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::state.add.form.shipping') }}</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="number" name="shipping" placeholder="" value="{{ @$ward->shipping }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
</div>
<!--end::Body-->
