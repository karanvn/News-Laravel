@extends('admin.main')
@section('title')
Page Tĩnh
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-squares"></i>
                Page Tĩnh</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
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
        <!--begin::Card-->
        <!--end::Card-->
        <!--begin::Pagination-->
        <div class="card card-custom">
            <div class="card-body py-7">
                <!--begin::Pagination-->
                <div id="kt_tree_111" class="tree jstree-default form-control-solid" role="tree">
                    @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                    @endif
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Quản lý trang tĩnh
                            </div>
                            <div class="float-right">
                                <a href="{{ route('static-page-add') }}" class="btn btn-success pull-right"><i
                                        class="fa fa-plus-circle"></i> Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <!--end::Search Form-->
                        </div>
                        <!--begin: Datatable-->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable" class="table table-bordered table-hover dataTable" role="grid"
                                    aria-describedby="datatable_info" style="width: 100%">
                                    <thead>
                                        <tr role="row">
                                            <th 
                                                class="text-center" rowspan="1" colspan="1">...
                                            </th>
                                            <th class="sorting" rowspan="1" colspan="1">Tên (vi)</th>
                                            <th class="sorting" rowspan="1" colspan="1">Thuộc nhóm</th>
                                            <th class="text-center sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" >Trạng thái</th>
                                            <th class="text-center sorting_disabled" rowspan="1" colspan="1"> ...</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($blogs as $blogStatics)
                                        @if(@$blogStatics->category->parent_id==35)
                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <img alt="1" src="storage/editor/blog/{{ $blogStatics->image }}" class="img-thumbnail" style="width: 60px;"></td>
                                            <td>{{ $blogStatics->title }}<br><b>[{{ $blogStatics->category->title_short }}]{{ @$blogStatics->category->id==37?'[Tĩnh]':'' }}</b></td>
                                            <td>{{ $blogStatics->category->position }}</td>
                                            <td class=" text-center"><span style="width: 118px;">
                                                <a href="{{ route('status',$blogStatics->id)}}"  class="label font-weight-bold label-lg  label-light-{{ $blogStatics->status=='D'?'info':'success' }} label-inline label-bold">
                                                    {{ $blogStatics->status }}
                                                </a>
                                            </span></td>
                                            <td class=" text-center">
                                                <div class="btn-group" role="group">
                                                    <a type="button" href="{{ route('static-page-edit',$blogStatics) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    &nbsp;
                                                    <a type="button" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" rowspan="1" colspan="1">...</th>
                                            <th rowspan="1" colspan="1">Tên (vi)</th>
                                            <th rowspan="1" colspan="1">Thuộc nhóm</th>
                                            <th class="text-center" rowspan="1" colspan="1">Trạng thái</th>
                                            <th class="text-center" rowspan="1" colspan="1">...</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--end: Datatable-->
                    </div>
                    <!--end::Card-->
                                
                </div>
                <!--end:: Pagination-->
            </div>
        </div>

        <!--end::Pagination-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@section('scripts')
<script src="admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.5"></script>
<script src="js/pages/product.js"></script>
@endsection