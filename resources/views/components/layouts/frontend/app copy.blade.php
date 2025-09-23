<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>GA STORE</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{ asset('assets/assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('assets/vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/assets/js/config.js')}}"></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{ asset('assets/assets/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('assets/assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/assets/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('assets/assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('assets/assets/css/user.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>

    <style>
        .ecommerce-navbar .nav-item .nav-link.active,
        .ecommerce-navbar .nav-item .nav-link:hover {
            color: #003ae9 !important;
            text-decoration: underline !important;
            font-size: 13px !important;
        }
    </style>



    @livewireStyles
    @stack('styles')
</head>


<body class="d-flex flex-column min-vh-100">
    <main class="main flex-grow-1" id="top" style="background: #f2eded !important;">
        @include('components.layouts.frontend.header')
        @include('components.layouts.frontend.navbar')

        <section class="pt-5 pb-9 flex-grow-1" style="background: #f2eded;">
            <div class="product-filter-container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </section>
    </main>

    <footer class="footer mt-auto" style="background: #940808de !important;">
        <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 mt-2 mt-sm-0 text-body" style="color: white !important;">GA STORE | 2024 &copy;<a class="mx-1" href="javascript:void(0)" style="color: white !important;">PT BONECOM INTI TECHNOLOGY</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-body-tertiary text-opacity-85" style="color: white !important;">v1.17.0</p>
            </div>
        </div>
    </footer>


    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('assets/vendors/popper/popper.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/anchorjs/anchor.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/is/is.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/lodash/lodash.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('assets/vendors/list.js/list.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/dayjs/dayjs.min.js')}}"></script>
    <script src="{{ asset('assets/assets/js/phoenix.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('scripts')

    <script>
        window.addEventListener('update-url', event => {
            history.pushState({}, '', event.detail.url);
        });

        document.addEventListener('livewire:navigate', () => {
            let userLinkDefault = document.getElementById('user-style-default');
            let userLinkRTL = document.getElementById('user-style-rtl');

            if (userLinkDefault) {
                userLinkDefault.removeAttribute('disabled');
            }
            if (userLinkRTL) {
                userLinkRTL.removeAttribute('disabled');
            }
        });
    </script>
</body>

</html>