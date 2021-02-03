@extends('admin.main')



@section('title')
{{ trans('Api::api.user.header_title') }}
@endsection

@section('styles')
<link href="https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-1x text-dark-10 flaticon2-files-and-folders"></i><a  class="text-dark text-hover-success"> {{ trans('Api::api.location.header_title') }} </a></h5>
            <!--end::Title-->

        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <select class="form-control custom-select" id="api_scroll_box">
                @foreach(get_api_users('location') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container container-cus ">

        <div class="row">
            @include('Api::location.states')
        </div>
        <div class="row">
            @include('Api::location.districts')
        </div>
        <div class="row">
            @include('Api::location.wards')
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

@section('scripts')
<script src="https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.js"></script>
<script src="js/pages/location2.js"></script>
<script src="js/pages/api_location.js"></script>
@endsection

