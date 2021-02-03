@extends('admin.main')

@section('title')
{{ trans('Schema::schema.list.header_title') }}
@endsection

@section('styles')

@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-1x text-dark-10 flaticon2-files-and-folders"></i><a href="{{ route('Banner') }}" class="text-dark text-hover-success"> {{ trans('Schema::schema.list.header_title') }} </a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($schema->total()) }} {{ trans('Schema::schema.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            @if(!empty($filters['sort']) && !empty($filters['type']))
            <!--begin::Button-->
            <button type="submit" form="frmSortSchema" class="btn btn-light-primary font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-sort-alphabetically"></i></i>{{ trans('Schema::schema.list.header_sort_btn') }}</button>
            <!--end::Button-->
            @endif
            <!--begin::Button-->
            <a href="{{ route('SchemaAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Schema::schema.list.header_add_btn') }}</a>
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus">
        <div>
            <form id="frmFilterSchema" name="frmFilterSchema" class="form-horizontal" role="form">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0">
                        <div class="col-md-12">
                            @include('Schema::list')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection


@section('scripts')
    <script src="https://oms.hotdeal.vn/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
@endsection

