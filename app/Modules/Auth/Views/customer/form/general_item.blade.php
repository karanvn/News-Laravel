<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$user->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.avatar') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="image-input image-input-outline" id="kt_image">
                <div class="image-input-wrapper" style="background-image: url({{  show_image(config('auth_.image.customer_thumb_path'), @$user->avatar) }})"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('Auth::customer.add.form.avatar_change') }}">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">

                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('Auth::customer.add.form.avatar_cancel') }}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            </div>
            <span class="form-text text-muted">{{ trans('Auth::customer.add.form.allow_image_extension') }}</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg" type="text" name="name" placeholder="" value="{{ @$user->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.email') }} <span class="label-text-error">*</span> </label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control form-control-lg" name="email" {{ !empty(@$user->id) ? "readonly" : '' }} value="{{ @$user->email }}" placeholder="">
            </div>
            <span class="form-text text-error email-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.phone') }} </label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control form-control-lg" name="phone" value="{{ @$user->phone }}" placeholder="">
            </div>
        </div>
    </div>

    @if(empty($user))
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.password') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg" name="password" type="password" value="" placeholder="">
            <span class="form-text text-error password-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.re_password') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg" name="re_password" type="password" value="" placeholder="">
            <span class="form-text text-error re_password-error"></span>
        </div>
    </div>
    @endif

    <input type="hidden" name="user_type" value="C" />

    {{--@include('Partner::partner.third.select')

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.position') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="position" placeholder="" value="{{ @$user->position }}">
        </div>
    </div>
    --}}

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.gender') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="gender">
                @foreach(get_user_genders() as $key => $value)
                <option value="{{ $key }}" {{ @$user->gender == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.bod') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control" type="date" name="bod" value="{{ !empty($user) ? @$user->bod : date('Y-m-d', time()) }}" id="example-date-input">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.add.form.status') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control custom-select" name="status">
                @foreach(get_user_statuses() as $key => $value)
                <option value="{{ $key }}" {{ @$user->status == $key ? "selected" : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>
<!--end::Body-->
