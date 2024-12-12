<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon icon -->
    <link rel="icon" href="assets/images/favicon.png">

    {{-- Set default og tags for preliminary SEO --}}
    <meta property="og:sitename" content="SLIMES Lab">
    <meta property="og:title" content="SLIMES Lab">
    <meta property="og:description"
        content="SLIMES Lab | Pioneering material simulations and next-gen electronic property explorations.">
    <meta property="og:image" content="{{ asset('assets/images/favicon.png') }}">
    <meta property="og:image:width" content="100">
    <meta property="og:image:height" content="100">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:alt" content="SLIMES Lab">
    <meta property="twitter:image" content="{{ asset('assets/images/favicon.png') }}">
    <meta property="twitter:title" content="SLIMES Lab">
    <meta property="twitter:description"
        content="SLIMES Lab | Pioneering material simulations and next-gen electronic property explorations.">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- All CSS Files Here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/et-line-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/academicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-style.css') }}">
    @yield('styles')

    <script src="{{ asset('assets/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    {{-- @if (request()->is('/')) --}}
    @include('frontend.components.frontend-navbar', ['isHome' => request()->is('/')])
    <main>
        @yield('content')
    </main>

    @include('frontend.components.frontend-footer')

    <!-- loader -->
    {{-- <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div> --}}

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap-theme.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script type="text/javascript">
        // grab an element
        var myElement = document.querySelector(".headroom");
        // construct an instance of Headroom, passing the element
        var headroom = new Headroom(myElement);
        // initialise
        headroom.init();
    </script>
    <script src="{{ asset('assets/js/theme-main.js') }}"></script>
    @yield('scripts')
    <a id="scrollUp" href="#top" style="display: none; position: fixed; z-index: 2147483647;"><i
            class="ion-chevron-up"></i></a>
</body>

</html>
