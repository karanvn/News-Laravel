@extends('admin.main')

@php
    $module = "inventory::";
@endphp

@section('title')
EXCEL
@endsection

@section('styles')

@endsection


@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">IMPORT EXCEL</h5>
            <!--end::Title-->
            @if(session('message'))
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <div class="d-flex align-items-center">
                <span class="text-dark-50"><span  class="text-success">{{ session('message') }}</span></span>
            </div>
            @endif
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Dropdown-->
            <div class="btn-group ml-2">
                
                <button type="submit" form="frmPreviewExcelModule" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base">XEM TRƯỚC</button>
            </div>
            <!--end::Dropdown-->
            <!--begin::Dropdown-->
            <div class="btn-group ml-2">

            </div>
            <!--end::Dropdown-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <div class="row">
            <!--begin::Form Input-->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 25px">
                <form id="frmPreviewExcelModule" name="frmPreviewExcelModule" method="post" class="form-horizontal" action="{{route('PreviewExcelModule')}}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Form-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="form-group row col-md-8 col-12 mx-auto">
                                <p>Chọn mốc thời gian</p>
                                <select class="form-control custom-select form-control-solid" name="typedate" id="type_date">
                                    <option value="TODAY">Hôm nay</option>
                                    <option value="THISWEEK">Tuần này</option>
                                    <option value="THISMONTH">Tháng này</option>
                                    <option value="THISYEAR">Năm này</option>
                                    <option value="0">Tùy chọn ngày khác</option>
                                </select>
                            </div>
                            <div class="form-group row col-md-8 col-12 mx-auto">
                                <p>Loại thống kê</p>
                                <select class="form-control custom-select form-control-solid" name="type">
                                    <option value="other">Thống kê doanh thu</option>
                                    <option value="order">Thống kê đơn hàng</option>
                                </select>
                            </div>

                            <div class="form-group row col-md-8 col-12 mx-auto" id="content_type_date" style="display:none">
                                <p>Chọn ngày cụ thể</p>
                                <div class="input-daterange input-group" id="kt_datepicker_5">
                                    <input type="date" class="form-control" name="time_start" value="{{date('Y-m-d', strtotime('-1 years')) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="time_end" value="{{ date('Y-m-d') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </div>
                                   <p>
                                    <span class="form-text text-error time_start-error"></span>
                                   </p>
                                </div>
                            </div>
                           
                        </div>
                        <!--end::Body-->

                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </form>
            </div>
            <!--end::Form Input-->

            <!--begin::Import-->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <form id="frmAddPointCompleted" name="frmAddPointCompleted" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="message_process_loading" value="{{ trans('custom.loading') }}" />
                    <div id="inventory_import_preview">

                    </div>
                </form>
                <div class="card card-custom card-stretch">
                    <div class="card-body">
                        <div id="demo_excel" class="col-md-8 mx-auto"></div>
                    </div>
                </div>

            </div>
            <!--end::Import-->
        </div>
    </div>
  
    <!--end::Container-->
</div>
<!--end::Entry-->


@endsection

@section('scripts')
<script>
    $('#type_date').on('change', function(){
        if($(this).val()=='0'){
            $('#content_type_date').show();
        }else{
            $('#content_type_date').hide();
        }
    })
</script>
<script src="/js/pages/product.js"></script>
@endsection
