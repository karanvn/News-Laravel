@extends('home.main')
@section('title')
{{ trans('Auth::customer.breadcrumb.'.\Route::current()->getName()) }}
@endsection
<style>
    .add_color{
        background: #e7bfbf;
    }
</style>
@section('content')
{{--  start-Breadcrumb  --}}
@include('Auth::web.pages.breadcrumb')
{{--  end-Breadcrumb  --}}
<main class="site-main  main-container no-sidebar">
    <div class="container">
        @php
            // dd($order->status);
        @endphp
        <div class="row">
            <div class="main-content col-md-12">
           
                <div class="page-main-content">
                    <div class="lynessa">
                        {{--  start-Navigation  --}}
                        @include('Auth::web.pages.navigation')
                        {{--  end-Navigation  --}}
                        <section class="invoice-template">
                            <form action="{{route('CustomerCancelOrder')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_order" value="{{@$order->order_id}}">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div id="invoice-template" class="card-block">
                                        <!-- Invoice Company Details -->
                                        <div id="invoice-company-details" class="row">
                                            <div class="col-6 text-left">
                                                <img src="{{ asset('/Logo/logo.png') }}" alt="company logo" class="mb-2" width="70">
                                                <ul class="px-0 list-unstyled">
                                                    <li>200 Bàu cát,</li>
                                                    <li>Phường 11,</li>
                                                    <li>Tân Bình,</li>
                                                    <li>TP.HCM</li>
                                                </ul>
                                            </div>
                                            <div class="col-6 text-right">
                                                <h2>{{ trans('Order::order.list.header_invoice') }}</h2>
                                                <p class="pb-3">#ĐCS{{ printf('%06d',$order->order_id) }}</p>
                                                <ul class="px-0 list-unstyled">
                                                    <li>{{ trans('Order::order.add.header_total') }}</li>
                                                    <li class="lead text-bold-800">{{ number_format($order->total) }}₫</li>
                                                </ul>
                                                <ul class="px-0 list-unstyled">
                                                    <li>{{ trans('Order::order.payments.title') }}: {{$order->payment_id == 1 ? 'COD' : 'ATM'}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ Invoice Company Details -->
                                        <!-- Invoice Customer Details -->
                                        <div id="invoice-customer-details" class="row pt-2">
                                            <div class="col-sm-12 text-left">
                                                <p class="text-muted">{{ trans('Order::order.add.header_shipping') }}</p>
                                            </div>
                                            <div class="col-6 text-left">
                                                <ul class="px-0 list-unstyled">
                                                    <li class="text-bold-800">{{ $order->s_name }}</li>
                                                    <li>{{ $order->s_phone }},</li>
                                                    <li>{{ $order->email }},</li>
                                                   
                                                    <li>{{ @$order->s_address }},</li>
                                                    <li>{{ @$order->ward->name }},</li>
                                                    <li>{{ @$order->district->name }}, </li>
                                                    <li>{{ @$order->state->name }}.</li>
                                                </ul>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="py-0 my-0"><span class="text-muted">{{ trans('Order::order.list.filter.created_at') }} :</span> {{ date_format($order->created_at,'d-m-Y H:i:s') }}</p>
                                                <p class="py-0 my-0"><span class="text-muted">{{ trans('Order::order.list.filter.status') }} :</span> {{ trans('Order::order.statuses.'.$order->status) }}</p>
                                            </div>
                                        </div>
                                        <!--/ Invoice Customer Details -->
                                        <!-- Invoice Items Details -->
                                        <div id="invoice-items-details" class="pt-2">
                                            <div class="row">
                                                <div class="table-responsive col-sm-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>{{ trans('Order::order.list.filter.product') }} &amp; {{ trans('Order::order.list.filter.product_id') }}</th>
                                                                <th class="text-right">{{ trans('Order::order.list.filter.sell_price') }}</th>
                                                                <th class="text-right">{{ trans('Order::order.list.filter.qty') }}</th>
                                                                <th class="text-right">{{ trans('Order::order.add.form.amount') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $stt = 1; @endphp
                                                            @foreach($order->items as $item)
                                                            {{-- @php
                                                                dd($order->combo_id);
                                                            @endphp --}}
                                                            
                                                            <tr class="@if($order->combo_id) add_color @endif">
                                                                <th scope="row">{{$stt++}}</th>
                                                                <td>
                                                                    {{ $item->product->name }} - {{ $item->product->product_id }}
                                                                </td>
                                                                <td class="text-right">{{ number_format(round($item->price)) }}₫</td>
                                                                <td class="text-right">{{ $item->amount }}</td>
                                                                <td class="text-right">{{ number_format($item->price*$item->amount) }}₫</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 "></div>
                                                <div class="col-md-6 col-sm-12 text-right">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ trans('Order::order.add.form.lastotal') }}</td>
                                                                    <td class="text-right">{{ number_format($order->subtotal) }}₫</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ trans('Order::order.add.form.discountcode') }}</td>
                                                                    <td class="text-right">(-){{ number_format(trim($order->discount,'VND')?trim($order->discount,'VND'):0) }}₫</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ trans('Order::order.add.form.discountmember') }}</td>
                                                                    <td class="text-right">(-){{ number_format(trim($order->discountmember,'VND')?trim($order->discountmember,'VND'):0) }}₫</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ trans('Order::order.add.form.shipping') }}</td>
                                                                    <td class="text-right">(+){{ number_format(trim($order->shipping,'VND')?trim($order->shipping,'VND'):0) }}₫</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold-800">Tổng tiền</td>
                                                                    <td class="text-bold-800 text-right"> {{ number_format($order->total) }}₫</td>
                                                                </tr>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p class="px-3">Ghi chú: 
                                                    {{@$order->cs_notes}}
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- @if ($order->status != "CAN")
                            <div class="text-right mt-3"><input type="submit" id="btn_cancel" value="Hủy đơn hàng"></div>
                            @endif     --}}
                        </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $('#btn_cancel').click(function(){
        $(".animationloadpage").show();
    });
</script>
@endsection