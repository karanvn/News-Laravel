@extends('admin.main')


@section('title')
{{ trans('Partner::partner.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><a href="{{ route('Partner') }}" class="text-dark text-hover-success"> <i class="icon-1x text-dark-10 flaticon2-user"></i> {{ trans('Partner::partner.list.header_title') }}</a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ number_format($partners->total()) }} {{ trans('Partner::partner.list.header_total') }}</span>
            </div>
            <!--end::Search Form-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('PartnerAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Partner::partner.list.header_add_btn') }}</a>
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

        <!--begin::Filter-->
        <div style="margin-bottom: 25px">
            <div class="card card-custom">
                <form id="frmFilterPartner" name="frmFilterPartner" class="form-horizontal" role="form">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex flex-wrap col-lg-10 col-xl-10 mt-10">

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Partner::partner.list.filter.name') }}</strong></label>
                                    <input type="text" name="name" value="{{ @$filters['name'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Partner::partner.list.filter.email') }}</strong></label>
                                    <input type="text" name="email" value="{{ @$filters['email'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Partner::partner.list.filter.phone') }}</strong></label>
                                    <input type="text" name="phone" value="{{ @$filters['phone'] }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                <div class="form-group">
                                    <label><strong>{{ trans('Partner::partner.list.filter.status') }}</strong></label>
                                    <select class="form-control custom-select"  name="status" >
                                        <option value="0">{{ trans('Partner::partner.list.filter.se_status') }}</option>
                                        @foreach(get_partner_statuses() as $key => $value)
                                        <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center col-lg-2 col-xl-2 mt-2">
                            <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base" style="margin-top: 25px"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Partner::partner.list.filter.btn') }}</button>
                        </div>
                    </div>
                </div>
                </form>
                @if ($partners->hasPages())
                <div class="separator separator-solid"></div>
                <div class="card-body">
                    <!--begin::Pagination-->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        {!! $partners->links('Partner::partner.paginate', ['paginator' => $partners, 'filter' => $filter]) !!}
                    </div>
                    <!--end:: Pagination-->
                </div>
                @endif
            </div>
        </div>
        <!--end:: Filter-->

        <!--begin::Card-->
        <div class="row">
            @foreach($partners as $partner)
        <div class="col-xl-6 col-lg-12 col-md-12 item ui-sortable-handle">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Top-->
                    <div class="d-flex">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-80 symbol-lg-100">
                                <img alt="Pic" src="{{ show_image(config('partner.image.thumb_path'), $partner->avatar) }}">
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin::User-->

                                <div class="mr-3">
                                    <!--begin::Name-->
                                    <a href="{{ route('PartnerEdit', [$partner->id, 'personal' ]) }}" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        {{ $partner->name }} <span style="margin-left: 10px" class="label label-{{ $partner->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_partner_statuses()[$partner->status] }}</span>
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Contacts-->
                                    <div class="d-flex flex-wrap my-2 d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">

                                        @if($partner->email)
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <i class="icon-1x text-dark-10 flaticon2-email"></i> {{ $partner->email }}
                                        </span>
                                        @endif

                                        @if($partner->phone)
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <i class="icon-1x text-dark-10 flaticon2-phone"></i>
                                            {{ $partner->phone }}
                                        </span>
                                        @endif

                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <i class="icon-1x text-dark-10 flaticon2-location"></i> {{ $partner->address }},
                                            {{ $partner->ward()->get()->first()->name }}, {{ $partner->district()->get()->first()->name }}, {{ $partner->state()->get()->first()->name }}
                                        </span>
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--begin::User-->
                                <!--begin::Actions-->

                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <!--begin::Description-->
                                <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5"></div>
                                <!--end::Description-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Top-->

                    <!--end::Bottom-->
                </div>
            </div>
        </div>
        @endforeach
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
