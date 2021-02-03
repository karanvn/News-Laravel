@extends('admin.main')


@section('title')
{{ trans('Auth::customer.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-users-1"></i><a href="{{ route('Customer') }}" class="text-dark text-hover-success"> {{ trans('Auth::customer.list.header_title') }}</a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ number_format($users->total()) }} {{ trans('Auth::customer.list.header_total') }}</span>
            </div>
            <!--end::Search Form-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('CustomerAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Auth::customer.list.header_add_btn') }}</a>
            <!--end::Button-->
            <!--begin::Dropdown-->

            <!--end::Dropdown-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <div class="row">
            <!--begin::Filter-->
            <div class="col-lg-12">
                <form id="frmFilterCustomerUser" name="frmFilterCustomerUser" class="form-horizontal" role="form">
                <!--begin::List Widget 10-->
                <div class="card card-custom card-stretchs gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">
                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Auth::customer.list.filter.btn') }}</button>
                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Auth::customer.list.filter.id') }}</strong></label>
                                    <input type="text" name="id" value="{{ @$filters['id'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Auth::customer.list.filter.name') }}</strong></label>
                                    <input type="text" name="name" value="{{ @$filters['name'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Auth::customer.list.filter.email') }}</strong></label>
                                    <input type="text" name="email" value="{{ @$filters['email'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Auth::customer.list.filter.status') }}</strong></label>
                                    <select class="form-control custom-select"  name="status" >
                                        <option value="0">{{ trans('Auth::customer.list.filter.se_status') }}</option>
                                        @foreach(get_user_statuses() as $key => $value)
                                        <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>Điểm từ</strong></label>
                                    <input type="number" min="0" max="100" name="point" class="form-control custom-select">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>Ngày sinh</strong></label>
                                    <input type="date" name="bod" class="form-control custom-select">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>Số đơn hàng</strong></label>
                                    <input type="number" name="count_order" class="form-control custom-select">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                    @if ($users->hasPages())
                    <div class="separator separator-solid"></div>
                    <div class="card-body">
                        <!--begin::Pagination-->
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            {!! $users->links('Product::product.paginate', ['paginator' => $users, 'filter' => $filter]) !!}
                        </div>
                        <!--end:: Pagination-->
                    </div>
                    @endif
                </div>
                </form>
            </div>
            <!--end::Filter-->

            <!--begin::Card-->
            <div class="col-lg-12">
                <div class="row">
                    @foreach($users as $user)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b card-stretch">
                            <!--begin::Body-->
                            <div class="card-body p-4">
                                {{--
                                <div class="d-flex justify-content-end">
                                    <span class="label label-{{ $user->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_user_statuses()[$user->status] }}</span>
                                </div>
                                --}}
                                <!--begin::User-->
                                <div class="d-flex align-items-end mb-0">
                                    <!--begin::Pic-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Pic-->
                                        <div class="flex-shrink-0 mr-4 mt-lg-0 mt-4">
                                            <div class="symbol symbol-circle symbol-lg-75">
                                                @if(!empty($user->avatar))
                                                <img src="{{  show_image(config('auth_.image.customer_thumb_path'), $user->avatar) }}" alt="image">
                                                @else
                                                <span class="symbol-label font-size-h4 font-weight-bold pl-0 pr-0 font-weight-bolder">
                                                    {{ mb_substr($user->name, 0, 1) }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                                <span class="font-size-h3 font-weight-boldest">JM</span>
                                            </div>
                                        </div>
                                        <!--end::Pic-->
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('CustomerEdit', [$user->id, 'general']) }}" class="text-dark font-weight-bolder text-hover-primary font-size-h4 mb-0"><span class="text-{{ $user->status == 'A' ? 'success' : 'danger' }}">{{ $user->name }}</span></a>
                                            <span class="text-muted font-weight-bold">{{ $user->email }}</span>
                                            @php
                                                $orders = @$user->orders();
                                                $order = @$orders->orderBy('order_id', 'desc')->first();
                                            @endphp
                                            @if($orders && $order)
                                            <span class="text-primary font-weight-bold"><i class="icon-1x text-dark-50 flaticon2-shopping-cart"></i> {{ @$orders->count() }} / <a href="{{ route('OrderEdit', [@$order->order_id]) }}">{{ '#ĐH.'. fm_zeros(@$order->order_id, 6) }}</a></span>
                                            @endif
                                           <span class="text-danger font-weight-bold">
                                            {{!empty($user->point) ? $user->point : '0' }} điểm 
                                           </span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    @endforeach
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
