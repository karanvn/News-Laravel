<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$branch->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.avatar') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-outline" id="kt_image">
                <div class="image-input-wrapper" style="background-image: url({{ show_image(config('branch.image.thumb_path'), @$branch->avatar) }})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Branch::branch.add.form.avatar_change') }}">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">

                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Branch::branch.add.form.avatar_cancel') }}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">{{ trans('Branch::branch.add.form.allow_image_extension') }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text" name="name" placeholder="" value="{{ @$branch->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.address') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="text" name="address" placeholder="" value="{{ @$branch->address }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="status">
                @foreach(get_branch_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$branch->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.description') }}</label>
        <div class="col-lg-9 col-xl-6">
            <textarea id="full_descriptions" class="form-control" rows="5" name="description">{!! @$branch->description !!}</textarea>
        </div>
    </div>
</div>
<!--end::Body-->
