@extends('admin.main')

@section('title')
{{ trans('Product::product.edit.header_title') }}
@endsection

@section('styles')
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<!--begin::Body-->
@include('Location::state.op_item')
@include('Location::district.op_item')
@include('Location::ward.op_item')
<!--end::Body-->
@endsection

@section('scripts')
<script src="admin/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.5"></script>
<script src="js/pages/location.js"></script>
@endsection
