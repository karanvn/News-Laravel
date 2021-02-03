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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">IMPORT EXCEL SHIPPING</h5>
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
            <a href="/admins/location/downloadDemoExcel/states" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base mr-1">Tải bản mẫu Tỉnh</a>
            <a href="/admins/location/downloadDemoExcel/districts" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base mr-1">Tải bản mẫu Huyện</a>
            <a href="/admins/location/downloadDemoExcel/wards" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base mr-1">Tải bản mẫu Xã</a>
            <div class="btn-group ml-2">
                
                <button type="submit" form="frmPreviewExcelShip" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base">Xem trước</button>
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
                <form id="frmPreviewExcelShip" name="frmPreviewExcelShip" method="post" class="form-horizontal"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Form-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-right">File EXCEL<span class="label-text-error">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file_excel" accept=".xls, .xlsx" />
                                        <label class="custom-file-label" >Import excel</label>
                                    </div>
                                    <span class="form-text text-error file_excel-error"></span>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Loại inport<span class="label-text-error">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <select name="type" class="form-control">
                                        <option value="states">Tỉnh/Thành</option>
                                        <option value="districts">Quận/Huyện</option>
                                        <option value="wards">Phường/Xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ trans('Auth::customer.point.excel.demo') }}</label>
                                <div class="col-lg-9 col-xl-6">
                                    <table id="customers" border="1" width="100%">
                                        <tbody>
                                        <tr>
                                          <td width="10%"></td>
                                          <td align="center" width="10%"><strong>A</strong></td>
                                          <td align="center" width="20%"><strong>B</strong></td>
                                        </tr>
                                        <tr>
                                          <td align="center">1</td>
                                          <td align="center">Id</td>
                                          <td align="center">Ship</td>
                                        </tr>
                                        <tr>
                                          <td align="center">2</td>
                                          <td align="right">1</td>
                                          <td align="right">10000</td>
                                        </tr>
                                        <tr>
                                            <td align="center">3</td>
                                            <td align="right">2</td>
                                            <td align="right">20000</td>
                                          </tr>
                                      </tbody></table>
                                     
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
                <form id="frmAddShipCompleted" name="frmAddShipCompleted" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="message_process_loading" value="{{ trans('custom.loading') }}" />
                    <div id="inventory_import_preview">

                    </div>
                </form>
            </div>
            <!--end::Import-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


@endsection

@section('scripts')
<script src="js/pages/product.js"></script>
@endsection
