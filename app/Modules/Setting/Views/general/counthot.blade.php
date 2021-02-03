<!--begin::Body-->
@php
    $counthot = !empty($generals['COUNTHOT']) ? $generals['COUNTHOT'] : [];
    // dd($policy)
@endphp

@if (empty($counthot)) 
<div class="cards card-custom card-stretch bg-light-wh"> 
    <div class="card-body">
        <div class="col-lg-12">   
            <div class="form-group row">
                <label class="col-form-label">Tên</label>
                <input class="form-control form-control-lgs" type="text" name="COUNTHOT[name][]" placeholder="" value=""> 
                <label class="col-form-label">Số lượng</label>
                <input class="form-control form-control-lgs" type="text" name="COUNTHOT[count][]" placeholder="" value=""> 
                <label class="col-form-label">Icon</label>
                <input class="form-control form-control-lgs" type="text" name="COUNTHOT[icon][]" placeholder="" value=""> 
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="form-group row">
    <div class="col-sm-12">
        <button type="button" id="add_boxCount" class="btn btn-flat btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Thêm
        </button>
    </div>
</div>
@else
    @for ($i = 0; $i < count($counthot['name']); $i++)
    <div class="cards card-custom card-stretch bg-light-wh @if($i != 0) mt-5 @endif"> 
        <div class="card-body">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-form-label">Tên</label>
                    <input class="form-control form-control-lgs" type="text" name="COUNTHOT[name][]" placeholder="" value="{{ @$counthot['name'][$i] }}"> 
                    <label class="col-form-label">Số lượng</label>
                    <textarea class="form-control form-control-lgs" name="COUNTHOT[count][]" placeholder="">{{ @$counthot['count'][$i] }}</textarea>
                    <label class="col-form-label">Icon</label>
                    <input class="form-control form-control-lgs" type="text" name="COUNTHOT[icon][]" placeholder="" value="{{ @$counthot['icon'][$i] }}"> 
                </div>
            </div>
        </div>
    </div>
    @endfor
    <div class="form-group row mt-5">
        <div class="col-sm-12">
            <button type="button" id="add_boxCount" class="btn btn-flat btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm
            </button>
        </div>
    </div>
    @endif


<!--end::Body-->
