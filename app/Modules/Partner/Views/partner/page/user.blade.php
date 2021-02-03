<div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">{{ trans('Partner::partner.edit.header_user') }}</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">{{ trans('Partner::partner.edit.sub_user') }}</span>
        </div>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->

    <!--begin::Form-->
    @php
        $users = $partner->users;
    @endphp
    @foreach($users as $index => $user)
    <div class="">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-50 symbol-lg-80">
                        <img alt="Pic" src="{{ show_image(config('auth_.image.thumb_path'), @$user->avatar)}}">
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <!--begin::User-->

                        <div class="mr-3">
                            <!--begin::Name-->
                            <a href="{{ route('AdminEdit', [$user->id, 'general']) }}" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">Huth Phan Nguyen
                            </a>
                            <span class="label label-{{ $user->status == 'A' ? 'success' : 'danger' }} label-inline mr-2">{{ get_user_statuses()[$user->status] }}</span>
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="icon-1x text-dark-10 flaticon-multimedia"></i> {{ $user->email }}</a>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--begin::User-->
                        <!--begin::Actions-->

                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Top-->
        </div>
        @if($index < count($users) - 1)
        <div class="separator separator-dashed my-2"></div>
        @endif
    </div>
    @endforeach
    <!--end::Form-->
</div>
