<!--begin::Body-->
<input type="hidden" name="id" value="{{ @$permission->id }}" />
<div class="card-body">
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::permission.add.form.title') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solids" type="text" name="title" placeholder="" value="{{ @$permission->title }}">
            <span class="form-text text-error title-error"></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Rule::permission.add.form.name') }} <span class="label-text-error">*</span></label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text"  {{ !empty(@$permission->id) ? "readonly" : '' }} name="name" placeholder="" value="{{ @$permission->name }}">
            <span class="form-text text-error name-error"></span>
        </div>
    </div>
</div>
<!--end::Body-->
