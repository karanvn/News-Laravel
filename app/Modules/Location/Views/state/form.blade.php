<!--begin::Body-->
<input type="hidden" name="state_id" value="{{ @$state->state_id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::state.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control" type="text" name="name" placeholder="" value="{{ @$state->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::state.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="status">
                @foreach(get_location_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$state->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::state.add.form.shipping') }}</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control" type="number" name="shipping" placeholder="" value="{{ @$state->shipping }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Location::state.add.form.freeship') }}</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control" type="number" name="free_ship" placeholder="" value="{{ @$state->free_ship }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
</div>
<!--end::Body-->
