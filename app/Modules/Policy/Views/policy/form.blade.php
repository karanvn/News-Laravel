<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$policy->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Policy::policy.add.form.image') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-outline" id="kt_image">
                <div class="image-input-wrapper" style="background-image: url({{ show_image(config('policy.image.thumb_path'), @$policy->image) }})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Policy::policy.add.form.image_change') }}">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="image" accept=".png, .jpg, .jpeg">

                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Policy::policy.add.form.image_cancel') }}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">{{ trans('Policy::policy.add.form.allow_image_extension') }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Policy::policy.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text" name="name" placeholder="" value="{{ @$policy->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Policy::policy.add.form.description') }}</label>
        <div class="col-lg-9 col-xl-6">
            <textarea id="full_descriptions" class="form-control" rows="5" name="description">{!! @$policy->description !!}</textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Policy::policy.add.form.icon') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text" name="icon" placeholder="" value="{{ @$policy->address }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Policy::policy.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="status">
                @foreach(get_policy_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$policy->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    
</div>
<!--end::Body-->
