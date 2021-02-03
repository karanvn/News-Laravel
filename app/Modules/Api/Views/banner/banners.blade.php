<div class="col-lg-12" id="box_banners">
    <!--begin::List Widget 10-->
    <div class="card card-custom card-stretchs gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-danger"><span class="label label-lg label-danger mr-2">1</span>{{ trans('Api::api.banner.banners.header') }}</h3>
            <div class="card-toolbar">
                <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_banners">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title collapse text-hover-dark text-danger" data-toggle="collapse" data-target="#collapse_banners" aria-expanded="false">
                                {{ trans('Api::api.banner.view_detail') }} &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <div class="separator separator-solid"></div>
        <!--begin::Body-->
        <div class="card-bodys pt-5">
            <div class="col-lg-12 collapse show" id="collapse_banners" data-parent="#accordion_banners">
                <div class="p-4">
                    <div class="bg-light-cus rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2 font-size-h6">
                            <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.input') }}</span>
                        </div>
                        <div class="bg-light-white rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.url') }}:</span>
                                <span class="text order-subtotal">{{ url('') . trans('Api::api.banner.banners.url') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.method') }}:</span>
                                <span class="text">{{ trans('Api::api.banner.banners.method') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.params') }}:</span>
                                @php
                                    $params = trans('Api::api.banner.banners.params');
                                @endphp
                                <span class="text">
                                    <ul class="navi navi-hover">
                                        @foreach($params as $key => $value)
                                        <li class="">
                                            <span>+ {{ $key.': '.$value }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom card-stretchs gutter-b mt-8 bg-light-cus rounded">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-primary">{{ trans('Api::api.banner.banners.exp.header') }}</h3>
                            <div class="card-toolbar">
                                <button type="button"  class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base btn-filter-banners"> {{ trans('Api::api.common.submit') }}</button>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-bodys">
                            <div class="col-lg-12 collapsed">
                                <div class="p-4">
                                    <div class="row bg-light-white rounded">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><strong>{{ trans('Api::api.banner.banners.exp.type') }}</strong></label>
                                                <select class="form-control custom-select banner_type" >
                                                    @foreach( trans('Api::api.banner.types') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>

                    <div class="bg-light-cus rounded p-4 mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-2 mt-4 font-size-h6">
                            <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.output') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between font-size-h6">
                            <div class="col-lg-12 response-banners bg-light-white rounded">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
