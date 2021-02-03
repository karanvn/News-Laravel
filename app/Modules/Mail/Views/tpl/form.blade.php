<!--begin::Body-->
<input type="hidden" name="tpl_id" value="{{ @$tpl->tpl_id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.name') }} <span class="label-text-error">*</span></label>
        <input class="form-control form-control-lg" type="text" name="name" placeholder="" value="{{ @$tpl->name }}">
        <span class="form-text text-error name-error"></span>
    </div>

    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.subject') }}<span class="label-text-error">*</span></label>
        <textarea class="form-control" rows="2" name="subject">{!! @$tpl->subject !!}</textarea>
        <span class="form-text text-error subject-error"></span>
    </div>

    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.summary') }}</label>
        <textarea class="form-control" rows="2" name="summary">{!! @$tpl->summary !!}</textarea>
    </div>

    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.email') }}</label>
        <input class="form-control form-control-lg" type="text" name="email" placeholder="" value="{{ @$tpl->email }}">
    </div>

    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.type') }}</label>
        <select class="form-control custom-select" name="type">
            @foreach(get_tpl_types() as $key => $value)
            <option value="{{ $key }}" {{ @$tpl->type == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        <span class="form-text text-error type-error"></span>
    </div>

    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.tpl.add.form.status') }}</label>
        <select class="form-control custom-select" name="status">
            @foreach(get_mail_statuses() as $key => $value)
            <option value="{{ $key }}" {{ @$tpl->status == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>
<!--end::Body-->
