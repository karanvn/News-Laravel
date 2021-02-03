<!--begin::Body-->
@php
    $social = !empty($generals['LINK_CODE']) ? $generals['LINK_CODE'] : [];
@endphp
<style>
    .show_hidden{
        width: 100px;
    }
</style>

<div class="form-group row">
    <label class="col-form-label">Link code 1 <i style="font-size: 11px">(link nhúng chat facebook, zalo, google analytics)</i></label>
    <textarea class="form-control form-control-lgs" name="LINK_CODE[code_1]" id="" cols="30" rows="10">{{ @$social['code_1'] }}</textarea>
    <select class="form-control mt-3 show_hidden" name="LINK_CODE[status_1]" id="">
        <option value="1" @if(@$social['status_1'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_1'] == 0) selected @endif>Ẩn</option>
    </select>
    <div class="form-control mt-3">Vị trí cần chèn:
        <input type="radio" name="LINK_CODE[position_1]" value="header" @if(@$social['position_1'] == 'header') checked @endif> header
        <input type="radio" name="LINK_CODE[position_1]" value="body" @if(@$social['position_1'] == 'body') checked @endif> body
        <input type="radio" name="LINK_CODE[position_1]" value="footer" @if(@$social['position_1'] == 'footer') checked @endif> footer
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label">Link code 2 <i style="font-size: 11px">(link nhúng chat facebook, zalo, google analytics)</i></label>
    <textarea class="form-control form-control-lgs" name="LINK_CODE[code_2]" id="" cols="30" rows="10">{{ @$social['code_2'] }}</textarea>
    <select class="form-control mt-3 show_hidden" name="LINK_CODE[status_2]" id="">
        <option value="1" @if(@$social['status_2'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_2'] == 0) selected @endif>Ẩn</option>
    </select>
    <div class="form-control mt-3">Vị trí cần chèn:
        <input type="radio" name="LINK_CODE[position_2]" value="header" @if(@$social['position_2'] == 'header') checked @endif> header
        <input type="radio" name="LINK_CODE[position_2]" value="body" @if(@$social['position_2'] == 'body') checked @endif> body
        <input type="radio" name="LINK_CODE[position_2]" value="footer" @if(@$social['position_2'] == 'footer') checked @endif> footer
    </div>
</div>

<!--end::Body-->
