<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$partner->id }}" />
<div class="card-body">
    <div class="row">
        <label class="col-xl-3"></label>
        <div class="col-lg-9 col-xl-6">
            <h5 class="font-weight-bold mb-6">{{ trans('Partner::partner.add.form.header_general_info') }}</h5>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.avatar') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-outline" id="kt_image">
                <div class="image-input-wrapper" style="background-image: url({{ @$partner->avatar ? 'storage/partner/thumb/'.$partner->avatar : 'admin/assets/media/users/blank.png' }})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Partner::partner.add.form.avatar_change') }}">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">

                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Partner::partner.add.form.avatar_cancel') }}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">{{ trans('Partner::partner.add.form.allow_image_extension') }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="name" placeholder="" value="{{ @$partner->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.email') }} <span class="label-text-error">*</span> </label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-at"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" name="email" {{ !empty(@$partner->id) ? "readonly" : '' }} value="{{ @$partner->email }}" placeholder="">
            </div>
            <span class="form-text text-error email-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select form-control-solid" name="status">
                @foreach(get_partner_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$partner->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <label class="col-xl-3"></label>
        <div class="col-lg-9 col-xl-6">
            <h5 class="font-weight-bold mt-10 mb-6">{{ trans('Partner::partner.add.form.header_contact_info') }}</h5>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.address') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" name="address" type="text" value="{{ @$partner->address }}" placeholder="">
            <span class="form-text text-error address-error"></span>
        </div>
    </div>
    @php
        $state_id = !empty($partner->state_id) ? $partner->state_id : 0;
        $district_id = !empty($partner->district_id) ? $partner->district_id : 0;
        $ward_id = !empty($partner->ward_id) ? $partner->ward_id : 0;
    @endphp
    @include('Location::location.form')
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.phone') }} <span class="text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-phone"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" name="phone" value="{{ @$partner->phone }}" placeholder="">
            </div>
            <span class="form-text text-error phone-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.com_site') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <input type="text" class="form-control form-control-lg form-control-solid" name="com_site" value="{{ @$partner->com_site }}" placeholder="" >
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.description') }}</label>
        <div class="col-lg-9 col-xl-6">
            <textarea id="full_descriptions" class="form-control form-control-solid" rows="5" name="description">{!! @$partner->description !!}</textarea>
        </div>
    </div>
</div>
<!--end::Body-->
