<!--begin::Body-->
@php
    $order = !empty($generals['ORDER']) ? $generals['ORDER'] : [];
@endphp
<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.order.start') }}</label>
    <input class="form-control form-control-lgs" type="text" name="ORDER[start]" placeholder="" value="{{ @$order['start'] }}"> 
</div>
<div class="form-group row">
    <label class="col-form-label">{{ trans('Setting::setting.order.end') }}</label>
    <input class="form-control form-control-lgs" type="text" name="ORDER[end]" placeholder="" value="{{ @$order['end'] }}">
</div>


<!--end::Body-->
