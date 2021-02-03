<!--begin::Body-->
@php
    $image_product       = !empty($generals['IMAGE_PRODUCT']) ? $generals['IMAGE_PRODUCT'] : [];
    $image_thumb_product = !empty($generals['IMAGE_THUMB_PRODUCT']) ? $generals['IMAGE_THUMB_PRODUCT'] : [];
    $image_banner        = !empty($generals['IMAGE_BANNER']) ? $generals['IMAGE_BANNER'] : [];
@endphp
<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.image.product') }} ({{ trans('Setting::setting.image.width').' x '.trans('Setting::setting.image.height') }})</label>
    <div class="input-daterange input-group">
        <input class="form-control form-control-lgs" type="text" name="IMAGE_PRODUCT[width]" value="{{ @$image_product['width'] }}" >
        <div class="input-group-append">
            <span class="input-group-text">
                x
            </span>
        </div>
        <input class="form-control form-control-lgs" type="text" name="IMAGE_PRODUCT[height]" value="{{ @$image_product['height'] }}" > 
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.image.thumb_product') }} ({{ trans('Setting::setting.image.width').' x '.trans('Setting::setting.image.height') }})</label>
    <div class="input-daterange input-group">
        <input class="form-control form-control-lgs" type="text" name="IMAGE_THUMB_PRODUCT[width]" value="{{ @$image_thumb_product['width'] }}" >
        <div class="input-group-append">
            <span class="input-group-text">
                x
            </span>
        </div>
        <input class="form-control form-control-lgs" type="text" name="IMAGE_THUMB_PRODUCT[height]" value="{{ @$image_thumb_product['height'] }}" > 
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.image.image_banner') }} ({{ trans('Setting::setting.image.width').' x '.trans('Setting::setting.image.height') }})</label>
    <div class="input-daterange input-group">
        <input class="form-control form-control-lgs" type="text" name="IMAGE_BANNER[width]" value="{{ @$image_banner['width'] }}" >
        <div class="input-group-append">
            <span class="input-group-text">
                x
            </span>
        </div>
        <input class="form-control form-control-lgs" type="text" name="IMAGE_BANNER[height]" value="{{ @$image_banner['height'] }}" > 
    </div>
</div>


<!--end::Body-->
