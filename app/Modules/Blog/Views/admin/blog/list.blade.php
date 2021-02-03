@extends('admin.main')
@section('title')
{{ trans('Blog::blog.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i
                    class="icon-x text-dark-10 flaticon-placeholder-3"></i><a class="text-dark text-hover-success"
                    href="{{ route('blog-list') }}">{{ trans('Blog::blog.list.header_title') }}</a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ $blogs->count() }} {{ trans('Blog::blog.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <!--end::Button-->
            <!--begin::Button-->

            <a href="{{ route('blog-add') }}" class="btn btn-light-success font-weight-bold ml-2"><i
                    class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Blog::blog.list.header_add_btn') }}</a>

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
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="row">
            <!--begin::Filter-->
            <div class="col-lg-12">
                <form id="frmFilterBlog" name="frmFilterBlog" acction="{{ route('blog-list') }}" method="get" class="form-horizontal" role="form">
                    <!--begin::List Widget 10-->
                    <div class="card card-custom card-stretchs gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">

                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i
                                        class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Blog::blog.list.filter.btn-search') }}</button>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @include('Blog::admin.blog.pages.search')
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row collapse 1" id="collapse_filters" data-parent="#accordion_filters">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->

                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                             <!--begin::Pagination-->
                             <div class="d-flex justify-content-between align-items-center flex-wrap">
                               

                                @if($blogs->lastPage()>1)
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="d-flex flex-wrap mr-3">
                                        @if($blogs->currentPage()==1)
                                        <a class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                                        </a>
                                        @else
                                        <a href="{{asset('/admins/blog/list')}}?page={{$blogs->currentPage()-1}}&status={{$status}}&id={{$id}}&title_short={{@$title_short}}&blog_category_id={{@$blog_category_id}}"
                                            class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                                        </a>
                                        @endif
                                        <!-- dem so -->
                                        @for($i=1; $i<=$blogs->lastPage();$i++)
                                                @if($i==$blogs->currentPage())
                                                    <a
                                                class="btn btn-icon btn-sm border-0 btn-hover-success active mr-2 my-1">
                                                <strong>{{$i}}</strong></a>
                                                @else

                                                    @if(($i-$blogs->currentPage() <= 6)&&($i-$blogs->currentPage() >= -6))
                                                    <a href="{{asset('/admins/blog/list')}}?page={{$i}}&status={{$status}}&id={{$id}}&title_short={{@$title_short}}&blog_category_id={{@$blog_category_id}}"
                                                    class="btn btn-icon btn-sm border-0 btn-hover-success mr-2 my-1">{{$i}}</a>
                                           
                                                   @endif

                                                @endif
                                        @endfor
                                        <!--  next -->
                                        @if($blogs->currentPage()==$blogs->lastPage())
                                        <a class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                                        </a>
                                        @else
                                        <a href="{{asset('/admins/blog/list')}}?page={{$blogs->currentPage()+1}}&status={{$status}}&id={{$id}}&title_short={{@$title_short}}&blog_category_id={{@$blog_category_id}}"
                                            class="btn btn-icon btn-sm btn-light-success mr-2 my-1">
                                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                                        </a>
                                        @endif
                                        </div>
                                        </div>
                                @endif
                            </div>
                            <!--end:: Pagination-->
                        </div>

                    </div>
                </form>
            </div>
            <!--end::Filter-->
            
            <!--begin::Card-->
            <div class="col-lg-12">
                <div class="row">
                    {{-- start-Blog --}}
                    @foreach($blogs as $blog)
                    <div class="col-lg-6 mb-8">
                        <div class="card card-custom">
                            <div class="card-body p-4">
                                <!--begin::Top-->
                                <div class="d-flex">
                                    <!--begin::Pic-->
                                    <div class="flex-shrink-0 mr-0">
                                        <div class="symbol symbol-100 symbol-lg-100 symbol-2by3 flex-shrink-0 mr-4">
                                            <div class="symbol-label"
                                                style="background-image: url({{ asset('storage/editor/blog/'.$blog->image) }})">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin: Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-0">
                                            <!--begin::User-->
                                            <div class="mr-3">
                                                <!--begin::Name-->
                                                <span
                                                    class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-0">
                                                    <a href="{{ route('blog-edit',$blog->id) }}">
                                                        00000{{ $blog->id }} - {{ $blog->title }}
                                                    </a>
                                                </span>
                                                <!--end::Name-->
                                                <!--begin::Contacts-->
                                                <div class="d-flex flex-wrap my-0">
                                                    <span
                                                        class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-x text-dark-50 flaticon-user-add"></i> {{ @$blog->user->name }}
                                                    </span>
                                                    <span class="label label-success label-inline mr-2">{{ trans('Blog::blog.statuses.'.@$blog->status) }}</span>
                                                </div>
                                                <div class="d-flex flex-wrap my-0">
                                                    <span
                                                        class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-x text-dark-50 flaticon-calendar"></i>{{ $blog->created_at }} 
                                                    </span>
                                                    <span text-muted font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <a href="{{ route('comment-list',$blog->id) }}">({{ $blog->comments->count() }}){{ trans('Blog::blog.list.comment') }}</a>
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-wrap my-0">
                                                    <span
                                                        class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="icon-x text-dark-50 flaticon-layers"></i>{{ @$blog->category->title }}
                                                    </span>
                                                </div>
                                                <!--end::Contacts-->
                                            </div>
                                            <!--begin::User-->
                                            <!--begin::Actions-->
                                            <div class="my-lg-0 my-0">
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Content-->
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <!--begin::Description-->
                                            <div class="flex-grow-1 font-weight-bold py-2 py-lg-2 mr-5">
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Bottom-->
                                <div class="d-flex align-items-center flex-wrap">

                                </div>
                                <!--end::Bottom-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- end-Blog --}}
                </div>
            </div>
            <!--end::Card-->
            
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection

@section('modal')
<!--begin::Modal-->
<div class="modal fade" id="modalTreeCategories" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Blog::category.list.header_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="input-group">
                    <div class="radio-list">
                        <div id="kt_tree_111" class="tree jstree-default" role="tree">
                            <ul class="jstree-container-ul jstree-children" role="group" style="padding: 10px">
                                123
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-success"
                    id="btn_selected_categories">{{ trans('Blog::product.add.form.category_btn') }}</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection

@section('scripts')
<script src="admin/assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/features/miscellaneous/treeview.js?v=7.0.5"></script>

@endsection