<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$rule->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::rule.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text"  name="name" placeholder="" value="{{ @$rule->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::rule.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="status">
                @foreach(get_rule_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$rule->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<!--end::Body-->
