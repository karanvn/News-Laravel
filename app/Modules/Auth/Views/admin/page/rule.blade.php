<form id="frmRuleAdmin" name="frmRuleAdmin" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
<input type="hidden" name="page" value="rule" />
<div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">{{ trans('Auth::admin.edit.header_rule') }}</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">{{ trans('Auth::admin.edit.sub_rule') }}</span>
        </div>
        <div class="card-toolbar">
            @if(count($roles) > 0)
                @if($auth->can('add admins') || $auth->id == 1)
                <button type="submit" class="btn btn-success mr-2">{{ trans('Auth::admin.edit.header_rule_btn') }}</button>
                @endif
            @endif
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
        @include('Auth::admin.form.rule_item')
    <!--end::Form-->
</div>
</form>
