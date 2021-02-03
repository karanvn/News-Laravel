<div class="card-body">
    <p><strong><i class="icon-1x text-dark-10 flaticon2-arrow"></i> {{ trans('Rule::rule.user.role') }}</strong></p>
    @foreach($rules as $rule)
    @php
        $roles = $rule->roles()->orderBy('name', 'asc')->get();
        $checked = !empty(@$user_roles) ? true : false;
    @endphp
    @if(count($roles) > 0)
    <div class="form-group">
        <label><strong>{{ $rule->name }}</strong></label>
        <div class="checkbox-inline">
            @foreach($roles as $role)
            <label class="checkbox checkbox-success">
                <input type="checkbox" name="role_ids[]" value="{{ $role->id }}" {{  $checked ? (in_array($role->id, @$user_roles) ? 'checked' : '') : '' }}>
                <span></span> {{ $role->name }}
            </label>
            @endforeach
        </div>
        <span class="form-text text-muted"></span>
    </div>
    @endif
    @endforeach
</div>
{{--
<div class="separator separator-dashed my-2"></div>
<div class="card-body">
    <p><strong><i class="icon-1x text-dark-10 flaticon2-arrow"></i> {{ trans('Rule::rule.user.permission') }}</strong></p>
    <div class="form-group">
        <div class="col-lg-12 col-xl-12">
            <select class="form-control select2" id="op_permissions" name="permission_ids[]" multiple="true" data-select2-id="op_permissions" tabindex="-1" aria-hidden="true">
                @if(count($permissions) > 0)
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
--}}


