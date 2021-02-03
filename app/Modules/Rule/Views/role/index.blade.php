@extends('admin.main')



@section('title')
{{ trans('Rule::role.list.header_title') }}
@endsection

@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                <i class="icon-x text-dark-10 flaticon-placeholder-3"></i><a class="text-dark text-hover-success" href="{{ route('Role') }}"> {{ trans('Rule::role.list.header_title') }} </a>
            </h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <div class="d-flex align-items-center">
                <span class="text-dark-50 font-weight-bold">{{ number_format($roles->total()) }} {{ trans('Rule::role.list.header_total') }}</span>
            </div>
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('RoleAdd') }}" class="btn btn-light-success font-weight-bold ml-2"><i class="icon-x text-dark-10 flaticon2-plus-1"></i>{{ trans('Rule::role.list.header_add_btn') }}</a>
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
                <form id="frmFilterRole" name="frmFilterRole" class="form-horizontal" role="form">
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">

                            </h3>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success font-weight-bold btn-sm font-size-base"><i class="icon-1x text-dark-10 flaticon-search"></i>{{ trans('Rule::role.list.filter.btn') }}</button>
                            </div>
                        </div>
                        <div class="separator separator-solid"></div>
                        <div class="card-bodys pt-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap col-lg-12 col-xl-12 mt-0">
                                    <div class="col-lg-4 col-xl-4 mt-4 mt-lg-0">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Rule::role.list.filter.name') }}</strong></label>
                                            <div class="input-icon">
                                                <input type="text" name="name" value="{{ @$filters['name'] }}" class="form-control" placeholder="">
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xl-4 mt-4 mt-lg-0">
                                        <div class="form-group">
                                            <label><strong>{{ trans('Rule::role.list.filter.rule_id') }}</strong></label>
                                            <select class="form-control custom-select"  name="rule_id" >
                                                <option value="0">{{ trans('Rule::role.list.filter.se_rule_id') }}</option>
                                                @foreach($rules as $rule)
                                                <option {{ $rule->id == @$filters['rule_id'] ? 'selected' : '' }} value="{{ $rule->id }}">{{ $rule->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($roles->hasPages())
                        <div class="separator separator-solid"></div>
                        <div class="card-body">
                            <!--begin::Pagination-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                {!! $roles->links('Rule::rule.paginate', ['paginator' => $roles, 'filter' => $filter]) !!}
                            </div>
                            <!--end:: Pagination-->
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            <!--end::Filter-->

            <!--begin::Card-->
            @foreach($roles as $role)
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        @php
                            $rule = $role->rule()->get()->first();
                        @endphp
                        <div class="d-flex justify-content-end">
                            <span class="label label-inline"><a class="text-dark text-hover-success" href="{{ route('Rule', ['id' => @$rule->id]) }}" >{{ trans('Rule::role.list.rule') }} {{ @$rule->name }}</a></span>
                        </div>
                        <!--begin::User-->
                        <div class="d-flex align-items-end mb-4">
                            <!--begin::Pic-->
                            <div class="d-flex align-items-center">
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('RoleEdit', [$role->id]) }}" class="text-dark font-weight-bold text-hover-success font-size-h4 mb-0">
                                        <span class="symbol symbol-30 symbol-light-success">
											<span class="symbol-label font-size-h8 font-weight-bold pl-0 pr-0 font-weight-bolder">
                                                {{ mb_substr($role->name, 0, 1) }}
                                            </span>
										</span>
                                        {{ $role->name }}
                                    </a>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::User-->
                        @php
                            $permissions = $role->permissions()->paginate(1);
                        @endphp
                        <p class="mb-0">
                            <span class="label label-inline">{{ @$permissions->total() }} {{ trans('Rule::role.list.permission') }}</span>
                        </p>

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
<script src="js/pages/location.js"></script>
@endsection
