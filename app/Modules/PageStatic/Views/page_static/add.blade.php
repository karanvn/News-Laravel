@extends('admin.main')

@php
    // $module = get_page_static_module();
@endphp

@section('title')
    {{ trans('PageStatic::page_static.add.header_title') }}
@endsection

@section('styles')
<link href="{{ 'admin/assets/css/pages/wizard/wizard-4.css?v=7.0.5' }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<form id="frmAddPageStatic" name="frmAddPageStatic" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ @$page->id }}" />
    <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}"/>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('PageStatic') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>THÊM TRANG TĨNH</h5>
            <!--end::Title-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="{{ route('PageStatic') }}" class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i class="icon-1x text-dark-50 flaticon2-back-1"></i>Trở về</a>
            <!--end::Button-->
            <!--begin::Dropdown-->
            <div class="btn-group ml-2">
                <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i class="icon-x fas fa-save"></i> Lưu</button>
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
                <div class="col-lg-8">
                    <!--begin::List Widget 14-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Thông tin chung</h3>
                            <div class="card-toolbar"></div>
                        </div>
                        <!--end::Header-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <div class="col-lg-12">
                            <!--begin::Body-->
                            <div class="form-group row">
                                <label class="col-form-label">Tên trang<span class="label-text-error">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="title" placeholder="" value="{{ @$page->title }}">
                                <span class="form-text text-error name-error"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Slug<span class="label-text-error">*</span></label>
                                <input class="form-control form-control-lg" type="text" name="slug" placeholder="" value="{{ @$page->slug }}">
                                {{-- <span class="form-text text-error name-error"></span> --}}
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Nội dung trang<span class="label-text-error">*</span></label>
                                <textarea id="page_description" class="form-control ckeditor" rows="5" name="content">{{ @$page->content }}</textarea>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Ngày bắt đầu / Ngày kết thúc <span class="label-text-error">*</span></label>
                                <div class="input-daterange input-group" id="kt_datepicker_5">
                                    <input type="text" class="form-control" name="published_start" readonly="readonly" value="{{ !empty($page->published_start) ? $page->published_start : date('Y-m-d H:i') }}" id="published_start">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="published_end" readonly="readonly" value="{{ !empty($page->published_end) ? $page->published_end : date('Y-m-d H:i') }}" id="published_end">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="form-text text-error published_start-error"></span>
                                <span class="form-text text-error published_end-error"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Trạng thái</label>
                                <select class="form-control custom-select" name="status">
                                    <option value="1">Ẩn</option>
                                    <option value="2">Kích hoạt</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Vị trí ảnh</label>
                                <select class="form-control custom-select" name="position_image">
                                    <option value="1">Banner</option>
                                    <option value="2">Background</option>
                                </select>
                            </div>
                            <!--end::Body-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List Widget 14-->
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <!--begin::SEO-->
                        <div class="col-lg-12">
                            @if(!empty($page))
                            <div class="card card-custom card-stretchs gutter-b">
                                <a href="{{$page->slug.'.html'}}" style="padding: 17px" target="_blank"><i class="fa fa-arrow-right" style="color: #1bc5bd" aria-hidden="true"></i> Bấm vào đây để đến trang của bạn </a>
                            </div>
                            @endif
                            <div class="card card-custom card-stretchs gutter-b">
                                <label>{{ trans('PageStatic::page_static.add.form.avatar') }} <span class="label-text-error">*</span></label>
                                    <div class="image-input image-input-outline" id="kt_image" style="width: 100%">
                                        <div class="image-input-wrapper" style="background-image: url({{'storage/page_static/org/'.@$page->image}}); width: 100%"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('PageStatic::page_static.add.form.avatar_change') }}">
                                            <i class="icon-x text-dark-50 flaticon2-image-file"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-success btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="{{ trans('PageStatic::page_static.add.form.avatar_cancel') }}">
                                            <i class="icon-x text-dark-50 flaticon-delete-1"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">{{ trans('PageStatic::page_static.add.form.allow_image_extension') }}</span>
                                    <span class="form-text text-error avatar-error"></span>
                            </div>
                            <!--begin::List Widget 10-->
                            <div class="card card-custom card-stretchs gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Tối ưu SEO</h3>
                                <div class="card-toolbar">
                                    <div class="accordion accordion-light accordion-light-borderless accordion-toggle-plus" id="accordion_seo">
                                        <div class="card">
                                        <div class="card-header">
                                            <div class="card-title collapsed text-hover-primary" data-toggle="collapse" data-target="#collapse_seo" aria-expanded="false">Thêm &nbsp;&nbsp;&nbsp;&nbsp;</div>
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
                                <div class="col-lg-12 collapse" id="collapse_seo" data-parent="#accordion_seo">
                                    <div class="form-group row">
                                        <label class="col-form-label">Tiêu đề trang</label>
                                        <input class="form-control form-control-lg" type="text" name="seo_title" placeholder="" value="{{@$page->seo_title}}">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label">Mô tả trang </label>
                                        <textarea class="form-control" rows="8" name="seo_description">{{@$page->seo_description}}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label">Đường dẫn</label>
                                        <textarea class="form-control" rows="2" name="seo_link">{{@$page->seo_link}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                            </div>
                        </div>
                        <!--end::SEO-->
                    </div>
                </div>
                <!--end::Body-->
                </div>
            </div>
            <!--end::SALE-->
        </div>
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
@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="admin/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.5"></script>
<script src="admin/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.5"></script>
<script src="js/pages/tagify.js"></script>
<script src="js/pages/page_static.js"></script>
<script src="/js/crud/ckeditor/ckeditor.js"></script>
@endsection
