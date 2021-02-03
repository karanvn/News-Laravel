@php
    $orders = $user->orders()->orderBy('order_id', 'desc')->get();
@endphp
<input type="hidden" id="customer_id" value="{{ @$user->id }}" />
<div class="row">
    <div class="col-lg-12">
        <!--begin::List Widget 14-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{ trans('Auth::customer.add.form.order.header_list') }} ({{ count($orders) }})</h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-5 row">
                @if(count($orders) > 0)
                    <div class="col-lg-12">
                        <div class="card card-custom mb-8" style="border: 1px solid #eef0f8;border-radius: 8px;margin-bottom: 10px">
                            <div id="pieCustomerOrder" class="d-flex justify-content-center p-4">

                            </div>
                        </div>
                    </div>
                    @foreach($orders as $index => $order)
                    <div class="col-lg-12">
                        @php
                            $user = $order->user()->first();
                        @endphp
                        <div class="card card-custom bg-light-cus mb-8">
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-dark">
                                        <span class="label label-success label-inline mr-2 font-size-h6 font-weight-bold">
                                            <a href="{{ route('OrderEdit', [$order->order_id]) }}" class="text-white text-hover-white">{{ '#ĐH'.fm_zeros($order->order_id, 6) }}</a>
                                        </span>
                                    </span>
                                    <span class="text-muted mt-4 font-weight-bold font-size-sm">
                                        <span class="text-dark font-weight-bold mr-2">
                                            <i class="icon-x text-dark-10 flaticon-calendar-with-a-clock-time-tools"></i> {{ date('d-m-Y H:i', strtotime($order->created_at)) }}
                                        </span>
                                        <span class="mr-2 label label-{{ @get_order_classes()[$order->status] }} label-inline">
                                            <strong>{{ get_order_statuses()[$order->status] }}</strong>
                                        </span>
                                        <span class="label label-inline text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <strong>{{ @get_order_payments()[$order->payment_id] }}</strong>
                                        </span>
                                    </span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="label label-lg label-primary mr-2">{{ $index + 1 }}</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <!--begin::Top-->
                                <div class="d-flex">
                                    <!--begin: Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-0">
                                            <!--begin::User-->
                                            <div class="mr-3">
                                                <!--begin::Contacts-->
                                                <div class="d-flex flex-wrap my-1">
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-1x text-dark-50 flaticon-email-black-circular-button"></i> {{ $order->email }}
                                                    </span>
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-1x text-dark-50 flaticon2-phone"></i> {{ $order->s_phone }}
                                                    </span>
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-1x text-dark-10 flaticon-placeholder-3"></i>
                                                        {{ $order->s_address }}, {{@$order->ward()->get()->first()->name }}, {{ @$order->district()->get()->first()->name }}, {{ @$order->state()->get()->first()->name }}
                                                    </span>

                                                </div>
                                                <div class="d-flex flex-wrap my-1">
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-x far fa-money-bill-alt"></i> {{ trans('Order::order.list.header_total_money') }}: <strong>{{ number_format($order->subtotal) }}đ</strong>
                                                    </span>
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-x far fa-money-bill-alt"></i> {{ trans('Order::order.list.header_total_payment') }}: <strong>{{ number_format($order->total) }}đ</strong>
                                                    </span>
                                                </div>
                                                @if(!empty($order->notes))
                                                <div class="d-flex flex-wrap my-1">
                                                    <span class="text-dark font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-1x text-dark-50 flaticon-notes"></i> {{ $order->notes }}
                                                    </span>
                                                </div>
                                                @endif
                                                <!--end::Contacts-->
                                            </div>
                                            <!--begin::User-->
                                        </div>
                                        <!--end::Title-->
                                        <div class="separator separator-solid my-2"></div>
                                        <!--begin::Content-->
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <!--begin::Description-->
                                            @foreach($order->items()->get() as $item)
                                            @php
                                                $product = $item->product()->first();
                                                $image = $product->images()->orderBy('position', 'asc')->first();
                                                $image_path = config('product.image.product.thumb_path');
                                                $image_path = $image_path . (!empty($product->parent_product_id) ? $product->parent_product_id : $product->product_id );
                                            @endphp
                                            <div class="col-lg-12 mt-2">
                                                <!--begin::Top-->
                                                <div class="card row p-4">
                                                    <div class="d-flex">
                                                        <!--begin::Pic-->
                                                        <div class="flex-shrink-0 mr-0">
                                                            <div class="symbol symbol-45 symbol-lg-45 symbol-2by3 flex-shrink-0 mr-4">
                                                                <div class="symbol-label" style="background-image: url({{ show_banner($image_path, @$image->image_path) }})"></div>
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
                                                                    <a target="_blank" class="text-hover-success" href="{{ route('ProductEdit', [$product->product_id]) }}"><span class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-0">{{ Str::limit(fm_zeros($product->product_id, 6).' - '.$product->short_name, 70, '...') }}</span></a>
                                                                    <span class="text-danger">
                                                                        {{ number_format($product->sell_price) }}đ x {{ $item->amount }} /
                                                                        {{ trans('Order::order.list.header_success') }}: {{ $item->amount_success }}
                                                                    </span>
                                                                    <!--end::Name-->
                                                                </div>
                                                                <!--begin::User-->
                                                            </div>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Top-->
                                            </div>
                                            @endforeach
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Top-->
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
