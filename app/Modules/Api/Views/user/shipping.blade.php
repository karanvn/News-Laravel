<div class="col-lg-12" id="box_shippings">
    <!--begin::List Widget 10-->
    <div class="card card-custom card-stretchs gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">{{ trans('Api::api.user.shippings.header') }}</h3>
            <div class="card-toolbar">
                <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_shippings">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title collapse text-hover-primary" data-toggle="collapse" data-target="#collapse_shippings" aria-expanded="false">
                                {{ trans('Api::api.user.view_detail') }} &nbsp;&nbsp;&nbsp;&nbsp;
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
            <div class="col-lg-12 collapse show" id="collapse_shippings" data-parent="#accordion_shippings">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2 font-size-h6">
                        <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.input') }}</span>
                    </div>
                    <div class="bg-light-dark rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                            <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.url') }}:</span>
                            <span class="text order-subtotal">{{ url('') . trans('Api::api.user.shippings.url') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                            <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.method') }}:</span>
                            <span class="text">{{ trans('Api::api.user.shippings.method') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                            <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.params') }}:</span>
                            @php
                                $params = trans('Api::api.user.shippings.params');
                            @endphp
                            <span class="text">{{ implode(', ', $params) }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2 mt-4 font-size-h6">
                        <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.output') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between ml-4 mt-2 font-size-h6">
                        <span class="font-weight-bolder text-success">{{ trans('Api::api.common.success') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between font-size-h6">
                        <div class="col-lg-12 json_success_shippings">

                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between ml-4 mt-2 font-size-h6">
                        <span class="font-weight-bolder text-danger">{{ trans('Api::api.common.error') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between font-size-h6">
                        <div class="col-lg-12 json_error_shippings">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
