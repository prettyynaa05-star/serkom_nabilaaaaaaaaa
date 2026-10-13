<!DOCTYPE html>
<html lang="id">

<head>
    <title>@yield('title', 'Sistem Informasi Sekolah')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">


    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme="light">


    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    @include('layouts.sidebar')


    @include('layouts.header')

    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarHide = document.getElementById('sidebar-hide');
            const mobileCollapse = document.getElementById('mobile-collapse');
            const sidebar = document.querySelector('.pc-sidebar');

            if (sidebarHide && sidebar) {
                sidebarHide.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('pc-sidebar-hide');
                });
            }

            if (mobileCollapse && sidebar) {
                mobileCollapse.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('mob-sidebar-active');
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
