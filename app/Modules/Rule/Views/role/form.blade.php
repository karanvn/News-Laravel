<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$role->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::role.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solids" type="text"  {{ !empty(@$role->id) ? "readonly" : '' }} name="name" placeholder="" value="{{ @$role->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    {{--
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::role.add.form.rule_id') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select form-control-solid" name="rule_id">
                @foreach($rules as $rule)
                <option value="{{ $rule->id }}" {{ @$role->rule_id == $rule->id ? "selected" : '' }} >{{ $rule->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    --}}

    @php

        $permissions = @$role ? @$role->permissions()->get() : false;
    @endphp

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::role.add.form.permission_id') }} </label>
        <div class="col-lg-6 col-xl-6">
            <select class="form-control select2" id="op_permissions" name="permission_ids[]" multiple="true" data-select2-id="op_permissions" tabindex="-1" aria-hidden="true">
                @if($permissions)
                    @foreach($permissions as $permission)
                        <option selected="selected" value="{{ @$permission->id }}" >{{ @$permission->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

</div>
<!--end::Body-->
