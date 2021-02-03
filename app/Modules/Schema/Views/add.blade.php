@extends('admin.main')

@section('title')
    Thêm schema
@endsection

@section('styles')
    <style>
        .gallerySchema img{
            width: 120px;
        }
    </style>
@endsection


@section('content')

<div class="container">
    <div class="col-12 pb-3 pt-5 rounded">
        <form method="post" class="form-horizontal" role="form" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" id="message_loading" value="{{ trans('custom.loading') }}" />
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
                            <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase"><a href="{{ route('Schema') }}" class="text-dark text-hover-success"><i class="icon-1x text-dark-10 flaticon2-fast-back"></i></a>THÊM SCHEMA
                            </h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <!--begin::Button-->
                        <a href="{{ route('Schema') }}"
                            class="btn btn-default font-weight-bold btn-sm px-3 font-size-base"><i
                                class="icon-1x text-dark-50 flaticon2-back-1"></i>
                            {{ trans('Schema::schema.add.header_btn_back') }}</a>
                        <!--end::Button-->
                        <!--begin::Dropdown-->
                        <div class="btn-group ml-2">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm px-3 font-size-base"><i
                                    class="icon-x fas fa-save"></i>
                                {{ trans('Schema::schema.add.header_btn_save') }}
                            </button>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>

            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container container-cus">
                        <!--begin::Card-->
                        <div class="d-flex flex-row">
                            <div class="flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <!--begin::List Widget 14-->
                                        <div class="card card-custom gutter-b">
                                            <!--begin::Body-->
                                            <div class="card-body pt-5">
                                                <div class="col-lg-12 selected_items"></div>
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label">context</label>
                                                        <input type="text" required class="form-control" name="context">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">type</label>
                                                        <input type="text" required class="form-control" name="type">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">id</label>
                                                        <input type="text" required class="form-control" name="id">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">name</label>
                                                        <input type="text" required class="form-control" name="name">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">addresstype</label>
                                                        <input type="text" class="form-control" name="addresstype">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">streetAddress</label>
                                                        <input type="text" required class="form-control" name="streetAddress">
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label">Locality</label>
                                                        <input type="text" class="form-control" name="addressLocality">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Region</label>
                                                        <input type="text" class="form-control" name="addressRegion">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Postal Code</label>
                                                        <input type="text" class="form-control" name="postalCode">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Country</label>
                                                        <input type="text" class="form-control" name="addressCountry">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Rating</label>
                                                        <input type="text" class="form-control" name="ratingValue">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">Best Rating</label>
                                                        <input type="text" class="form-control" name="bestRating">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <!--begin::List Widget 14-->
                                        <div class="card card-custom gutter-b">
                                            <div class="separator separator-solid"></div>
                                            <!--begin::Body-->
                                            <div class="card-body pt-5">
                                                <div class="col-lg-12 selected_items"></div>
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label">image</label>
                                                        <input type="file" required id="fileImage" class="form-control" name="image[]" multiple>
                                                    </div>
                                                    <div class="gallerySchema"></div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">telephone</label>
                                                        <input type="text" class="form-control" name="telephone">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">servesCuisine</label>
                                                        <input type="text" class="form-control" name="servesCuisine">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">dayOfWeek</label>
                                                        <select name="dayOfWeek[]" id="cars" multiple class="form-control">
                                                            <option value="Monday">Monday</option>
                                                            <option value="Tuesday">Tuesday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Thursday">Thursday</option>
                                                            <option value="Friday">Friday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Saturday">Wednesday</option>Saturday
                                                            <option value="Sunday">Sunday</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-form-label">opens</label>
                                                        <input type="text" class="form-control" name="opens">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">closes</label>
                                                        <input type="text" class="form-control" name="closes">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">authorname</label>
                                                        <input type="text" class="form-control" name="authorname">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">latitude</label>
                                                        <input type="text" class="form-control" name="latitude">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">longitude</label>
                                                        <input type="text" class="form-control" name="longitude">
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label">url</label>
                                                        <input type="text" class="form-control" name="url">
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="js/pages/image-input.js?v=1.0.0"></script>
<script src="js/pages/schema.js?v=1.0.0"></script>
<script src="js/pages/location.js?v=1.0.0"></script>
@endsection