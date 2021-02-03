<!--begin::Body-->
<input type="hidden" name="banner_id" value="{{ @$banner->id }}" />
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.avatar') }} <span class="label-text-error">*</span></label>
    <div class="input-group">
        <div class="image-input image-input-outline" id="kt_banner" style="width: 100%">
            <div class="image-input-wrapper" style="background-image: url({{ show_banner(config('banner.image.org_path'), @$banner->avatar) }}); width: 100%"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Banner::banner.add.form.avatar_change') }}">
                <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                <input type="file" name="banner_avatar" accept=".png, .jpg, .jpeg">
            </label>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Banner::banner.add.form.avatar_cancel') }}">
                <i class="icon-x text-dark-50 flaticon-delete-1"></i>
            </span>
        </div>
    </div>
    <div class="input-group">
        <span class="form-text text-muted">{{ trans('Banner::banner.add.form.allow_image_extension') }}</span>
        <span class="form-text text-error avatar-error"></span>
    </div>
    <span class="form-text text-error banner_avatar-error"></span>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.name') }} <span class="label-text-error">*</span></label>
    <input class="form-control form-control-lg" type="text" name="banner_name" placeholder="" value="{{ @$banner->name }}">
    <span class="form-text text-error banner_name-error"></span>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.published_start') }} / {{ trans('Banner::banner.add.form.published_end') }} <span class="label-text-error">*</span></label>
    <div class="input-daterange input-group" id="kt_datepicker_5">
        <input type="text" class="form-control" name="banner_published_start" readonly="readonly" value="{{ !empty($banner->published_start) ? $banner->published_start : date('Y-m-d H:i') }}" id="dtpk_published_start">
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar glyphicon-th"></i>
            </span>
        </div>
        <input type="text" class="form-control" name="banner_published_end" readonly="readonly" value="{{ !empty($banner->published_end) ? $banner->published_end : date('Y-m-d H:i') }}" id="dtpk_published_end">
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar glyphicon-th"></i>
            </span>
        </div>
    </div>
    <span class="form-text text-error banner_published_start-error"></span>
    <span class="form-text text-error banner_published_end-error"></span>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.extension') }}</label>
    <select class="form-control custom-select" name="banner_extension">
        @foreach(get_banner_extensions() as $key => $value)
        <option value="{{ $key }}" {{ @$banner->extension == $key ? "selected" : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.link_youtube') }} </label>
    <input class="form-control form-control-lg form-control-solid" name="link_youtube" type="text" value="{{ @$banner->link_youtube }}" placeholder="">
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.link') }} </label>
    <input class="form-control form-control-lg" name="banner_link" type="text" value="{{ @$banner->link }}" placeholder="">
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.titlebutton') }} </label>
    <input class="form-control form-control-lg form-control-solid" name="titlebutton" type="text" value="{{ @$banner->titlebutton }}" placeholder="">
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.description') }} </label>
    <input class="form-control form-control-lg form-control-solid" name="banner_description" type="text" value="{{ @$banner->description }}" placeholder="">
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Banner::banner.add.form.status') }}</label>
    <select class="form-control custom-select" name="banner_status">
        @foreach(get_banner_statuses() as $key => $value)
        <option value="{{ $key }}" {{ @$banner->status == $key ? "selected" : '' }}>{{ $value }}</option>
        @endforeach
    </select>
    
</div>
<!--end::Body-->
