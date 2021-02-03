<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Partner::partner.add.form.partner') }}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control form-control-solid" id="op_partner" name="partner_id">
            @if(@$partner)
            <option value="{{ @$partner->id }}" selected>{{ @$partner->name }}</option>
            @endif
        </select>
    </div>
</div>

