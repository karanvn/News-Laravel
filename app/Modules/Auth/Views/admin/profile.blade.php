<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretchs">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="image-input image-input-outline image-input-circle">
                        <div class="image-input-wrapper" style="background-image: url({{ show_image(config('auth_.image.thumb_path'), @$user->avatar)}})"></div>
                    </div>

                </div>
                <div>
                    <a class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                    <div class="text-muted">{{ $user->position }}</div>
                    {{--<div class="mt-2">
                        <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                        <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                    </div>--}}
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-1x text-dark-10 flaticon-multimedia"></i> {{ trans('Auth::admin.edit.profile.email') }}</span>
                    <span class="text-muted text-hover-primary">{{ $user->email }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-1x text-dark-10 flaticon2-calendar-9"></i> {{ trans('Auth::admin.edit.profile.created_at') }}</span>
                    <span class="text-muted text-hover-primary">{{ $user->created_at }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-1x text-dark-50 flaticon-calendar-3"></i> {{ trans('Auth::admin.edit.profile.last_login') }}</span>
                    <span class="text-muted text-hover-primary">{{ $user->last_login }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-x text-dark-10 flaticon-user-add"></i> {{ trans('Auth::admin.edit.profile.created_by') }}</span>
                    <span class="text-muted text-hover-primary">{{ $user->user->name }}</span>
                </div>
            </div>
            <!--end::Contact-->
            <div class="separator separator-solid mb-7"></div>
            <!--begin::Nav-->
            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                <div class="navi-item mb-2">
                    <a href="{{ route('AdminEdit', [$user->id, 'general' ]) }}" class="navi-link py-4 {{ $page == 'general' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <i class="icon-x text-dark-50 flaticon-info"></i>
                        </span>
                        <span class="navi-text font-size-lg">{{ trans('Auth::admin.edit.header_general') }}</span>
                    </a>
                </div>

                @if($auth->can('add admins') || $auth->id == $user->id)
                <div class="navi-item mb-2">
                    <a href="{{ route('AdminEdit', [$user->id, 'password' ]) }}" class="navi-link py-4 {{ $page == 'password' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <i class="icon-x text-dark-10 flaticon-lock"></i>
                        </span>
                        <span class="navi-text font-size-lg">{{ trans('Auth::admin.edit.header_password') }}</span>
                    </a>
                </div>
                @endif

                @if($auth->can('add admins'))
                <div class="navi-item mb-2">
                    <a href="{{ route('AdminEdit', [$user->id, 'rule' ]) }}" class="navi-link py-4 {{ $page == 'rule' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <i class="icon-x text-dark-10 flaticon-users"></i>
                        </span>
                        <span class="navi-text font-size-lg">{{ trans('Auth::admin.edit.header_rule') }}</span>
                    </a>
                </div>
                @endif

                <div class="navi-item mb-2">
                    <a href="{{ route('AdminEdit', [$user->id, 'history' ]) }}" class="navi-link py-4 {{ $page == 'history' ? 'active' : '' }}">
                        <span class="navi-icon mr-2">
                            <i class="icon-x flaticon2-writing"></i>
                        </span>
                        <span class="navi-text font-size-lg">{{ trans('Auth::admin.edit.header_history') }}</span>
                    </a>
                </div>
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>
