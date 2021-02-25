@extends('admin.main')

@section('title')
{{ trans('Blog::blogcategory.edit.header_title') }}
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <form method="post" class="form-horizontal" role="form" action="{{route('blog-category-edit-post')}}" enctype="multipart/form-data">
        @csrf
            <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
            <input type="hidden" id="message_loading" name='id' value="{{ $category->id }}" />
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Mobile Toggle-->
                        <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
                            id="kt_subheader_mobile_toggle">
                            <span></span>
                        </button>
                        <!--end::Mobile Toggle-->
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a
                                    href="{{ route('blog-category-list') }}" class="text-dark text-hover-success"><i
                                        class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>{{ trans('Blog::blogcategory.edit.header_title') }}
                            </h5>
                            <!--end::Page Title-->
                            <!--begin::Breadcrumb-->

                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <!--begin::Button-->
                        <a href="{{ route('blog-category-list') }}"
                            class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-1x text-dark-50 flaticon2-back-1"></i>
                                {{ trans('Blog::blogcategory.add.header_btn_back') }}</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        {{-- <div class="btn-group ml-2">
                            <a href="#" class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-x far fa-plus-square"></i>
                                Thêm danh mục con
                            </a>
                        </div> --}}
                        <!--end::Button-->
                        <div class="btn-group ml-2">
                            <a href="{{ route('blog-category-delete',$category->id) }}" class="btn btn-warning font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                    {{ trans('Blog::blogcategory.add.header_btn_delete') }}
                            </a>
                        </div>
                        <!--begin::Dropdown-->
                        <div class="btn-group ml-2">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                {{ trans('Blog::blogcategory.add.header_btn_save') }}
                            </button>
                        </div>
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
                <!--begin::Card-->
                <div class="d-flex flex-row">
                    <div class="flex-row-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-lg-7">
                                <!--begin::List Widget 14-->
                                <div class="card card-custom gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0">
                                        <h3 class="card-title font-weight-bolder text-dark">
                                            {{trans('Blog::blogcategory.edit.header_title') }}</h3>
                                        <div class="card-toolbar">

                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <div class="separator separator-solid"></div>
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        {{-- <div class="col-lg-12">
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">Danh mục cha
                                                </label>
                                                <select class="form-control custom-select" name="parent_id"
                                                    id="status">
                                                    <option selected>--Chọn danh mục cha (nếu có)--</option>
                                                    @foreach($categoriesparent as $parent)
                                                    <option {{ $category->parent_id==$parent->id?'selected':'' }}  value="{{ $parent->id }}">
                                                        {{ $parent->title_short }}
                                                    </option>
                                                    @endforeach
                                                    
                                                </select>
                                                @if($errors->has('status'))
                                                <p class="text-danger"> {{$errors->first('status')}}</p>
                                                @endif
                                                </p>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">{{trans('Blog::blogcategory.add.form.name') }}</label>
                                                <input type="name" class="form-control" name="title" value="{{ $category->title }}">
                                                @if($errors->has('title'))
                                                <p class="text-danger"> {{$errors->first('title')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">Tên danh mục ngắn</label>
                                                <input type="name" class="form-control" name="title_short" value="{{ $category->title_short }}">
                                                @if($errors->has('title_short'))
                                                <p class="text-danger"> {{$errors->first('title_short')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">Mô tả danh mục</label>
                                                <input type="name" class="form-control" name="description" value="{{ @$category->description }}">
                                                @if($errors->has('title_shdescriptionort'))
                                                <p class="text-danger"> {{$errors->first('description')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">Slug</label>
                                                <input type="name" class="form-control" name="slug" value="{{ $category->slug }}">
                                                @if($errors->has('slug'))
                                                <p class="text-danger"> {{$errors->first('slug')}}</p>
                                                @endif
                                            </div>
                                            <!-- status -->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label">{{trans('Blog::blogcategory.add.form.status') }}
                                                </label>
                                                <select class="form-control custom-select" name="status"
                                                    id="status">
                                                    <option disabled selected>--Trạng thái--</option>
                                                    <option {{ $category->status=='D'?'selected':'' }} value="D">
                                                        {{trans('Blog::blogcategory.add.form.statuses.D') }}
                                                    </option>
                                                    <option {{ $category->status=='A'?'selected':'' }} value="A">
                                                        {{trans('Blog::blogcategory.add.form.statuses.A') }}
                                                    </option>
                                                </select>
                                                @if($errors->has('status'))
                                                <p class="text-danger"> {{$errors->first('status')}}</p>
                                                @endif
                                                </p>
                                            </div>
                                        </div> --}}
                                        @include('Blog::admin.blog-category.form.general')
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List Widget 14-->
                            </div>
                            <div class="col-lg-5">
                                {{-- <div class="row">
                                    <!--begin::Avatar-->
                                    <div class="col-lg-12">
                                        <!--begin::List Widget 10-->
                                        <div class="card card-custom card-stretchs gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0">
                                                <h3 class="card-title font-weight-bolder text-dark">Ảnh đại diện
                                                </h3>
                                                <div class="card-toolbar"></div>
                                            </div>
                                            <!--end::Header-->
                                            <div class="separator separator-solid"></div>
                                            <!--begin::Body-->
                                            <div class="card-body pt-5">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="image-input image-input-outline"
                                                            id="kt_image" style="width: 100%">
                                                            <div class="image-input-wrapper min-h-265px"
                                                                style="background-image: url({{ asset('storage/editor/blog/category/'.$category->image) }});height:265px;width: 100%">
                                                            </div>
                                                            <label
                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow"
                                                                data-action="change" data-toggle="tooltip"
                                                                title="" data-original-title="Đổi ảnh">
                                                                <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                                                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                                            </label>
                                                            <span
                                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip"
                                                                title="" data-original-title="Huỷ ảnh">
                                                                <i
                                                                    class="icon-x text-dark-50 flaticon-delete-1"></i>
                                                            </span>
                                                        </div>
                                                        <span class="form-text text-muted">Cho phép định dạng:
                                                            png, jpg, jpeg.</span>
                                                    </div>
                                                    @if($errors->has('image'))
                                                        <p class="text-danger"> {{$errors->first('image')}}</p>
                                                    @endif
                                                    <span class="form-text text-error avatar-error"></span>
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                    </div>
                                    <!--end::Avatar-->
                                    <div class="col-lg-12">
                                        <!--begin::List Widget 10-->
                                        <div class="card card-custom card-stretchs gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0">
                                                <h3 class="card-title font-weight-bolder text-dark">Tối ưu SEO</h3>
                                                <div class="card-toolbar">
                                                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus"
                                                        id="accordion_seo">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="card-title collapsed text-hover-primary"
                                                                    data-toggle="collapse" data-target="#collapse_seo"
                                                                    aria-expanded="false">
                                                                    Thêm
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Header-->
                                            <div class="separator separator-solid"></div>
                                            <!--begin::Body-->
                                            <div class="card-body pt-5">
                                                <div>
                                                    <span class="text-muted">Thêm thông tin SEO</span>
                                                </div>
                                                <div class="col-lg-12 collapse" id="collapse_seo"
                                                    data-parent="#accordion_seo" style="">
                                                    <div class="form-group row">
                                                        <label class="col-form-label">Tiêu đề
                                                            trang</label>
                                                        <input class="form-control form-control-lg"
                                                            type="text" name="seo_title" placeholder=""
                                                            value="{{ $category->seo_title }}">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Mô tả trang
                                                        </label>
                                                        <textarea class="form-control" rows="8"
                                                            name="seo_description">{{ $category->seo_description }}</textarea>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Đường dẫn</label>
                                                        <textarea class="form-control" rows="2"
                                                            name="seo_link">{{ $category->seo_link }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                    </div>

                                </div> --}}
                                @include('Blog::admin.blog-category.form.seo')
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </form>
</div>

{{-- <textarea id="product_note">
</textarea> --}}


@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/branch.js?v=1.0.0"></script>
<script src="js/pages/location.js?v=1.0.0"></script>
{{-- <script src="js/pages/product.js"></script> --}}



@endsection