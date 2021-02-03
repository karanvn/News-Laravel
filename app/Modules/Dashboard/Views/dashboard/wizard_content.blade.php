<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::List Widget 10-->
                <div class="">
                    <!--begin::Header-->
                    <div class="card-headers border-0">
                        <span class="card-title font-weight-bolder text-dark">
                            <form action="{{route("excelRevenueStatis")}}" method="POST">
                                @csrf
        
                                @if(count($dates)==1)
                                    <input type="hidden" name="dates" value="Thống kê cho ngày {{$dates[0]}}">
                                @else
                                    <input type="hidden" name="dates" value="Thống kê từ {{$dates[0]}} đến {{$dates[count($dates)-1]}}">
                                @endif
        
                                @if(!empty($categories))
                                    @foreach($categories as $key => $value)
                                        <input type="hidden" name="categories[]" value="{{$value}}">
                                        <input type="hidden" name="values[]" value="{{!empty($values[$key]) ? $values[$key] : 0}}">
        <input type="hidden" name="orders[]" value="{{!empty($orders[$key]) ? $orders[$key] : 0}}">
                                    @endforeach
                                @endif
        
        
                               
                            <h5 style="display: inline-block;"><strong>{{ trans('Dashboard::dashboard.revenue') }}</strong></h5>
                           
                            / <button type="submit" class="bg-transparent border-0 text-success">Xuất thống kê Excel</button>
                        </form>
                        </span>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-bodys mt-4">
                        <div id="wedget-chart-step-{{ $step }}"></div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::List Widget 10-->
                <div class="">
                    <!--begin::Header-->
                    <div class="card-headers border-0">
                        <span class="card-title font-weight-bolder text-dark">
                            <h5><strong>{{ trans('Dashboard::dashboard.best_sell_product') }}</strong></h5>
                        </span>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-bodys mt-4">
                        

                        @if(!empty($products))
                   

                        @foreach($products as $product)
                            @php
                            $image = @$product->images()->orderBy('position', 'asc')->first();
                            $image_path = config('product.image.product.thumb_path');
                            $image_path = $image_path . (!empty($product->parent_product_id) ? $product->parent_product_id : $product->product_id );
                            @endphp
                            <div class="col-lg-12 mt-2">
                                <!--begin::Top-->
                                <div class="card row" style="padding: 8px; background: #F3F6F9">
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
                                                    <a target="_blank" class="text-hover-success" href="{{ route('ProductEdit', [$product->product_id]) }}"><span class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-0">{{ Str::limit(fm_zeros($product->product_id) . ' - ' . $product->short_name, 80, '...') }}</span></a>
                                                    <span class="text-primary">
                                                        Đã bán {{ $product->total }} sản phẩm
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
                           
                        @else
                        Không có dữ liệu
                        @endif

                     
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
</div>
