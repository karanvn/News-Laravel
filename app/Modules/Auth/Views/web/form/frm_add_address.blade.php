@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@csrf
<input type="hidden" name="id" value="{{ @$shipping->id}}">
<p class="lynessa-form-row lynessa-form-row--first form-row form-row-first">
    <label>Người nhận<span class="required">* </span><span
            class="required text-error name-error"></span></label>
    <input type="text" class="lynessa-Input lynessa-Input--text input-text text-left" name="name" value="{{ isset($shipping->name)?$shipping->name:old('name') }}">
</p>
<p class="lynessa-form-row lynessa-form-row--last form-row form-row-last">
    <label>Điện thoại<span class="required">* </span><span
            class="required text-error phone-error"></span></label>
    <input type="text" class="lynessa-Input lynessa-Input--text input-text text-left" name="phone" value="{{ isset($shipping->phone)?$shipping->phone:old('phone') }}">
</p>
<div class="clear"></div>

<p class="lynessa-form-row lynessa-form-row--first form-row form-row-first">
    <label>Địa chỉ<span class="required">* </span><span
            class="required text-error address-error"></span></label>
    <input type="text" class="lynessa-Input lynessa-Input--text input-text text-left" name="address" value="{{ isset($shipping->address)?$shipping->address:old('address') }}">
</p>
<p class="lynessa-form-row lynessa-form-row--last form-row form-row-last">
    <label>Trạng thái</label>
    <span class="lynessa-input-wrapper">
        <select name="status" class="country_to_state country_select">
            <option @if(isset($shipping->status)) {{  $shipping->status=='A'?'selected':'' }} @else {{ old('status')=='A'?'selected':'' }} @endif value="A">Kích hoạt</option>
            <option @if(isset($shipping->status)) {{  $shipping->status=='D'?'selected':'' }} @else {{ old('status')=='D'?'selected':'' }} @endif value="D">Vô hiệu</option>
        </select>
    </span>
</p>
<div class="clear"></div>

<p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
    <label for="account_display_name">Tỉnh/Thành<span class="required">* </span></label>
    
    <span class="lynessa-input-wrapper">
        <select class="form-control" id="seState" name="state_id" selected-id="0">
            <option value="">---Chọn tỉnh/thành phố---</option>
            @foreach (@$states as $state)
            <option {{ @$shipping->state_id == $state->state_id ? 'selected' : '' }} value="{{ $state->state_id }}">{{ $state->name }}</option>
            @endforeach
        </select>
        <span class="required text-error state_id-error"></span>
    </span>
</p>
<p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
    <label for="account_display_name">Quận/Huyện<span class="required">* </span></label>
    <span class="lynessa-input-wrapper">
        <select class="form-control" id="seDistrict" name="district_id" selected-id="0">
            <option value="">---Chọn quận/huyện---</option>
            @if(isset($districts))
            @foreach($districts as $district)
            <option {{ $shipping->district_id == $district->district_id ? 'selected' : '' }} value="{{ $district->district_id }}">{{ $district->name }}</option>
            @endforeach
            @endif
        </select>
        <span class="required text-error district_id-error"></span>
    </span>
</p>
<p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
    <label for="account_display_name">Phường/Xã<span class="required">* </span></label>
    <span class="lynessa-input-wrapper">
        <select class="form-control" id="seWard" name="ward_id" selected-id="0">
            <option value="">---Chọn phường/xã---</option>
            @if(isset($wards))
            @foreach($wards as $ward)
            <option {{ $shipping->ward_id == $ward->ward_id ? 'selected' : '' }} value="{{ $ward->ward_id }}">{{ $ward->name }}</option>
            @endforeach
            @endif
        </select>
        <span class="required text-error ward_id-error"></span>
    </span>
</p>
<fieldset></fieldset>
<p class="text-center">
    <button type="submit" class="lynessa-Button button" value="Save changes">Lưu
    </button>
</p>
@section('script')
    <script>
            $(document).ready(function() {
                $('#seState').on('change', function(){
                    var state_id = $('#seState').val();
                    console.log(state_id);
                    $.ajax({
                        url: `/user/district/${state_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result)
                        {
                            var html = '<option value="">---Chọn quận/huyện---</option>';
                            var html1 = '<option value="">---Chọn phường/xã---</option>';
                            $.each(result.data, function(key, value){
                                //console.log(value.name);
                                html +=`<option value="${value.district_id}">${value.name}</option>`;
                            });
                            $('#seDistrict').html(html);
                            $('#seWard').html(html1);
                        }
                    });
                    
                });
                $('#seDistrict').on('change', function(){
                    var district_id = $('#seDistrict').val();
                    $.ajax({
                        url: `/user/ward/${district_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(result)
                        {
                            var html = '<option value="">---Chọn phường/xã---</option>';
                            $.each(result.data, function(key, value){
                                //console.log(value.name);
                                html +=`<option value="${value.ward_id}">${value.name}</option>`;
                            });
                            $('#seWard').html(html);
                        }
                    });
                    
                });
            });
    </script>
@endsection