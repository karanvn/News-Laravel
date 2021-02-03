@extends('admin.main')

@php
    $module = get_page_static_module();
@endphp

@section('title')
    {{ trans($module.'page_static.list.header_title') }}
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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-1x text-dark-10 flaticon2-files-and-folders"></i><a href="{{ route('PageStatic') }}" class="text-dark text-hover-success"> {{ trans($module.'page_static.list.header_title') }} </a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($pageStatics->total()) }} {{ trans($module.'page_static.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            @if(!empty($filters['sort']) && !empty($filters['id']))
            <!--begin::Button-->
            <button type="submit" form="frmSortBanner" class="btn btn-light-primary font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-sort-alphabetically"></i></i>{{ trans($module.'page_static.list.header_sort_btn') }}</button>
            <!--end::Button-->
            @endif
            <!--begin::Button-->
            <a href="{{ route('PageStaticAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans($module.'page_static.list.header_add_btn') }}</a>
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
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base" ><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans($module.'page_static.list.filter.btn') }}</button>
                        </div>
                    </div>
                    <div class="separator separator-solid"></div>
                    <div class="card-bodys pt-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex flex-wrap col-lg-12 col-xl-12 mt-0">
                                <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label><strong>{{ trans($module.'page_static.list.filter.status') }}</strong></label>
                                        <select class="form-control custom-select"  name="status" >
                                            <option value="0">{{ trans($module.'page_static.list.filter.se_status') }}</option>
                                            @foreach(get_page_static_statuses() as $key => $value)
                                            <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($pageStatics->hasPages())
                    <div class="separator separator-solid"></div>
                    <div class="card-body">
                        <!--begin::Pagination-->
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            {!! $pageStatics->links($module.'page_static.paginate', ['paginator' => $pageStatics, 'filter' => $filters]) !!}
                        </div>
                        <!--end:: Pagination-->
                    </div>
                    @endif

                    @if(!empty(@$filters['sort']))
                    <div class="separator separator-solid"></div>
                    <div class="card-body">
                        <span class="btn btn-icon-danger btn-sm btn-text-dark-50 rounded font-weight-bolder font-size-sm p-2">
                            <i class="icon-x text-dark-10 flaticon-bell"></i> {{ trans($module.'page_static.list.filter.sort_note') }}
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
            @include($module.'page_static.list')
            @else
            @include($module.'page_static.sort')
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

