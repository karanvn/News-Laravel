<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="image-input image-input-outline image-input-circle">
                        <div class="image-input-wrapper" style="background-image: url({{ show_image(config('partner.image.thumb_path'), @$partner->avatar)}})"></div>
                    </div>

                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $partner->name }}</a>
                    <div class="text-muted"><i class="icon-1x text-dark-10 flaticon2-calendar-9"></i> {{ date('d-m-Y H:i', strtotime($partner->created_at)) }}</div>
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                        <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-1x text-dark-10 flaticon-multimedia"></i> {{ trans('Partner::partner.edit.profile.email') }}</span>
                    <a href="#" class="text-muted text-hover-primary">{{ $partner->email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2"><i class="icon-1x text-dark-10 flaticon2-phone"></i> {{ trans('Partner::partner.edit.profile.phone') }}</span>
                    <span class="text-muted">{{ $partner->phone }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">
                        <i class="icon-1x text-dark-10 flaticon2-location"></i>
                        <span class="">

                            {{ $partner->address }},
                            {{ $partner->ward()->get()->first()->name }},
                            {{ $partner->district()->get()->first()->name }},
                            {{ $partner->state()->get()->first()->name }}
                        </span>
                </div>
            </div>
            <!--end::Contact-->
            <div class="separator separator-solid my-7"></div>
            <!--begin::Nav-->
            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                <div class="navi-item mb-2">
                    <a href="{{ route('PartnerEdit', [$partner->id, 'personal' ]) }}" class="navi-link py-4 {{ $page == 'personal' ? 'active' : '' }}">
                        <span class="navi-text font-size-lg"><i class="icon-x text-dark-50 flaticon-information"></i> {{ trans('Partner::partner.edit.header_personal') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a href="{{ route('PartnerEdit', [$partner->id, 'payment' ]) }}" class="navi-link py-4 {{ $page == 'payment' ? 'active' : '' }}">
                        <span class="navi-text font-size-lg"><i class="icon-x text-dark-50 flaticon-notepad"></i> {{ trans('Partner::partner.edit.header_payment') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a href="{{ route('PartnerEdit', [$partner->id, 'invoice' ]) }}" class="navi-link py-4 {{ $page == 'invoice' ? 'active' : '' }}">
                        <span class="navi-text font-size-lg"><i class="icon-x text-dark-50 flaticon2-paper"></i> {{ trans('Partner::partner.edit.header_invoice') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a href="{{ route('PartnerEdit', [$partner->id, 'picking' ]) }}" class="navi-link py-4 {{ $page == 'picking' ? 'active' : '' }}">
                        <span class="navi-text font-size-lg"><i class="icon-x text-dark-10 flaticon2-lorry"></i> {{ trans('Partner::partner.edit.header_picking_address') }}</span>
                    </a>
                </div>

                <div class="navi-item mb-2">
                    <a href="{{ route('PartnerEdit', [$partner->id, 'user' ]) }}" class="navi-link py-4 {{ $page == 'user' ? 'active' : '' }}">
                        <span class="navi-text font-size-lg"><i class="icon-x text-dark-10 flaticon-users"></i> {{ trans('Partner::partner.edit.header_user') }}</span>
                    </a>
                </div>

            </div>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>
