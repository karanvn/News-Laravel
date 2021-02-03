@extends('admin.main')



@section('title')
{{ trans('Mail::mail.block.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                <i class="icon-x text-dark-50 flaticon2-new-email"></i><a class="text-dark text-hover-success" href="{{ route('Block') }}"> {{ trans('Mail::mail.block.list.header_title') }} </a>
            </h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format(count($blocks)) }} {{ trans('Mail::mail.block.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('BlockAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Mail::mail.block.list.header_add_btn') }}</a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('Tpl') }}" class="btn btn-light-danger font-weight-bold ml-2">{{ trans('Mail::mail.tpl.list.header_title') }}</a>
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
            <!--begin::Card-->
            @foreach($blocks as $block)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        {{--
                        <div class="d-flex justify-content-end">
                        </div>
                        --}}
                        <!--begin::User-->
                        <div class="d-flex align-items-end mb-0">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('BlockEdit', [$block->block_id]) }}" class="text-dark font-weight-bold text-hover-success font-size-h4 mb-0">
                                        <span class="symbol symbol-40 symbol-light-{{ $block->status == 'A' ? 'success' : 'danger' }}">
											<span class="symbol-label font-size-h8 font-weight-bold pl-0 pr-0 font-weight-bolder">
                                                {{ mb_substr($block->name, 0, 1).mb_substr(get_mail_statuses()[$block->status], 0, 1) }}
                                            </span>
										</span>
                                        {{ $block->name }}
                                    </a>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->
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

@section('scripts')

@endsection
