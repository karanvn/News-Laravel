<div class="row">
    <div class="col-lg-12 col-xxl-12">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="font-weight-bolder text-dark">Lịch sử điểm</span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->
            <div class="separator separator-solid"></div>
            <!--begin::Body-->
            <div class="card-body pt-4">
                <div class="timeline timeline-3">
                    <div class="timeline-items">
                      @php $hirotypoints = $user->historypoint()->get(); @endphp

                      @if(count($hirotypoints)>0)
                      <table class="table">
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
                            @foreach($hirotypoints as $point)
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

                      
                   
                      @endif
                    </div>
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 9-->
    </div>

</div>
