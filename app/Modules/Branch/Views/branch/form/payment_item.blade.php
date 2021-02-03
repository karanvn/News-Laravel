<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$partner->id }}" />
<div class="card-body">

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_type') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control form-control-solid" name="payment_type">
                <option value="1" {{ @$partner->payment_type == '1' ? "selected" : '' }}>{{ trans('Partner::partner.add.form.payment_type_values.one') }}</option>
                <option value="3" {{ @$partner->payment_type == '3' ? "selected" : '' }}>{{ trans('Partner::partner.add.form.payment_type_values.three') }}</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_period') }}</label>
        <div class="col-lg-9 col-xl-6">
            <select class="form-control form-control-solid" name="payment_period">
                <option value="15" {{ @$partner->payment_period == '15' ? "selected" : '' }}>{{ trans('Partner::partner.add.form.payment_period_values.half') }}</option>
                <option value="30" {{ @$partner->payment_period == '30' ? "selected" : '' }}>{{ trans('Partner::partner.add.form.payment_period_values.end') }}</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_bank_user') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="payment_bank_user" placeholder="" value="{{ @$partner->payment_bank_user }}">
            <span class="form-text text-error payment_bank_user-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_bank_name') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="payment_bank_name" placeholder="" value="{{ @$partner->payment_bank_name }}">
            <span class="form-text text-error payment_bank_name-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_bank_branch') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="payment_bank_branch" placeholder="" value="{{ @$partner->payment_bank_branch }}">
            <span class="form-text text-error payment_bank_branch-error"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.payment_bank_account') }} </label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" name="payment_bank_account" placeholder="" value="{{ @$partner->payment_bank_account }}">
            <span class="form-text text-error payment_bank_account-error"></span>
        </div>
    </div>


</div>
<!--end::Body-->
