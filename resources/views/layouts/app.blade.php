<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    @stack('css_plugins')
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />    
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />    
    <!--end::Global Stylesheets Bundle-->
    @stack('css_custom')
</head>
<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
    var defaultThemeMode = "light";
    var themeMode; 
    if ( document.documentElement ) { 
        if ( document.documentElement.hasAttribute("data-theme-mode")) { 
            themeMode = document.documentElement.getAttribute("data-theme-mode"); 
        } else { 
            if ( localStorage.getItem("data-theme") !== null ) { 
                themeMode = localStorage.getItem("data-theme");
            } else { 
                themeMode = defaultThemeMode; 
            } 
        } 
        if (themeMode === "system") { 
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        } 
        document.documentElement.setAttribute("data-theme", themeMode); 
    }
    </script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('layouts.partials.header')	
            <!--end::Header-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        @yield('content')
                    </div>
                    <!--begin::Footer-->
                    @include('layouts.partials.footer')
                    <!--end::Footer-->
                </div>
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->

    @include('layouts.common.modals')
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script type="text/javascript" src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
@stack('js_plugins')
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
@stack('js_custom')
<!--end::Custom Javascript-->
<!--end::Javascript-->
@include('layouts.common.toastr')
</body>
</html>
