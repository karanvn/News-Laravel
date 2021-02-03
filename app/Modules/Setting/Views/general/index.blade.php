@extends('admin.main')
@section('title')
{{ trans('Setting::setting.title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<form id="frmAddSetting" name="frmAddSetting" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-50 flaticon-settings-1"></i> {{ trans('Setting::setting.header') }}</h5>
                <!--end::Title-->
                <!--begin::Separator-->

                <!--end::Separator-->
                <!--begin::Search Form-->

                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Dropdown-->
                <div class="btn-group ml-2">
                    <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i>{{ trans('Setting::setting.header_btn_save') }}</button>
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
            <div class="d-flex flex-row">
                <div class="flex-row-fluid">
                    <div class="row">

                        <!--begin::SHOP-->
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">{{ trans('Setting::setting.shop.header') }}</h3>
                                    <div class="card-toolbar">

                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                        <div class="col-lg-12 mb-6">
                                            <div class="cards card-custom bg-light-wh">  
                                                <div class="card-body">
                                                    <div class="row">
                                                        <span><i class="icon-x text-dark-50 flaticon-notes"></i> {{ trans('Setting::setting.shop.note_info') }}</span><br/>
                                                        <span><i class="icon-x text-dark-50 flaticon-notes"></i> {{ trans('Setting::setting.shop.note_address') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="cards card-custom card-stretch bg-light-wh"> 
                                                    <div class="card-body">
                                                        <div class="col-lg-12">
                                                            @include('Setting::general.shop')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cards card-custom card-stretch bg-light-wh"> 
                                                    <div class="card-body">
                                                        <div class="col-lg-12">
                                                            @include('Setting::general.seo')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        <!--end::SHOP-->

                        <!--begin::SOCIAL-->
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">SOCIAL</h3>
                                    <div class="card-toolbar">
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="cards card-custom card-stretch bg-light-wh"> 
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        @include('Setting::general.social')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        <!--end::SOCIAL-->
                        
                        <!--begin::LINK CODE-->
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">LINK CODE</h3>
                                    <div class="card-toolbar">
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="cards card-custom card-stretch bg-light-wh"> 
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        @include('Setting::general.link_code')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        <!--end::LINK CODE-->

                        <!--begin::POLICY-->
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">Chính sách</h3>
                                    <div class="card-toolbar">
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                        @if (!empty($generals['POLICY']))
                                        <div class="col-lg-6 mb-6">
                                            @for ($i = 0; $i < count($generals['POLICY']['name']); $i++)
                                            <div class="cards card-custom bg-light-wh @if($i != 0) mt-5 @endif">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">{{$generals['POLICY']['icon'][$i]}}</div>
                                                        <div class="col-md-12 text-center">{{$generals['POLICY']['name'][$i]}}</div>
                                                        <div class="col-md-12 text-center">{{$generals['POLICY']['desc'][$i]}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                        </div>
                                        @endif
                                        <div class="col-lg-6">
                                            @include('Setting::general.policy')
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        <!--end::POLICY-->
                        {{-- con số --}}
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">Con số ấn tượng</h3>
                                    <div class="card-toolbar">
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                    
                                        <div class="col-lg-12">
                                            @include('Setting::general.counthot')
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        {{-- end con số --}}
                        <div class="col-lg-12">
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">Chuyên môn</h3>
                                    <div class="card-toolbar">
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="separator separator-solid"></div>
                                <!--begin::Body-->
                                <div class="card-body mt-2">
                                    <div class="row">
                                    
                                        <div class="col-lg-12">
                                            @include('Setting::general.Expertise')
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        
                     {{--  các loại giá prodject --}}
                     <div class="col-lg-12">
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Gói dịch vụ</h3>
                                <div class="card-toolbar">
                                </div>
                            </div>
                            <!--end::Header-->
                            <div class="separator separator-solid"></div>
                            <!--begin::Body-->
                            <div class="card-body mt-2">
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                        @include('Setting::general.Pricing')
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                      

                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</form>
@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/location.js"></script>
<script src="js/pages/setting.js"></script>
@endsection
