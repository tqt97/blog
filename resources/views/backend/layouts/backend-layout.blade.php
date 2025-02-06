@props(['pageTitle'])
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title> {{ $pageTitle ?? 'laravel admin' }} </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/style.css') }}" />
    @stack('stylesheets')
</head>

<body>

    {{-- @include('backend.layouts.partials.pre-loader') --}}
    @include('backend.layouts.partials.header')
    @include('backend.layouts.partials.right-sidebar')
    @include('backend.layouts.partials.left-sidebar')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{ $slot }}
            <div class="footer-wrap pd-20 mb-20 card-box">
                Admin dashboard
                <a href="https://github.com/tqt97" target="_blank">TuanTQ</a>
            </div>
        </div>
    </div>

    <!-- welcome modal start -->
    {{-- @include('backend.layouts.partials.welcome-modal') --}}
    <!-- welcome modal end -->

    <!-- js -->
    <script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/layout-settings.js') }}"></script>
    @stack('scripts')
</body>

</html>
