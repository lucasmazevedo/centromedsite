<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
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
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <style>body { background-image: url('{{ asset('/assets/media/auth/bg-medical.png') }}'); } [data-theme="dark"] body { background-image: url('assets/media/auth/bg-dark.jpg'); }</style>
            <div class="d-flex flex-column flex-column-fluid flex-lg-row">
                <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                    <div class="d-flex flex-center flex-lg-start flex-column">
                        <a href="/" class="mb-7">
							<img alt="Logo" src="{{ asset('/assets/media/logos/logo-dark.png') }}" height="50px" />
						</a>
                        <h2 class="text-dark fw-normal m-0">Sistemas Integrados de Saúde</h2>
                    </div>
                </div>
                <div class="d-flex flex-center w-lg-50 p-10">
                    @yield('content')
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
        @include('layouts.common.toastr')
</body>
</html>
