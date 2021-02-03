<!--begin::Body-->
<input type="hidden" name="block_id" value="{{ @$block->block_id }}" />
<div class="card-bodys p-4">
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.block.add.form.name') }} <span class="label-text-error">*</span></label>
        <input class="form-control form-control-lg" type="text" name="name" placeholder="" value="{{ @$block->name }}">
        <span class="form-text text-error name-error"></span>
    </div>
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.block.add.form.position_type') .'/'.trans('Mail::mail.block.add.form.status') }}</label>
        <select class="form-control custom-select" name="status">
            @foreach(get_mail_statuses() as $key => $value)
            <option value="{{ $key }}" {{ @$block->status == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    {{--
    <div class="form-group row">
        <label class="col-xl-2 col-lg-2 col-form-label text-right">{{ trans('Mail::mail.block.add.form.file_name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-10 col-xl-8">
            <input class="form-control form-control-lg" type="text" name="file_name" placeholder="" value="{{ @$block->file_name }}">
            <span class="form-text text-error file_name-error"></span>
        </div>
    </div>
    --}}
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.block.add.form.html') }}<span class="label-text-error">*</span></label>
        <textarea id="block_html" class="form-control" rows="5" name="html">{!! @$block->html !!}</textarea>
        <span class="form-text text-error html-error"></span>
    </div>
    {{--
    <div class="form-group row">
        <label class="col-form-label">{{ trans('Mail::mail.block.add.form.show_type') }}</label>
        <select class="form-control custom-select" name="show_type">
            @foreach(get_block_shows() as $key => $value)
            <option value="{{ $key }}" {{ @$block->show_type == $key ? "selected" : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    --}}
</div>
<!--end::Body-->
