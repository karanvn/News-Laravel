<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->

        <a href="{{ route('Dashboard') }}" class="brand-logo">
            <img src="admin/assets/media/logos/logo.png" class="max-h-25px" alt="" />
        </a>

        {{--<span class="text-white display-5">MENU</span>--}}
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:admin/assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('Dashboard') }}" class="menu-link">
                        <span class="menu-text"><i
                                class="icon-x text-dark-50 flaticon-home-2"></i>&nbsp;&nbsp;{{ trans('menu.Dashboard.home') }}</span>
                    </a>
                </li>

                <!--begin::Menu Order-->
                <li class="menu-section">
                    <h4 class="menu-text">{{ trans('menu.menu') }}</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

           
               
                <!--begin::Menu Blog-->
                @php
                    $routeBlog = \Route::current()->getName();
                    //echo substr($routeCurrent,0,4);
                @endphp
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeBlog, 'blog') ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">
                            <i class="icon-x text-dark-50 flaticon2-list-1"></i>&nbsp;&nbsp;{{ trans('menu.blog.header') }}&nbsp;&nbsp;<span
                            class="label label-smx label-white text-dark"><strong>{{ @$blog_total }}</strong></span>
                        </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ $routeName == 'blog-category-list' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('blog-category-list') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Danh mục</span>
                                </a>
                            </li>                            
                            <li class="menu-item menu-item-{{ $routeName == 'blog-list' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('blog-list') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.blog.sub.list') }}&nbsp;&nbsp;</span>
                                </a>
                            </li>
                            <li class="menu-item"
                                aria-haspopup="true">
                                <a href="{{ asset('admins/banner/list?type=CATEGORYBLOG') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Banner Blog</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-{{ $routeName == 'listsCommentBlog' ? 'active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('listsCommentBlog') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Bình luận blog</span>
                            </a>
                        </li>
                        </ul>
                    </div>
                </li>

                <!--end::Menu Blog-->
                <li class="menu-item menu-item-submenu  menu-item-{{ $routeName == 'listvaluate' ? 'active' : '' }}"
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('listvaluate')}}" class="menu-link menu-toggle">
                    <span class="menu-text"><i
                            class="icon-x text-dark-50 flaticon-users-1"></i>&nbsp;&nbsp; Đánh giá
                            {{-- &nbsp;&nbsp;<span
                            class="label label-smx label-white text-dark"><strong>{{ $customer_total }}</strong></span> --}}
                        </span>
                    <i class="menu-arrow"></i>
                </a>
                </li>

                <!--begin::Menu Customer-->
               
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeName, 'Customer') ? 'open' : '' }} menu-item-{{ $routeName == 'listlevel' ? 'active' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i
                                class="icon-x text-dark-50 flaticon-users-1"></i>&nbsp;&nbsp;{{ trans('menu.customer.header') }}
                                {{-- &nbsp;&nbsp;<span
                                class="label label-smx label-white text-dark"><strong>{{ $customer_total }}</strong></span> --}}
                            </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            {{-- <li class="menu-item menu-item-{{ $routeName == 'Customer' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('Customer') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.customer.sub.list') }}</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-{{ $routeName == 'sendmailBirthday' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('sendmailBirthday') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Danh sách mail sinh nhật</span>
                                </a>
                            </li> --}}
                            <li class="menu-item menu-item-{{ $routeName == 'CustomerFeedback' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="/admins/customer/feedback?type=CONTACT" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Danh sách phản hồi</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-{{ $routeName == 'CustomerFeedback' ? 'active' : '' }}"
                            aria-haspopup="true">
                            <a href="/admins/customer/feedback?type=PRICE" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Yêu cầu báo giá</span>
                            </a>
                        </li>
                            {{-- <li class="menu-item menu-item-{{ $routeName == 'registerReciveInfo' ? 'active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('registerReciveInfo') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Đăng ký nhận thông tin</span>
                                </a>
                            </li>
                            @if($auth->can('add customers'))
                            <li class="menu-item menu-item-{{ in_array($routeName, ['CustomerAdd','CustomerEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('CustomerAdd') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.customer.sub.add') }}</span>
                                </a>
                            </li>
                            @endif

                          
                            <li class="menu-item menu-item-{{ $routeName == 'listlevel' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('listlevel') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.level.header') }}</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
               

                <!--begin::Menu Branch-->
                @if($auth->can('view branches'))
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeName, 'Branch') ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i class="icon-x text-dark-50 flaticon-network"></i>
                            &nbsp;&nbsp;{{ trans('menu.branch.header') }}&nbsp;&nbsp;<span
                                class="label label-smx label-white text-dark"><strong>{{ $branch_total }}</strong></span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ $routeName == 'Branch' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('Branch') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.branch.sub.list') }}</span>
                                </a>
                            </li>
                            @if(@$auth->can('add branches'))
                            <li class="menu-item menu-item-{{ in_array($routeName, ['BranchAdd', 'BranchEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('BranchAdd') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.branch.sub.add') }}</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                <!--end::Menu Branch-->

                <!--begin::Menu Banner-->
                @if($auth->can('view banners'))
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeName, 'Banner') ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i
                                class="icon-x text-dark-50 flaticon2-image-file"></i>&nbsp;&nbsp;{{ trans('menu.banner.header') }}&nbsp;&nbsp;<span
                                class="label label-smx label-white text-dark"><strong>{{ $banner_total }}</strong></span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ $routeName == 'Banner' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('Banner') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.banner.sub.list') }}</span>
                                </a>
                            </li>
                            @if($auth->can('view banners'))
                            <li class="menu-item menu-item-{{ in_array($routeName, ['BannerAdd','BannerEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('BannerAdd') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.banner.sub.add') }}</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                <!--end::Menu Banner-->

                <!--begin::Menu Page static-->
                {{-- @if($auth->can('view banners')) --}}
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeName, 'PageStatic') ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i
                                class="icon-x text-dark-50 flaticon2-image-file"></i>&nbsp;&nbsp;{{ trans('menu.page_static.header') }}&nbsp;&nbsp;<span class="label label-smx label-white text-dark"><strong>{{ $page_static_total }}</strong></span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ $routeName == 'PageStatic' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('PageStatic') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.page_static.sub.list') }}</span>
                                </a>
                            </li>
                            {{-- @if($auth->can('view banners')) --}}
                            <li class="menu-item menu-item-{{ in_array($routeName, ['PageStaticAdd','PageStaticEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('PageStaticAdd') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.page_static.sub.add') }}</span>
                                </a>
                            </li>
                            {{-- @endif --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}
                <!--end::Menu Page static-->

               

                <!--begin::Menu Admin-->
                
                <li class="menu-item menu-item-submenu menu-item-{{ in_array($routeName, ['Admin', 'AdminAdd', 'AdminEdit', 'Rule', 'RuleAdd', 'RuleEdit', 'Role', 'RoleAdd', 'RoleEdit', 'Permission', 'PermissionAdd', 'PermissionEdit']) ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i
                                class="icon-x text-dark-50 flaticon2-user-1"></i>&nbsp;&nbsp;{{ trans('menu.admin.header') }}&nbsp;&nbsp;<span
                                class="label label-smx label-white text-dark"><strong>{{ $admin_total }}</strong></span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ in_array($routeName, ['Admin', 'AdminAdd', 'AdminEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('Admin') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.admin.sub.user') }}&nbsp;&nbsp;<span
                                            class="label label-smx label-white text-dark"><strong>{{ $admin_total }}</strong></span></span>
                                </a>
                            </li>

                            {{--
                            <li class="menu-item menu-item-{{ in_array($routeName, ['Rule', 'RuleAdd', 'RuleEdit']) ? 'active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('Rule') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ trans('menu.admin.sub.rule') }}</span>
                            </a>
                </li>
                --}}
                <li class="menu-item menu-item-{{ in_array($routeName, ['Role', 'RoleAdd', 'RoleEdit']) ? 'active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('Role') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ trans('menu.admin.sub.role') }}</span>
                    </a>
                </li>
                <li class="menu-item menu-item-{{ in_array($routeName, ['Permission', 'PermissionAdd', 'PermissionEdit']) ? 'active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('Permission') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ trans('menu.admin.sub.permission') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        </li>
        <!--end::Menu Admin-->
       
                <!--begin::Menu Schema-->
                {{-- @if($auth->can('view banners')) --}}
                <li class="menu-item menu-item-submenu menu-item-{{ str_contains($routeName, 'Schema') ? 'open' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text"><i class="icon-x text-dark-50 flaticon2-image-file"></i>&nbsp;&nbsp;{{ trans('menu.schema.header') }}</span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-{{ $routeName == 'Schema' ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('Schema') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.schema.sub.list') }}</span>
                                </a>
                            </li>
                            {{-- @if($auth->can('view banners')) --}}
                            <li class="menu-item menu-item-{{ in_array($routeName, ['SchemaAdd','SchemaEdit']) ? 'active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('SchemaAdd') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ trans('menu.schema.sub.add') }}</span>
                                </a>
                            </li>
                            {{-- @endif --}}
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}
                <!--end::Menu Schema-->

        <!--begin::Menu Setting-->
        <li class="menu-item menu-item-submenu menu-item-{{ in_array($routeName, ['frmExcelShipping', 'State', 'StateAdd', 'StateEdit', 'District', 'DistrictAdd', 'DistrictEdit', 'Ward', 'WardAdd', 'WardEdit', 'Block', 'BlockAdd', 'BlockEdit', 'Tpl', 'TplAdd', 'TplEdit', 'SettingGeneral']) ? 'open' : '' }}"
            aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text"><i
                        class="icon-x text-dark-50 flaticon2-settings"></i>&nbsp;&nbsp;{{ trans('menu.setting.header') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    {{--
                            <li class="menu-item menu-item-{{ $routeName == 'SettingGeneration' ? 'active' : '' }}"
                    aria-haspopup="true">
                    <a href="#" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ trans('menu.setting.sub.general') }}</span>
                    </a>
        </li>
        <li class="menu-item menu-item-{{ $routeName == 'SettingAccount' ? 'active' : '' }}" aria-haspopup="true">
            <a href="#" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.setting.sub.account') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ $routeName == 'SettingDelivery' ? 'active' : '' }}" aria-haspopup="true">
            <a href="#" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.setting.sub.delivery') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ $routeName == 'SettingPayment' ? 'active' : '' }}" aria-haspopup="true">
            <a href="#" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.setting.sub.payment') }}</span>
            </a>
        </li>
        --}}
        <li class="menu-item menu-item-{{ in_array($routeName, ['State', 'StateAdd', 'StateEdit']) ? 'active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('State') }}" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.location.sub.state') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ in_array($routeName, ['District', 'DistrictAdd', 'DistrictEdit']) ? 'active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('District') }}" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.location.sub.district') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ in_array($routeName, ['Ward', 'WardAdd', 'WardEdit']) ? 'active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('Ward') }}" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.location.sub.ward') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ $routeName == 'SettingGeneral' ? 'active' : '' }}" aria-haspopup="true">
            <a href="{{ route('SettingGeneral') }}" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.setting.sub.general') }}</span>
            </a>
        </li>
        <li class="menu-item menu-item-{{ in_array($routeName, ['Block', 'BlockAdd', 'BlockEdit', 'Tpl', 'TplAdd', 'TplEdit'])  ? 'active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('Block') }}" class="menu-link">
                <i class="menu-bullet menu-bullet-dot">
                    <span></span>
                </i>
                <span class="menu-text">{{ trans('menu.setting.sub.notification') }}</span>
            </a>
        </li>
      
        </ul>
    </div>
    </li>
    <!--end::Menu Admin-->



    </ul>
    <!--end::Menu Nav-->
</div>
<!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>