<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="ASIFRAZA">
    <title>{{ (isset($title)) ? $title : '' }} - PARTY TONIGHT ADMIN</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    @yield('extra-css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    @include('layouts.include.navbar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- @include('sweetalert::alert') --}}
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">2022 &copy; Tonight-Party</span><span class="float-right d-sm-inline-block d-none"><i class="bx bxs-heart pink mx-50 font-small-3"></i><a class="text-uppercase" href="#" target="_blank">Tonight-Party</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/scripts/configs/vertical-menu-dark.js')}}"></script>
    <script src="{{ asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js')}}"></script>
    <script src="{{ asset('app-assets/js/scripts/footer.js')}}"></script>
    <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <!-- END: Page JS-->

    @yield('extra-js')
    <script>
        $(document).ready(function() {
            console.log('errors ');
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif(Session::has('errors'))
            let errors = Session::get('errors');
            console.log('errors ', errors);
            return false;
            errors.forEach(element => {
                toastr.error(element);
                });
            @endif
        });

    </script>
</body>
<!-- END: Body-->

</html>
