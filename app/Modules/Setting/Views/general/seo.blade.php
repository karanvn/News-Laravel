<!--begin::Body-->
@php
    $shop        = !empty($generals['SHOP']) ? $generals['SHOP'] : [];
    $state_id    = !empty($shop['state_id']) ? $shop['state_id'] : 0;
    $district_id = !empty($shop['district_id']) ? $shop['district_id'] : 0;
    $ward_id     = !empty($shop['ward_id']) ? $shop['ward_id'] : 0;
@endphp
<div class="form-group row">
    <label class="col-form-label">Seo title</label>
    <textarea class="form-control form-control-lgs" rows="2" cols="50" name="SHOP[seo_title]" placeholder="">{{ @$shop['seo_title'] }}</textarea>
</div>
<div class="form-group row">
    <label class="col-form-label">Seo keyword</label>
    <textarea class="form-control form-control-lgs" rows="2" cols="50" name="SHOP[seo_keyword]" placeholder="">{{ @$shop['seo_keyword'] }}</textarea>
</div>
<div class="form-group row">
    <label class="col-form-label">Seo description</label>
    <textarea class="form-control form-control-lgs" rows="4" cols="50" name="SHOP[seo_description]" placeholder="">{{ @$shop['seo_description'] }}</textarea>
</div>
<div class="form-group row">
    <label class="col-form-label">Tọa độ</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[position]" placeholder="" value="{{ @$shop['position'] }}">
</div>
<div class="form-group row">
    <label class="col-form-label">Coppyright</label>
    <input class="form-control form-control-lgs" type="text" name="SHOP[coppyright]" placeholder="" value="{{ @$shop['coppyright'] }}">
</div>


<!--end::Body-->
