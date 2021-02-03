<!--begin::Body-->
@php
    $policy = !empty($generals['POLICY']) ? $generals['POLICY'] : [];
    // dd($policy)
@endphp

@if (empty($policy)) 
<div class="cards card-custom card-stretch bg-light-wh"> 
    <div class="card-body">
        <div class="col-lg-12">   
            <div class="form-group row">
                <label class="col-form-label">Tên chính sách</label>
                <input class="form-control form-control-lgs" type="text" name="POLICY[name][]" placeholder="" value=""> 
                <label class="col-form-label">Mô tả</label>
                <textarea class="form-control form-control-lgs" name="POLICY[desc][]" placeholder=""></textarea>
                <label class="col-form-label">Icon</label>
                <input class="form-control form-control-lgs" type="text" name="POLICY[icon][]" placeholder="" value=""> 
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="form-group row">
    <div class="col-sm-12">
        <button type="button" id="add_box" class="btn btn-flat btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Thêm chính sách
        </button>
    </div>
</div>
@else
    @for ($i = 0; $i < count($policy['name']); $i++)
    <div class="cards card-custom card-stretch bg-light-wh @if($i != 0) mt-5 @endif"> 
        <div class="card-body">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-form-label">Tên chính sách</label>
                    <input class="form-control form-control-lgs" type="text" name="POLICY[name][]" placeholder="" value="{{ @$policy['name'][$i] }}"> 
                    <label class="col-form-label">Mô tả</label>
                    <textarea class="form-control form-control-lgs" name="POLICY[desc][]" placeholder="">{{ @$policy['desc'][$i] }}</textarea>
                    <label class="col-form-label">Icon</label>
                    <input class="form-control form-control-lgs" type="text" name="POLICY[icon][]" placeholder="" value="{{ @$policy['icon'][$i] }}"> 
                </div>
            </div>
        </div>
    </div>
    @endfor
    <div class="form-group row mt-5">
        <div class="col-sm-12">
            <button type="button" id="add_box" class="btn btn-flat btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm chính sách
            </button>
        </div>
    </div>
    @endif


<!--end::Body-->
