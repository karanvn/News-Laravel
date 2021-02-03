<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$user->id }}" />
<div class="card-body">
    {{--
    <p><strong><i class="icon-1x text-dark-10 flaticon2-arrow"></i> {{ trans('Rule::rule.user.role') }}</strong></p>
    --}}
    @if(count($roles) > 0)
        @foreach($roles as $role)
        @php
            $permissions = $role->permissions()->orderBy('title', 'asc')->get();
        @endphp
        @if(count($permissions) > 0)
        <div class="form-group">
            <label><strong>{{ $role->name }}</strong></label>
            <div class="checkbox-inline row">
                @foreach($permissions as $permission)
                <div class="col-lg-6 mb-4">
                    <label class="checkbox checkbox-success">
                        <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" {{  $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        <span></span> {{ $permission->title }}
                    </label>
                </div>
                @endforeach
            </div>
            <span class="form-text text-muted"></span>
        </div>
        @endif
        @endforeach
    @endif
</div>
{{--
@include('Rule::rule.executed')
--}}
<!--end::Body-->
