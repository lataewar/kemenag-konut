<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <base href="">
  <meta charset="utf-8" />
  <title>{{ $title ?? config('app.name') }}</title>
  <meta name="description" content="Updates and statistics" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Page Vendors Styles(used by this page)-->
  @stack('css')
  <!--end::Page Vendors Styles-->
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="{{ asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css') }}/style.css" rel="stylesheet" type="text/css" />
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <!--end::Layout Themes-->
  <link rel="shortcut icon" href="{{ asset('media/web_icon.ico') }}" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url({{ asset('assets') }}/media/bg/bg-10.jpg)"
  class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled">
  <!-- Loader -->
  <div id="preloader_">
    <div id="status_">
      <div class="spinner_"></div>
    </div>
  </div>

  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile">
    <!--begin::Logo-->
    <a href="{{ route('dashboard') }}">
      <img alt="Logo" src="{{ asset('media/logo-white.png') }}" class="logo-default max-h-30px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
        <span></span>
      </button>
      <button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:/assets/media/svg/icons/General/User.svg-->
          {!! file_get_contents('assets/media/svg/icons/General/User.svg') !!}
          <!--end::Svg Icon-->
        </span>
      </button>
    </div>
    <!--end::Toolbar-->
  </div>
  <!--end::Header Mobile-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header header-fixed">
          <!--begin::Container-->
          <div class="container d-flex align-items-stretch justify-content-between">
            <!--begin::Left-->
            <div class="d-flex align-items-stretch mr-3">
              <!--begin::Header Logo-->
              <div class="header-logo">
                <a href="{{ route('dashboard') }}">
                  <img alt="Logo" src="{{ asset('media/logo-white.png') }}" class="logo-default max-h-40px" />
                  <img alt="Logo" src="{{ asset('media/logo-dark.png') }}" class="logo-sticky max-h-40px" />
                </a>
              </div>
              <!--end::Header Logo-->
              <!--begin::Header Menu Wrapper-->
              @include('layouts.menu')
              <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Left-->
            <!--begin::Topbar-->
            <div class="topbar">
              <!--begin::User-->
              <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item">
                  <div
                    class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto"
                    id="kt_quick_user_toggle">
                    <span
                      class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hai,</span>
                    <span
                      class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">{{ auth()->user()->name }}</span>
                    <span class="symbol symbol-35">
                      <span
                        class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </span>
                  </div>
                </div>
                <!--end::Toggle-->
              </div>
              <!--end::User-->
            </div>
            <!--end::Topbar-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
          <!--begin::Subheader-->
          <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
            @yield('subheader')
          </div>
          <!--end::Subheader-->
          <!--begin::Entry-->

          <div class="d-flex flex-column-fluid">
            <div class="container" id="container_content">

              @yield('content')

            </div>
          </div>

          <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <!--begin::Container-->
          <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">{{ date('Y') }}©</span>
              <a href="#" target="_blank" class="text-dark-75 text-hover-primary">kemenagkonut</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Nav-->
            <div class="nav nav-dark order-1 order-md-2">

            </div>
            <!--end::Nav-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Main-->
  <!-- begin::User Panel-->
  @include('layouts.user-panel')
  <!-- end::User Panel-->

  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Navigation/Up-2.svg-->
      {!! file_get_contents('assets/media/svg/icons/Navigation/Up-2.svg') !!}
      <!--end::Svg Icon-->
    </span>
  </div>
  <!--end::Scrolltop-->
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1200
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#6993FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#F3F6F9",
            "dark": "#212121"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1E9FF",
            "secondary": "#ECF0F3",
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
            "secondary": "#212121",
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
          "gray-200": "#ECF0F3",
          "gray-300": "#E5EAEE",
          "gray-400": "#D6D6E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#80808F",
          "gray-700": "#464E5F",
          "gray-800": "#1B283F",
          "gray-900": "#212121"
        }
      },
      "font-family": "Poppins"
    };
  </script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="{{ asset('assets') }}/plugins/global/plugins.bundle.js"></script>
  <script src="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/scripts.bundle.js"></script>
  <!--end::Global Theme Bundle-->
  <!--begin::Page Scripts(used by this page)-->
  @stack('js')
  <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
