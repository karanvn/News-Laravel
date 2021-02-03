@extends('admin.main')



@section('title')
{{ trans('Location::ward.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-placeholder-3"></i><a class="text-dark text-hover-success" href="{{ route('Ward') }}"> {{ trans('Location::ward.list.header_title') }}</a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200">
            </div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($wards->total()) }} {{ trans('Location::ward.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('WardAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Location::ward.list.header_add_btn') }}</a>
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
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <form id="frmFilterWard" name="frmFilterWard" class="form-horizontal" role="form">
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">

                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Location::ward.list.filter.btn') }}</button>
                            </div>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="pt-6">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap col-lg-12 col-xl-12 mt-0">
                                    <div class="col-lg-4 col-xl-3 mt-3">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Location::ward.list.filter.state_id') }}</strong></label>
                                            <select class="form-control custom-select select2" id="seState" name="state_id" selected-id="{{ @$filters['state_id'] }}">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3 mt-3">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Location::ward.list.filter.district_id') }}</strong></label>
                                            <select class="form-control custom-select select2" id="seDistrict" name="district_id" selected-id="{{ @$filters['district_id'] }}">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3 mt-3">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Location::ward.list.filter.ward_id') }}</strong></label>
                                            <select class="form-control custom-select select2" id="seWard" name="ward_id" selected-id="{{ @$filters['ward_id'] }}">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3 mt-3">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Location::ward.list.filter.status') }}</strong></label>
                                            <select class="form-control custom-select"  name="status" >
                                                <option value="0">{{ trans('Location::ward.list.filter.se_status') }}</option>
                                                @foreach(get_location_statuses() as $key => $value)
                                                <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($wards->hasPages())
                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                {!! $wards->links('Location::location.paginate', ['paginator' => $wards, 'filter' => $filter]) !!}
                            </div>
                            <!--end:: Pagination-->
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            <!--end::Filter-->

            <!--begin::Card-->
            @foreach($wards as $ward)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-6">
                        {{--
                        <div class="d-flex justify-content-end">
                            <span class="label label-{{ $ward->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_location_statuses()[$ward->status] }}</span>
                        </div>
                        --}}
                        <!--begin::User-->
                        @php
                            $district = $ward->district()->get()->first();
                            $state = @$district->state()->get()->first();
                        @endphp
                        <div class="d-flex align-items-end mb-2">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('WardEdit', [$ward->ward_id]) }}" class="text-dark font-weight-bold text-hover-success font-size-h4 mb-0">
                                        <span class="symbol symbol-30 symbol-light-{{ $ward->status == 'A' ? 'success' : 'danger' }}">
											<span class="symbol-label font-size-h8 font-weight-bold pl-0 pr-0 font-weight-bolder">
                                                {{ mb_substr(get_location_statuses()[$ward->status], 0, 1) }}
                                            </span>
										</span>
                                        {{ $ward->name }}
                                    </a>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->

                        <p class="mb-0">
                            <span class="label label-inline"><a class="text-dark text-hover-success" href="{{ route('District', ['state_id' => @$district->state_id,'district_id' => @$district->district_id]) }}" > {{ @$district->name }} </a>&nbsp<i class="icon-x fas fa-long-arrow-alt-right"></i>&nbsp<a class="text-dark text-hover-success" href="{{ route('State', ['state_id' => @$state->state_id]) }}" > {{ @$state->name }}</a></span>
                        </p>

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            @endforeach
            <!--end::Card-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

@section('scripts')
<script src="js/pages/location.js"></script>
@endsection

