<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <title>{{ isset($title) ? $title : '' }} - PARTY TONIGHT ADMIN</title>

    <!-- Stylesheets
    ================================================= -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}" />
    @yield('css')
</head>

<body>

    <!-- Header
    ================================================= -->
    @include('frontend.layouts.include.sidebar')
    <!--Header End-->

    <!-- Landing Page Contents
    ================================================= -->
    @yield('content')


        <!-- Footer
    ================================================= -->
    <footer id="footer" style="{{ (isset($noFooter) && $noFooter) ? 'display:none' : null }}">
        <div class="container">
            <div class="row">
                <div class="footer-wrapper">
                    <div class="col-md-3 col-sm-3">
                        {{-- <a href=""><img src="{{ asset('frontend/images/logo-black.png') }}" alt="" class="footer-logo" /></a> --}}
                        <a href="{{ route('client.news.feed') }}"><h3 class="bold" style="margin: auto; color: black; font-weight: bolder; font-family: serif;">PARTY TONIGHT</h3></a>
                        <ul class="list-inline social-icons">
                            <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h6>For individuals</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('login', ['filter' => 'register']) }}">Signup</a></li>
                            <li><a href="{{ route('login', ['filter' => 'login']) }}">login</a></li>
                            <li><a href="{{ route('client.news.feed') }}">Explore</a></li>
                            <li><a href="#">Mobile App</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h6>About</h6>
                        <ul class="footer-links">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <h6>Contact Us</h6>
                        <ul class="contact">
                            <li><i class="icon ion-ios-telephone-outline"></i>+1 (234) 222 0754</li>
                            <li><i class="icon ion-ios-email-outline"></i>info@party-tonight.com</li>
                            <li><i class="icon ion-ios-location-outline"></i>228 Park Ave S NY, USA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>copyright PARTY TONIGHT 2022. All rights reserved</p>
        </div>
    </footer>

    <!--preloader-->
    <div id="spinner-wrapper">
        <div class="spinner"></div>
    </div>

    <!-- Scripts
          ================================================= -->
    <script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.incremental-counter.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>

    @yield('js')

    <script>
        $(document).ready(function () {
            setTimeout(() => {
                $('#header').addClass('visible')
            }, 100);
        });
    </script>
</body>

</html>
