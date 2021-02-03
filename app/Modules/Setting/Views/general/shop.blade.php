<!--begin::Body-->
@php
    $shop        = !empty($generals['SHOP']) ? $generals['SHOP'] : [];
    $logo        = !empty($generals['LOGO']) ? $generals['LOGO'] : [];
    $state_id    = !empty($shop['state_id']) ? $shop['state_id'] : 0;
    $district_id = !empty($shop['district_id']) ? $shop['district_id'] : 0;
    $ward_id     = !empty($shop['ward_id']) ? $shop['ward_id'] : 0;
@endphp

<div class="image-input image-input-outline" id="kt_image">
    <div class="image-input-wrapper" style="background-image: url({{ asset('/Logo/logo.png')}})"></div>
    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" data-original-title="{{ trans('Setting::setting.shop.image_change') }}">
        <i class="fa fa-pen icon-sm text-muted"></i>
        <input type="file" name="image" accept=".png, .jpg, .jpeg">
    </label>
    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Setting::setting.shop.image_cancel') }}">
        <i class="ki ki-bold-close icon-xs text-muted"></i>
    </span>
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.shop.shop_name') }}</label> 
    <input class="form-control form-control-lgs" type="text" name="SHOP[shop_name]" value="{{ @$shop['shop_name'] }}">
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.shop.email') }}</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[email]" value="{{ @$shop['email'] }}">
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.shop.business_name') }}</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[business_name]"  value="{{ @$shop['business_name'] }}">
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.shop.phone') }}</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[phone]" placeholder="" value="{{ @$shop['phone'] }}">
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.shop.address') }}</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[address]" placeholder="" value="{{ @$shop['address'] }}">
</div>

<div class="form-group row" >
    <label class="col-form-label">{{ trans('Location::state.add.form.name') }}</label>
    <select class="form-control select2" id="seState" name="SHOP[state_id]" selected-id="{{ @$state_id }}">
    </select>
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Location::district.add.form.name') }} </label>
    <select class="form-control select2" id="seDistrict" name="SHOP[district_id]" selected-id="{{ @$district_id }}">
    </select>
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Location::ward.add.form.name') }} </label>
    <select class="form-control select2" id="seWard" name="SHOP[ward_id]" selected-id="{{ @$ward_id }}">
    </select>
</div>
<!--end::Body-->
