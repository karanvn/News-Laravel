<div class="col-lg-12" id="box_add_shipping">
    <form id="frmAPIAddShipping" name="frmAPIAddShipping" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
        <!--begin::List Widget 10-->
        <div class="card card-custom card-stretchs gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-danger"><span class="label label-lg label-danger mr-2">4</span>{{ trans('Api::api.user.add_shipping.header') }}</h3>
                <div class="card-toolbar">
                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_add_shipping">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title collapse text-danger text-hover-dark" data-toggle="collapse" data-target="#collapse_add_shipping" aria-expanded="false">
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
                <div class="col-lg-12 collapse show" id="collapse_add_shipping" data-parent="#accordion_add_shipping">
                    <div class="p-4">
                        <div class="bg-light-cus rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4 mt-2 font-size-h6">
                                <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.input') }}</span>
                            </div>
                            <div class="bg-light-white rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                    <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.url') }}:</span>
                                    <span class="text order-subtotal">{{ url('') . trans('Api::api.user.add_shipping.url') }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                    <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.method') }}:</span>
                                    <span class="text">{{ trans('Api::api.user.add_shipping.method') }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                    <span class="font-weight-bolder mr-2 "><i class="icon-x la la-plus"></i> {{ trans('Api::api.common.params') }}:</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-0 font-size-h6">
                                    @php
                                        $params = trans('Api::api.user.add_shipping.params');
                                    @endphp
                                    <span class="text params-add-shipping" rel="{{ json_encode($params) }}"></span>
                                </div>
                            </div>
                        </div>


                        <div class="card card-custom card-stretchs gutter-b mt-8 bg-light-cus rounded">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-primary">{{ trans('Api::api.user.add_shipping.exp.header') }}</h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-bodys">
                                <div class="col-lg-12 collapsed">
                                    <div class="p-4 row">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <select class="form-control select2" id="shipping_selected_customer" data-select2-id="shipping_selected_customer" tabindex="-1" aria-hidden="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <select class="form-control custom-select select2" id="seState" name="state_id" selected-id="{{ @$filters['state_id'] }}">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <select class="form-control custom-select select2" id="seDistrict" name="district_id" selected-id="{{ @$filters['district_id'] }}">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <select class="form-control custom-select select2" id="seWard" name="ward_id" selected-id="{{ @$filters['ward_id'] }}">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center mb-5">
                                            <button type="button"  class="btn btn-danger font-weight-bold btn-sm px-3 font-size-base btn-get-params-shipping"> {{ trans('Api::api.common.get_data') }}</button>
                                            <button type="button"  class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base btn-add-shipping"> {{ trans('Api::api.common.submit') }}</button>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <textarea class="form-control api_params area-add-shipping" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>

                        <div class="bg-light-cus rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4 mt-2 font-size-h6">
                                <span class="font-weight-bolder mr-2 text-primary"><i class="icon-x text-dark-50 flaticon2-soft-icons"></i> {{ trans('Api::api.common.output') }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between font-size-h6">
                                <div class="col-lg-12 bg-light-white rounded response-add-shipping">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </form>
</div>
