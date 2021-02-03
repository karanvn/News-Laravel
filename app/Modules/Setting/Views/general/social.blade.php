<!--begin::Body-->
@php
    $social = !empty($generals['SOCIAL']) ? $generals['SOCIAL'] : [];
@endphp
<style>
    .show_hidden{
        width: 100px;
    }
</style>

<div class="form-group row">
    <label class="col-form-label">Link Facebook</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[facebook]" placeholder="" value="{{ @$social['facebook'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_facebook]" id="">
        <option value="1" @if(@$social['status_facebook'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_facebook'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Youtube</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[youtube]" placeholder="" value="{{ @$social['youtube'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_youtube]" id="">
        <option value="1" @if(@$social['status_youtube'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_youtube'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Instagram</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[instagram]" placeholder="" value="{{ @$social['instagram'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_instagram]" id="">
        <option value="1" @if(@$social['status_instagram'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_instagram'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Zalo</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[zalo]" placeholder="" value="{{ @$social['zalo'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_zalo]" id="">
        <option value="1" @if(@$social['status_zalo'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_zalo'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Linkedin</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[likedin]" placeholder="" value="{{ @$social['likedin'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_linkedin]" id="">
        <option value="1" @if(@$social['status_linkedin'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_linkedin'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Twitter</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[twitter]" placeholder="" value="{{ @$social['twitter'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_twiter]" id="">
        <option value="1" @if(@$social['status_twiter'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_twiter'] == 0) selected @endif>Ẩn</option>
    </select>
</div>
<div class="form-group row">
    <label class="col-form-label">Link Tiktok</label>
    <input class="form-control form-control-lgs" type="text" name="SOCIAL[tiktok]" placeholder="" value="{{ @$social['tiktok'] }}">
    <select class="form-control mt-3 show_hidden" name="SOCIAL[status_tiktok]" id="">
        <option value="1" @if(@$social['status_tiktok'] == 1) selected @endif>Hiển thị</option>
        <option value="0" @if(@$social['status_tiktok'] == 0) selected @endif>Ẩn</option>
    </select>
</div>


<!--end::Body-->
