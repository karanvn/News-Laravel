<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$branch->id }}" />
<div class="card-body">
    <div class="row">
        <label class="col-xl-3"></label>
        <div class="col-lg-9 col-xl-6">
            <h5 class="font-weight-bold mb-6">{{ trans('Branch::branch.add.form.header_general_info') }}</h5>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.avatar') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-outline" id="kt_image">
                <div class="image-input-wrapper" style="background-image: url({{ @$branch->avatar ? 'storage/branch/thumb/'.$branch->avatar : 'admin/assets/media/users/blank.png' }})"></div>
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
            <input class="form-control form-control-lg form-control-solid" type="text" name="name" placeholder="" value="{{ @$branch->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.email') }} <span class="label-text-error">*</span> </label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-at"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" name="email" {{ !empty(@$branch->id) ? "readonly" : '' }} value="{{ @$branch->email }}" placeholder="">
            </div>
            <span class="form-text text-error email-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control form-control-solid" name="status">
                <option value="D" {{ @$branch->status == 'D' ? "selected" : '' }}>{{ trans('Branch::branch.add.form.statuses.D') }}</option>
                <option value="A" {{ @$branch->status == 'A' ? "selected" : '' }}>{{ trans('Branch::branch.add.form.statuses.A') }}</option>
            </select>
        </div>
    </div>
    <div class="row">
        <label class="col-xl-3"></label>
        <div class="col-lg-9 col-xl-6">
            <h5 class="font-weight-bold mt-10 mb-6">{{ trans('Branch::branch.add.form.header_contact_info') }}</h5>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.address') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" name="address" type="text" value="{{ @$branch->address }}" placeholder="">
            <span class="form-text text-error address-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.phone') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-phone"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" name="phone" value="{{ @$branch->phone }}" placeholder="">
            </div>
            <span class="form-text text-error phone-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Branch::branch.add.form.description') }}</label>
        <div class="col-lg-9 col-xl-6">
            <textarea id="full_descriptions" class="form-control form-control-solid" rows="5" name="description">{!! @$branch->description !!}</textarea>
        </div>
    </div>
</div>
<!--end::Body-->
