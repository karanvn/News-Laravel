<div class="col-lg-12" id="box_user">
    <!--begin::List Widget 10-->
    <div class="card card-custom card-stretchs gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-danger"><span class="label label-lg label-danger mr-2">3</span>{{ trans('Api::api.user.user.header') }}</h3>
            <div class="card-toolbar">
                <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_user">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title collapse text-hover-dark text-danger" data-toggle="collapse" data-target="#collapse_user" aria-expanded="false">
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
            <div class="col-lg-12 collapse show" id="collapse_user" data-parent="#accordion_user">
                <div class="p-4">
                    <div class="bg-light-cus rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2 font-size-h6">
                            <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.input') }}</span>
                        </div>
                        <div class="bg-light-white rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.url') }}:</span>
                                <span class="text order-subtotal">{{ url('') . trans('Api::api.user.user.url') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.method') }}:</span>
                                <span class="text">{{ trans('Api::api.user.user.method') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.params') }}:</span>
                                @php
                                    $params = trans('Api::api.user.user.params');
                                @endphp
                                <span class="text">{{ implode(', ', $params) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom card-stretchs gutter-b mt-8 bg-light-cus rounded">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-primary">{{ trans('Api::api.user.add_user.exp.header') }}</h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-bodys">
                            <div class="col-lg-12 collapsed">
                                <div class="p-4">
                                    <div class="form-group row bg-light-white rounded">
                                        <select class="form-control select2" id="user_selected_customer" data-select2-id="user_selected_customer" tabindex="-1" aria-hidden="true">

                                        </select>
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
                            <div class="col-lg-12 json_response_user bg-light-white rounded">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
