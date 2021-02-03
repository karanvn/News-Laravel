@extends('home.main')
@section('title')
{{ trans('Auth::customer.breadcrumb.'.\Route::current()->getName()) }}
@endsection
@section('content')
{{--  start-Breadcrumb  --}}
@include('Auth::web.pages.breadcrumb')
{{--  end-Breadcrumb  --}}
<main class="site-main  main-container no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="lynessa">
                        {{--  start-Navigation  --}}
                        @include('Auth::web.pages.navigation')
                        {{--  end-Navigation  --}}
                        <div class="lynessa-MyAccount-content">
                            <div class="lynessa-notices-wrapper"></div>
                            <table class="lynessa-orders-table lynessa-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                <thead>
                                <tr>
                                    <th class="lynessa-orders-table__header lynessa-orders-table__header-order-number"><span class="nobr">{{ trans('Auth::customer.add.form.order.order') }}</span></th>
                                    <th class="lynessa-orders-table__header lynessa-orders-table__header-order-date"><span class="nobr">{{ trans('Auth::customer.add.form.order.date') }}</span></th>
                                    <th class="lynessa-orders-table__header lynessa-orders-table__header-order-status"><span class="nobr">{{ trans('Auth::customer.add.form.order.status') }}</span></th>
                                    <th class="lynessa-orders-table__header lynessa-orders-table__header-order-total"><span class="nobr">{{ trans('Auth::customer.add.form.order.total') }}</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders_user as $order)
                                <tr class="lynessa-orders-table__row lynessa-orders-table__row--status-on-hold order">
                                    <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-number" data-title="Order">
                                        <a href="{{ route('order-detail',['order_id'=>$order->order_id]) }}">#ĐCS{{ printf('%06d',$order->order_id) }}</a>
                                    </td>
                                    <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-date" data-title="Date">
                                        <time datetime="2020-01-21T16:35:44+00:00">{{ date_format($order->created_at,'d-m-Y') }}</time>
                                    </td>
                                    <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-status" data-title="Status">
                                        {{ trans('Order::order.statuses.'.$order->status) }}
                                    </td>
                                    <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-total" data-title="Total">
                                        <span class="lynessa-Price-amount amount"><span class="lynessa-Price-currencySymbol"></span>{{ number_format($order->total) }}₫</span> 
                                        {{-- <span style="float:right">{{ count($order->items) }} {{ trans('Auth::customer.add.form.order.item') }}</span> --}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection