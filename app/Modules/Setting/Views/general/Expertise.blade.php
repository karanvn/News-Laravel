<!--begin::Body-->
@php
    $Expertise = !empty($generals['EXPERTISE']) ? $generals['EXPERTISE'] : [];
    // dd($policy)
@endphp

@if (empty($Expertise)) 
<div class="cards card-custom card-stretch bg-light-wh"> 
    <div class="card-body">
        <div class="col-lg-12">   
            <div class="form-group row">
                <label class="col-form-label">Tên</label>
                <input class="form-control form-control-lgs" type="text" name="EXPERTISE[name][]" placeholder="" value=""> 
                <label class="col-form-label">Phần trăm</label>
                <input class="form-control form-control-lgs" type="text" name="EXPERTISE[count][]" placeholder="" value=""> 
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="form-group row">
    <div class="col-sm-12">
        <button type="button" id="add_boxExpertise" class="btn btn-flat btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Thêm
        </button>
    </div>
</div>
@else
    @for ($i = 0; $i < count($Expertise['name']); $i++)
    <div class="cards card-custom card-stretch bg-light-wh @if($i != 0) mt-5 @endif"> 
        <div class="card-body">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-form-label">Tên</label>
                    <input class="form-control form-control-lgs" type="text" name="EXPERTISE[name][]" placeholder="" value="{{ @$Expertise['name'][$i] }}"> 
                    <label class="col-form-label">Phần trăm</label>
                    <input type="number" class="form-control form-control-lgs" name="EXPERTISE[count][]" placeholder="" value="{{ @$Expertise['count'][$i] }}">
                    </div>
            </div>
        </div>
    </div>
    @endfor
    <div class="form-group row mt-5">
        <div class="col-sm-12">
            <button type="button" id="add_boxExpertise" class="btn btn-flat btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Thêm
            </button>
        </div>
    </div>
    @endif


<!--end::Body-->
