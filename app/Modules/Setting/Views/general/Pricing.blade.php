<!--begin::Body-->
@php
    $pricing = !empty($generals['PRICING']) ? $generals['PRICING'] : [];
    // dd($policy)
@endphp

@if (empty($pricing)) 
<div class="cards card-custom card-stretch bg-light-wh"> 
    <div class="card-body">
        <div class="col-lg-12">   
            <div class="form-group row">
                <label class="col-form-label">Loại</label>
                <input class="form-control form-control-lgs" type="text" name="PRICING[type][]" placeholder="" value=""> 
                <label class="col-form-label">Tên</label>
                <input class="form-control form-control-lgs" type="text" name="PRICING[name][]" placeholder="" value=""> 
                <label class="col-form-label">Giá</label>
                <input class="form-control form-control-lgs" type="number" name="PRICING[price][]" placeholder="" value="">
                <label class="col-form-label">Giới thiệu</label>
                <input class="form-control form-control-lgs" type="text" name="PRICING[discription][]" placeholder="" value="">
                <p><small class="text-success"> Nội dung trong giới thiệu cách nhau bởi giấu phẩy. </small></p> 
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="form-group row">
    <div class="col-sm-12">
        <button type="button" id="add_boxPringcing" class="btn btn-flat btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Thêm
        </button>
    </div>
</div>
@else
    @for ($i = 0; $i < count($pricing['name']); $i++)
    <div class="cards card-custom card-stretch bg-light-wh @if($i != 0) mt-5 @endif"> 
        <div class="card-body">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-form-label">Loại</label>
                    <input class="form-control form-control-lgs" type="text" name="PRICING[type][]" placeholder="" value="{{ @$pricing['type'][$i] }}">
                    <label class="col-form-label">Tên</label>
                    <input class="form-control form-control-lgs" type="text" name="PRICING[name][]" placeholder="" value="{{ @$pricing['name'][$i] }}"> 
                    <label class="col-form-label">Giá</label>
                <input class="form-control form-control-lgs" type="number" name="PRICING[price][]" placeholder="" value="{{ @$pricing['price'][$i] }}"> 
                <label class="col-form-label">Giới thiệu</label>
                <input class="form-control form-control-lgs" type="text" name="PRICING[discription][]" placeholder=""  value="{{ @$pricing['discription'][$i] }}"> 
                <p><small class="text-success"> Nội dung trong giới thiệu cách nhau bởi giấu phẩy. </small></p> 

            </div>
            </div>
        </div>
    </div>
    @endfor
    <div class="form-group row mt-5">
        <div class="col-sm-12">
            <button type="button" id="add_boxPringcing" class="btn btn-flat btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm
            </button>
        </div>
    </div>
    @endif


<!--end::Body-->
