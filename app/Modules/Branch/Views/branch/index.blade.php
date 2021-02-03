@extends('admin.main')



@section('title')
{{ trans('Branch::branch.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><i class="icon-1x text-dark-10 flaticon2-files-and-folders"></i><a href="{{ route('Branch') }}" class="text-dark text-hover-success"> {{ trans('Branch::branch.list.header_title') }} </a></h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($branches->total()) }} {{ trans('Branch::branch.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('BranchAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Branch::branch.list.header_add_btn') }}</a>
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
        <div class="row">
            <!--begin::Filter-->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <form id="frmFilterBranch" name="frmFilterBranch" class="form-horizontal" role="form">
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">

                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Branch::branch.list.filter.btn') }}</button>
                            </div>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="card-bodys pt-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap col-lg-12 col-xl-12 mt-0">
                                    <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Branch::branch.list.filter.name') }}</strong></label>
                                            <input type="text" name="name" class="form-control" placeholder="" value="{{ @$filters['name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3 mt-3 mt-lg-0">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Branch::branch.list.filter.status') }}</strong></label>
                                            <select class="form-control custom-select"  name="status" >
                                                <option value="0">{{ trans('Branch::branch.list.filter.se_status') }}</option>
                                                @foreach(get_branch_statuses() as $key => $value)
                                                <option {{ $key == @$filters['status'] ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (@$branches->hasPages())
                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                {!! $branches->links('Branch::branch.paginate', ['paginator' => $branches, 'filter' => $filter]) !!}
                            </div>
                            <!--end:: Pagination-->
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            <!--end::Filter-->

            <!--begin::Card-->
            @foreach($branches as $branch)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body p-4">
                        {{--
                        <div class="d-flex justify-content-end">
                            <span class="label label-{{ $branch->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_branch_statuses()[$branch->status] }}</span>
                        </div>
                        --}}
                        <!--begin::User-->
                        <div class="d-flex align-items-end">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-0">
                                    <div class="symbol symbol-circle symbol-lg-75">
                                        @if(!empty($branch->avatar))
                                        <img src="{{  show_image(config('branch.image.thumb_path'), $branch->avatar) }}" alt="image">
                                        @else
                                        <span class="symbol-label font-size-h4 font-weight-bold pl-0 pr-0 font-weight-bolder">
                                            {{ mb_substr($branch->name, 0, 1) }}
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <!--end::Pic-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('BranchEdit', [$branch->id]) }}" class="text-dark font-weight-bolder text-hover-success font-size-h4 mb-0"><span class="text-{{ $branch->status == 'A' ? 'success' : 'danger' }}">{{ $branch->name }}</span></a>
                                    <span class="text-muted font-weight-bold">{{ $branch->email }}</span>
                                    @if($branch->address)
                                    <span class="text-muted font-weight-bold"><i class="icon-1x text-dark-10 flaticon2-location"></i> {{ $branch->address }}</span>
                                    @endif
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->
                        {{--
                        <!--begin::Desc-->
                        <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordion_description_{{ $branch->id }}">
                            <div class="card">
                                @if(!empty($branch->description))
                                <div class="card-header" id="headingOne7">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse_description_{{ $branch->id }}" aria-expanded="false">
                                        <span class="svg-icon svg-icon-success">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                    <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <div class="card-label pl-0"><span class="label label-inline">{{ trans('Branch::branch.list.description') }}</span></div>
                                    </div>
                                </div>
                                <div id="collapse_description_{{ $branch->id }}" class="collapse" data-parent="#accordion_description_{{ $branch->id }}" style="">
                                    <div class="">{{ $branch->description }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--end::Desc-->
                        --}}
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            @endforeach
            <!--end::Card-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
