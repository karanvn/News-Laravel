@extends('admin.main')



@section('title')
{{ trans('Banner::banner.list.header_title') }}
@endsection

@section('styles')

@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-1x text-dark-10 flaticon2-files-and-folders"></i><a href="{{ route('Banner') }}" class="text-dark text-hover-success"> {{ trans('Banner::banner.list.header_title') }} </a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($banners->total()) }} {{ trans('Banner::banner.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            @if(!empty($filters['sort']) && !empty($filters['type']))
            <!--begin::Button-->
            <button type="submit" form="frmSortBanner" class="btn btn-light-primary font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-sort-alphabetically"></i></i>{{ trans('Banner::banner.list.header_sort_btn') }}</button>
            <!--end::Button-->
            @endif
            <!--begin::Button-->
            <a href="{{ route('BannerAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Banner::banner.list.header_add_btn') }}</a>
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
    <div class="container container-cus ">
        <!--begin::Filter-->
        <div>
            <form id="frmFilterBanner" name="frmFilterBanner" class="form-horizontal" role="form">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">

                        </h3>
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base" ><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Banner::banner.list.filter.btn') }}</button>
                        </div>
                    </div>
                    <div class="separator separator-solid"></div>
                    <div class="card-bodys pt-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex flex-wrap col-lg-12 col-xl-12 mt-0">
                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Banner::banner.list.filter.type') }}</strong></label>
                                        <select class="form-control custom-select"  name="type" >
                                            <option value="0">{{ trans('Banner::banner.list.filter.se_type') }}</option>
                                            @foreach(get_banner_types() as $key => $value)
                                            <option {{ $key == @$filters['type'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Banner::banner.list.filter.status') }}</strong></label>
                                        <select class="form-control custom-select"  name="status" >
                                            <option value="0">{{ trans('Banner::banner.list.filter.se_status') }}</option>
                                            @foreach(get_banner_statuses() as $key => $value)
                                            <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Banner::banner.list.filter.published') }}</strong></label>
                                        <select class="form-control custom-select"  name="published" >
                                            <option value="0">{{ trans('Banner::banner.list.filter.se_published') }}</option>
                                            @foreach(get_banner_published_labels() as $key => $value)
                                            <option {{ $key == @$filters['published'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans('Banner::banner.list.filter.sort') }}</strong></label>
                                        <select class="form-control custom-select"  name="sort" >
                                            @foreach(get_banner_sorts() as $key => $value)
                                            <option {{ $key == @$filters['sort'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if ($banners->hasPages())
                    <div class="separator separator-solid"></div>
                    <div class="card-body">
                        <!--begin::Pagination-->
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            {!! $banners->links('Banner::banner.paginate', ['paginator' => $banners, 'filter' => $filter]) !!}
                        </div>
                        <!--end:: Pagination-->
                    </div>
                    @endif

                    @if(!empty(@$filters['sort']))
                    <div class="separator separator-solid"></div>
                    <div class="card-body">
                        <span class="btn btn-icon-danger btn-sm btn-text-dark-50 rounded font-weight-bolder font-size-sm p-2">
                            <i class="icon-x text-dark-10 flaticon-bell"></i> {{ trans('Banner::banner.list.filter.sort_note') }}
                        </span>
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <!--end:: Filter-->

        <!--begin::List-->
        <div class="row">
            @if(empty(@$filters['sort']))
            @include('Banner::banner.list')
            @else
            @include('Banner::banner.sort')
            @endif
        </div>
        <!--end:: List-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection


@section('scripts')
<script src="https://oms.hotdeal.vn/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="js/pages/banner.js"></script>
@endsection

