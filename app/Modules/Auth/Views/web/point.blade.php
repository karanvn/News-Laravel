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
                            <!-- start Form Edit Info -->
                         
                            
                                <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                    <label>{{ trans('Auth::customer.point.title') }} <b>{{!empty($user->point) ? $user->point : 0 }} {{ trans('Auth::customer.point.unit') }}</b></label>
                                </p>
                                <!--show lisst -->
                                @if(count($points)>0)
                                <div class="lynessa-MyAccount-content">
                                    <div class="lynessa-notices-wrapper"></div>
                                    <table class="lynessa-orders-table lynessa-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                        <thead>
                                        <tr>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-number"><span class="nobr">{{ trans('Auth::customer.point.stt') }}</span></th>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-date"><span class="nobr">{{ trans('Auth::customer.point.date') }}</span></th>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-date"><span class="nobr">Loại</span></th>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-status"><span class="nobr">{{ trans('Auth::customer.point.order') }}</span></th>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-total"><span class="nobr">Điểm</span></th>
                                            <th class="lynessa-orders-table__header lynessa-orders-table__header-order-total"><span class="nobr">Note</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $stt = 1; @endphp
                                            @foreach($points as $point)
                                            <tr class="lynessa-orders-table__row lynessa-orders-table__row--status-on-hold order">
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-number" data-title="Order">
                                                   {{$stt++}}
                                                </td>
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-date" data-title="Date">
                                                    <time datetime="2020-01-21T16:35:44+00:00">{{ date_format($point->created_at,'d-m-Y') }}</time>
                                                </td>
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-date" data-title="Date">
                                                   
                                                   @if(!empty($point->type))
                                                   @if($point->type=='O')
                                                   Đơn hàng
                                                    @else
                                                        Sinh nhật
                                                    @endif
                                                   @endif
                                                    
                                                </td>
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-status" data-title="Status">
                                                    @if(@$point->type=='O')
                                                    <a href="{{ route('order-detail',['order_id'=>$point->order_id]) }}">#ĐCS{{ printf('%06d',$point->order_id) }}</a>
                                                    @endif
                                                </td>
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-total" data-title="Total">
                                                    <span class="lynessa-Price-amount amount"><span class="lynessa-Price-currencySymbol"></span>{{$point->point}}</span> 
                                                    
                                                </td>
                                                <td class="lynessa-orders-table__cell lynessa-orders-table__cell-order-date" data-title="Date">
                                                    {{ @$point->note }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="col-12 text-danger">{{ trans('Auth::customer.point.nonelist') }}</span></div>
                                @endif
                               
                            <!-- end Form Edit Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection