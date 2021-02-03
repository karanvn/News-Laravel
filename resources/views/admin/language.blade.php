<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
            <img class="h-20px w-20px rounded-sm" src="admin/assets/media/svg/flags/{{ session('icon_lang', config('lang.icon_lang.vi')) }}" alt="" />
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
        <!--begin::Nav-->
        <ul class="navi navi-hover py-4">
            <!--begin::Item-->
            @if(session('site_lang') != 'vi')
            <li class="navi-item active">
                <a href="{{ route('ChangeLanguage', ['vi']) }}" class="navi-link">
                    <span class="symbol symbol-20 mr-3">
                        <img src="admin/assets/media/svg/flags/220-vietnam.svg" alt="" />
                    </span>
                    <span class="navi-text">Việt Nam</span>
                </a>
            </li>
            @endif
            <!--end::Item-->

            <!--begin::Item-->
            @if(session('site_lang') != 'en')
            <li class="navi-item">
                <a href="{{ route('ChangeLanguage', ['en']) }}" class="navi-link">
                    <span class="symbol symbol-20 mr-3">
                        <img src="admin/assets/media/svg/flags/226-united-states.svg" alt="" />
                    </span>
                    <span class="navi-text">English</span>
                </a>
            </li>
            @endif
            <!--end::Item-->
        </ul>
        <!--end::Nav-->
    </div>
    <!--end::Dropdown-->
</div>
