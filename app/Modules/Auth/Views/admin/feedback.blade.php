@extends('admin.main')


@section('title')
{{ trans('Auth::admin.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-users-1"></i><a href="{{ route('Admin') }}" class="text-dark text-hover-success"> DANH SÁCH PHẢN HỒI TỪ NGƯỜI DÙNG</a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            {{-- <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ number_format($users->total()) }} {{ trans('Auth::admin.list.header_total') }}</span>
            </div> --}}
            <!--end::Search Form-->
        </div>
        <!--end::Details-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <div class="row">

            <div class="col-lg-12">
                <form id="frmFilterAdminUser" name="frmFilterAdminUser" class="form-horizontal" role="form">
                    <!--begin::List Widget 10-->
                    <div class="card card-custom card-stretchs gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">
                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Auth::admin.list.filter.btn') }}</button>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Auth::admin.list.filter.id') }}</strong></label>
                                        <input type="text" name="id" value="{{ @$filters['id'] }}" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Auth::admin.list.filter.name') }}</strong></label>
                                        <input type="text" name="name" value="{{ @$filters['name'] }}" class="form-control" placeholder="">
                                    </div>
                                </div> --}}

                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Auth::admin.list.filter.email') }}</strong></label>
                                        <input type="text" name="email" value="{{ @$filters['email'] }}" class="form-control" placeholder="">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Auth::admin.list.filter.status') }}</strong></label>
                                        <select class="form-control custom-select"  name="status" >
                                            <option value="0">{{ trans('Auth::admin.list.filter.se_status') }}</option>
                                            @foreach(get_user_statuses() as $key => $value)
                                            <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!--end::Body-->
                        @if ($feedbacks->hasPages())
                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                {!! $feedbacks->links('Product::product.paginate', ['paginator' => $feedbacks, 'filter' => $filter]) !!}
                            </div>
                            <!--end:: Pagination-->
                        </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    @if (!empty($feedbacks))
                        @foreach($feedbacks as $item)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <div class="card card-custom gutter-b card-stretch">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-end">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column">
                                                <span>{{$item->content}}</span>
                                                <span class="text-muted font-weight-bold">{{ $item->email }}</span>
                                                <span class="text-muted font-weight-bold">{{ $item->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <span>Dữ liệu đang trống!</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
