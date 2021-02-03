@extends('admin.main')
@section('title')
{{ trans('Blog::blogcategory.list.header_title') }}
@endsection

@section('content')
<link href="admin/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->
<!--begin::Layout Themes(used by all pages)-->
<link href="admin/assets/css/themes/layout/header/base/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="admin/assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
<link href="css/pages/styles.css" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->
<link rel="shortcut icon" href="admin/assets/media/logos/favicon.ico" />
<link href="admin/assets/plugins/custom/jstree/jstree.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-x text-dark-10 flaticon-squares"></i>
                {{ trans('Blog::blogcategory.list.header_title') }}</h5>
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
            <a href="{{ route('blog-category-add') }}" class="btn btn-light-success font-weight-bold ml-2"><i
                    class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Blog::blogcategory.list.header_add_btn') }}</a>
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
        @if(count($blogCategories) > 0)
        <div class="card card-custom">
            <div class="card-body py-7">
                <!--begin::Pagination-->
                <div id="kt_tree_111" class="tree jstree-default form-control-solid" role="tree">
                    <ul class="jstree-container-ul jstree-children" role="group">
                        @foreach($blogCategories as $cate)
                        <li role="treeitem"  id="jstree_node_{{ $cate->id }}" class="jstree-node jstree-closed jstree-node-{{ $cate->id }}" style="margin-bottom: 10px">
                            @php
                            $statuses = !empty($flag) ? ['A','D'] : ['A'];
                            $children = $cate->categories()->whereIn('status', $statuses)->get();
                            $count = @$children->count();
                            @endphp
                            @if($count > 0)
                            <i class="jstree-icon jstree-ocl jstree-icon-{{ $cate->id }}" onclick="show_treesblog({{ $cate->id }}, 1)" role="presentation" expanded="closed"></i>
                            @endif
                            <i class="icon-l fas fa-long-arrow-alt-right" style="margin-top:5px;margin-left: {{ count($children) > 0 ? '-10px' : '11px' }}"></i>
                            <a class="jstree-anchor">
                                <label class="radio radio-rounded">
                                    <a href="{{ route('blog-category-edit', [$cate->id]) }}"><span class="label label-{{ $cate->status == 'A' ? 'success' : 'danger' }} label-inline mr-0"><strong>{{ $cate->title }}</strong>
                                        @if($count > 0)
                                        &nbsp;&nbsp;<span class="label label-sm label-white mr-0">{{ $count }}</span>
                                        @endif
                                        </span></a>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="display: none">
                                        <div class="btn-group-sm" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-{{ $cate->status == 'A' ? 'success' : 'danger' }} font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ get_category_statuses()[$cate->status] }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" >{{ $cate->status == 'A' ? trans('Product::category.statuses.D') : trans('Product::category.statuses.A') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </a>
                        
                            <ul class="jstree-container-ul jstree-children jstree-container-category jstree-children-{{ $cate->id }}" role="group" style="margin-left: 22px"></ul>
                        
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <!--end:: Pagination-->
            </div>
        </div>
        @endif
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
<script src="admin/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
<script src="admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/scripts.bundle.js?v=7.0.5"></script>
<!--end::Global Theme Bundle-->


@endsection