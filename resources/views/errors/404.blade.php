<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ asset('') }}">
    <meta charset="utf-8" />
    <title>KHÔNG TÌM THẤY TRANG</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/chosen.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pe-icon-7-stroke.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.scrollbar.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/lightbox.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/magnific-popup.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/flaticon.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/megamenu.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dreaming-attribute.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/styles.css')}}" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div id="app-container" data-radium="true" style="display: block; min-height: 50px;"></div>
    <div
        style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; max-width: 550px; padding: 50px 0px 70px; margin: 0px auto;">
        <img alt="" src="assets/images/404.png"
            style="display: block; width: 300px; height: auto; min-width: 100px; min-height: 100px; margin-bottom: 10px; pointer-events: none;">
        <div style="margin-bottom: 40px;">
            <div
                style="font-size: 24px; line-height: 32px; margin-bottom: 10px; font-weight: 700; text-align: center; color: rgb(151, 153, 154);">
                Có gì đó sai sai</div>
            <div style="font-size: 16px; color: rgb(151, 153, 154); text-align: center; width: 100%; margin: 0px auto;">
                Có vẻ như bạn đã vào địa chỉ không đúng</div>
            <div style="font-size: 16px; color: rgb(151, 153, 154); text-align: center; width: 100%; margin: 0px auto;">
                hoặc sản phẩm không còn bán trên Evashopping</div>
        </div>
        <div class="btn-cont">
            <a class="btn" id="xemthem" href="{{ route('home') }}" style="display: block;">
                Trang chủ
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
                <span class="line-4"></span>
            </a>
        </div>
    </div>
    </div>
    <!--end::Main-->
    <script>
    var HOST_URL = "https://keenthemes.com/metronic/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="admin/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
    <script src="admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
    <script src="admin/assets/js/scripts.bundle.js?v=7.0.5"></script>
    <!--end::Global Theme Bundle-->
</body>
<!--end::Body-->

</html>