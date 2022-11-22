@extends('frontend.layouts.layouts', ['title' => __('Landing Page')])
@section('content')
    <!-- Top Banner
        ================================================= -->
    <section id="banner" style="background: url('{{ asset("frontend/images/Rectangle 158.png") }}') fixed no-repeat; background-color: black;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 style="font-size: 40px;font-weight: bold; color:white">PARTY TONIGHT IS A
                        PARTY EXPLORER APP</h1>
                    <h4 style="color:white">Help you discover best parties, Pubs, Lounges,
                        Artists, Deals and offers.</h4>
                </div>
                <div class="col-lg-6">
                    <div class="banner" style="text-align: end">
                        <img src="{{ asset('frontend/images/Home page 2.png') }}" alt="" style="position: absolute; right: 0px">
                        <img src="{{ asset('frontend/images/Home page 1.png') }}" alt="">
                    </div>
                </div>
            </div>
            <svg class="arrows hidden-xs hidden-sm">
                <path class="a1" d="M0 0 L30 32 L60 0"></path>
                <path class="a2" d="M0 20 L30 52 L60 20"></path>
                <path class="a3" d="M0 40 L30 72 L60 40"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section
    ================================================= -->
    <section id="features">
        <div class="container wrapper">
            <h1 class="section-title slideDown">social herd</h1>
            <div class="row slideUp">
                <div class="feature-item col-md-2 col-sm-6 col-xs-6 col-md-offset-2">
                    <div class="feature-icon"><i class="icon ion-pinpoint"></i></div>
                    <h3>REQUEST A TABLE</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-images"></i></div>
                    <h3>PARTIES</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-chatbox-working"></i></div>
                    <h3>EVENTS</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-compose"></i></div>
                    <h3>BOOK TICKET</h3>
                </div>
            </div>
            <h2 class="sub-title">find awesome people like you</h2>
            <div id="incremental-counter" data-value="101242"></div>
            <p>People Already Signed Up</p>
            <img src="{{ asset('frontend/images/face-map.png') }}" alt="" class="img-responsive face-map slideUp hidden-sm hidden-xs" />
        </div>

    </section>

    <!-- Download Section
    ================================================= -->
    <section id="app-download" style="background-color: #414141">
        <div class="container wrapper">
            <h1 class="section-title slideDown">Coming Soon...</h1>
            <ul class="app-btn list-inline slideUp">
                <li><button class="btn-secondary"><img src="{{ asset('frontend/images/app-store.png') }}" alt="App Store" /></button></li>
                <li><button class="btn-secondary"><img src="{{ asset('frontend/images/google-play.png') }}" alt="Google Play" /></button></li>
            </ul>
            <h2 class="sub-title">stay connected anytime, anywhere</h2>
            <img src="{{ asset('frontend/images/mockup 1.png') }}" alt="iPhone" class="img-responsive" />
        </div>
    </section>

    <!-- Image Divider
    ================================================= -->
    <div class="img-divider hidden-sm hidden-xs" style="background-image: url('{{ asset('frontend/images/Group 1.png') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h1 style="margin-top: revert; font-size: 40px; font-weight: bolder;">CONNECT WITH PEOPLE AROUND <br> <br>
                        THE WORLD AND SHARE <br> <br>
                        YOUR EXPERIENCES.</h1>
                    <p>Share your experiences with friends, parties, events,
                        photos, videos and more</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Facts Section
    ================================================= -->
    <section id="site-facts">
        <div class="container wrapper">
            <div class="circle">
                <ul class="facts-list">
                    <li>
                        <div class="fact-icon"><i class="icon ion-ios-people-outline"></i></div>
                        <h3 class="text-white">1,01,242</h3>
                        <p>People registered</p>
                    </li>
                    <li>
                        <div class="fact-icon"><i class="icon ion-images"></i></div>
                        <h3 class="text-white">21,01,242</h3>
                        <p>Posts published</p>
                    </li>
                    <li>
                        <div class="fact-icon"><i class="icon ion-checkmark-round"></i></div>
                        <h3 class="text-white">41,242</h3>
                        <p>People online</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
