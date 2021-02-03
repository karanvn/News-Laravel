<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$user->id }}" />
<div class="card-body">
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

</div>
<!--end::Body-->
