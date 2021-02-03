@php
    $shippings = $user->shippings()->orderBy('position', 'asc')->get();
@endphp
<div class="row">
    <div class="col-lg-12">
        <!--begin::List Widget 14-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Auth::customer.add.form.shipping.header_list') }}</h3>
                <div class="card-toolbar">
                    <select class="form-control custom-select" id="change_user_shipping" name="shipping_id">
                        <option value="list" >{{ trans('Auth::customer.add.form.shipping.action_list') }}</option>
                        <option value="0" >{{ trans('Auth::customer.add.form.shipping.action_ad_new') }}</option>
                        @if(count($shippings) > 0)
                            @foreach($shippings as $ship)
                                <option value="{{ $ship->id }}" >{{ Str::limit($ship->name, 35, '...') }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5 row">
                @if(count($shippings) > 0)
                    @foreach($shippings as $shipping)
                    <div class="col-lg-12">
                        <div class="card card-custom mb-6 bg-light-cus" >
                            <div class="card-body">
                                <!--begin::Top-->
                            <div class="d-flex">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-0">
                                    <div class="symbol symbol-50 symbol-lg-50 symbol-2by3 flex-shrink-0 mr-4">
                                        <i class="icon-2x text-dark-50 flaticon-truck"></i>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin: Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-0">
                                        <!--begin::User-->
                                        <div class="mr-3">
                                            <!--begin::Name-->
                                            <span class="d-flex align-items-center text-primary text-hover-primary font-size-h5 font-weight-bold mr-0">
                                                {{ Str::limit($shipping->name, 100, '...') }}
                                            </span>
                                            <!--end::Name-->
                                            <!--begin::Contacts-->
                                            <div class="d-flex flex-wrap my-0">
                                                <span class="text-dark text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                    <i class="icon-1x text-dark-10 flaticon2-phone"></i> {{ $shipping->phone }}
                                                </span>
                                                <span class="text-dark text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                    <span class="label label-{{ $shipping->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_user_statuses()[$shipping->status] }}</span>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-wrap my-0">
                                                <span class="text-dark text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                    <i class="icon-1x text-dark-10 flaticon2-location"></i> {{ $shipping->address }},
                                                    {{ @$shipping->ward()->get()->first()->name }}, {{ @$shipping->district()->get()->first()->name }}, {{ @$shipping->state()->get()->first()->name }}
                                                </span>
                                            </div>
                                            <!--end::Contacts-->
                                        </div>
                                        <!--begin::User-->
                                        <!--begin::Actions-->
                                        <div class="my-lg-0 my-0">

                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Content-->
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <!--begin::Description-->
                                        <div class="flex-grow-1 font-weight-bold py-2 py-lg-2 mr-5">

                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Bottom-->
                            <div class="d-flex align-items-center flex-wrap">

                            </div>
                            <!--end::Bottom-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 14-->
    </div>
</div>
