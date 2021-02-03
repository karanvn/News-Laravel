@extends('admin.main')
@section('title')
Comment Blog
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-squares"></i>
                Comment Blog</h5>
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
                                <h3 class="card-label">Comment Bài viết
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <!--begin::Search Form-->
                            {{-- <div class="mb-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="d-flex align-items-center">
                                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                    <select class="form-control" id="kt_datatable_search_status">
                                                        <option value="">All</option>
                                                        <option value="1">Pending</option>
                                                        <option value="2">Delivered</option>
                                                        <option value="3">Canceled</option>
                                                        <option value="4">Success</option>
                                                        <option value="5">Info</option>
                                                        <option value="6">Danger</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="d-flex align-items-center">
                                                    <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                    <select class="form-control" id="kt_datatable_search_type">
                                                        <option value="">All</option>
                                                        <option value="1">Online</option>
                                                        <option value="2">Retail</option>
                                                        <option value="3">Direct</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                                    </div>
                                </div>
                            </div> --}}
                            <!--end::Search Form-->
                        </div>
                        <!--begin: Datatable-->
                        <table class="datatable-table" >
                            <thead class="datatable-head">
                                <tr class="datatable-row" style="left: 0px;">
                                    <th class="datatable-cell-center datatable-cell datatable-cell-sort"><span
                                            style="width: 30px;">ID</span></th>
                                    <th class="datatable-cell datatable-cell-sort"><span style="width: 118px;">
                                        Người đăng</span></th>
                                    <th class="datatable-cell datatable-cell-sort"><span
                                            style="width: 118px;">Nội dung</span></th>
                                    <th class="datatable-cell datatable-cell-sort"><span style="width: 118px;">
                                            Trả lời</span></th>
    
                                    <th class="datatable-cell datatable-cell-sort datatable-cell-sorted">
                                        <span style="width: 118px;">Status</span></th>
                                    <th class="datatable-cell datatable-cell-sort datatable-cell-sorted">
                                        <span style="width: 118px;">Hành động</span></th>   
                                </tr>
                            </thead>
                            <tbody class="datatable-body" style="">
                                
                                @foreach($comments as $comment)
                                @if(!isset($comment->parent_id))
                                <tr data-row="0" class="datatable-row" style="left: 0px;">
                                    <td class="datatable-cell-center datatable-cell" ><span
                                            style="width: 30px;">{{ $comment->id }}</span></td>
                                    <td class="datatable-cell"><span
                                            style="width: 118px;"><b>Tên:</b>{{ $comment->name }}<br><b>Email:</b>{{ $comment->email }}</span></td>
                                    <td class="datatable-cell"><span
                                            style="width: 118px;">Ngày đăng:{{ date_format($comment->created_at,'d-m-Y') }}<br>Nội dung: {{ $comment->comment }}</span></td>
                                    <td  class="datatable-cell"><span
                                            style="width: 118px;">
                                            @foreach($comments as $reply)
                                            @if($comment->id==$reply->parent_id)
                                            <b>{{ $reply->user->name }}:</b>{{ $reply->comment }}<br>
                                            @endif
                                            @endforeach
                                        </span></td>
                                    <td class="datatable-cell-sorted datatable-cell" >
                                        <span style="width: 118px;">
                                            <a href="{{ route('status',$comment->id)}}"  class="label font-weight-bold label-lg  label-light-{{ $comment->status=='D'?'info':'success' }}
                                            label-inline label-bold">
                                                {{ $comment->status }}
                                            </a>
                                        </span>
                                    </td>
                                    <td class="datatable-cell"><span
                                        style="width: 118px;">[<a href="{{ route('comment-detail',$comment->id) }}">Xem</a>]-[<a href="{{ route('comment-delete',$comment->id) }}">Xóa</a>]</span></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
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