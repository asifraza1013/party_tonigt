@extends('layouts.app', ['title' => __('Mobile App User Detail')])

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-user-profile.css') }}">
@endsection
@section('content')
    <!-- page user profile start -->
    <section class="page-user-profile">
        <div class="row">
            <div class="col-12">
                <!-- user profile heading section start -->
                <div class="card">
                    <div class="card-content">
                        <div class="user-profile-images">
                            <!-- user timeline image -->
                            <img src="{{ asset('app-assets/images/profile/post-media/profile-banner.jpg') }}"
                                class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                            <!-- user profile image -->
                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-16.jpg') }}"
                                class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                        </div>
                        <div class="user-profile-text">
                            <h4 class="mb-0 text-bold-500 profile-text-color">{{ $user->first_name }}  {{ $user->last_name }}</h4>
                            <small>Devloper</small>
                        </div>
                        <!-- user profile nav tabs start -->
                        <div class="card-body px-0">
                            <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                <li class="nav-item pb-0">
                                    <a class=" nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Feed</span></a>
                                </li>
                                <li class="nav-item pb-0">
                                    <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Friends</span></a>
                                </li>
                                <li class="nav-item pb-0 mr-0">
                                    <a class="nav-link d-flex px-1" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i class="bx bx-copy-alt"></i><span class="d-none d-md-block">Profile</span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- user profile nav tabs ends -->
                    </div>
                </div>
                <!-- user profile heading section ends -->

                <!-- user profile content section start -->
                <div class="row">
                    <!-- user profile nav tabs content start -->
                    <div class="col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                <!-- user profile nav tabs feed start -->
                                <div class="row">
                                    <!-- user profile nav tabs feed left section start -->
                                    <div class="col-lg-4">
                                        <!-- user profile nav tabs feed left section today's events card start -->
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-1">Today's Events<i
                                                            class="cursor-pointer bx bx-dots-vertical-rounded float-right"></i>
                                                    </h5>
                                                    <div class="user-profile-event">
                                                        <div class="pb-1 d-flex align-items-center">
                                                            <i
                                                                class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                            <small>10:00am</small>
                                                        </div>
                                                        <h6 class="text-bold-500 font-small-3">Breakfast at the agency</h6>
                                                        <p class="text-muted font-small-2">Multi language support enable
                                                            you to create your
                                                            personalized apps in your language.</p>
                                                        <i class="cursor-pointer bx bx-map text-muted align-middle"></i>
                                                        <span class="text-muted"><small>Monkdev Agency</small></span>
                                                        <!-- user profile likes avatar start -->
                                                        <ul
                                                            class="list-unstyled users-list d-flex align-items-center mt-1">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-placement="bottom" title="Lilian Nenez"
                                                                class="avatar pull-up">
                                                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-21.jpg') }}"
                                                                    alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-placement="bottom" title="Alberto Glotzbach"
                                                                class="avatar pull-up">
                                                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-22.jpg') }}"
                                                                    alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-placement="bottom" title="Alberto Glotzbach"
                                                                class="avatar pull-up">
                                                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-23.jpg') }}"
                                                                    alt="Avatar" height="30" width="30">
                                                            </li>
                                                            <li class="pl-50 text-muted font-small-3">
                                                                +10 more
                                                            </li>
                                                        </ul>
                                                        <!-- user profile likes avatar ends -->
                                                    </div>
                                                    <hr>
                                                    <div class="user-profile-event">
                                                        <div class="pb-1 d-flex align-items-center">
                                                            <i
                                                                class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                            <small>10:00pm</small>
                                                        </div>
                                                        <h6 class="text-bold-500 font-small-3">Work eith persistance and
                                                            you can achive it.</h6>
                                                    </div>
                                                    <hr>
                                                    <div class="user-profile-event">
                                                        <div class="pb-1 d-flex align-items-center">
                                                            <i
                                                                class="cursor-pointer bx bx-radio-circle-marked text-primary mr-25"></i>
                                                            <small>6:00am</small>
                                                        </div>
                                                        <div class="pb-1">
                                                            <h6 class="text-bold-500 font-small-3">Take that granted hotdog
                                                            </h6>
                                                            <i
                                                                class="cursor-pointer bx bx-map text-muted align-middle"></i>
                                                            <span class="text-muted"><small>Monkdev Agency</small></span>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-block btn-secondary">Check all your
                                                        Events</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user profile nav tabs feed left section today's events card ends -->
                                    </div>
                                    <!-- user profile nav tabs feed left section ends -->
                                    <!-- user profile nav tabs feed middle section start -->
                                    <div class="col-lg-8">
                                         <!-- user profile nav tabs feed middle section user-3 card starts -->
                                         <div class="card">
                                            <div class="card-content">
                                                <div class="card-header user-profile-header">
                                                    <div class="avatar mr-50 align-top">
                                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-14.jpg') }}"
                                                            alt="avtar images" width="32" height="32">
                                                        <span class="avatar-status-online"></span>
                                                    </div>
                                                    <div class="d-inline-block mt-25">
                                                        <h6 class="mb-0 text-bold-500">Anna Mull</h6>
                                                        <p class="text-muted"><small>7 hours ago</small></p>
                                                    </div>
                                                    <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                </div>
                                                <div class="card-body py-0">
                                                    <p>To avoid winding up with a large bundle, it’s good to get ahead of
                                                        the problem and use "Code
                                                        Splitting 🕹".</p>
                                                    <img src="{{ asset('app-assets/images/profile/post-media/2.jpg') }}"
                                                        alt="user image" class="img-fluid">
                                                </div>
                                                <div class="card-footer d-flex justify-content-between pt-1">
                                                    <div class="d-flex align-items-center">
                                                        <!-- user profile likes avatar start -->
                                                        <div class="d-none d-sm-block">
                                                            <ul
                                                                class="list-unstyled users-list m-0 d-flex align-items-center ml-1">
                                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-placement="bottom" title="Lilian Nenez"
                                                                    class="avatar pull-up">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                        alt="Avatar" height="30" width="30">
                                                                </li>
                                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-placement="bottom" title="Alberto Glotzbach"
                                                                    class="avatar pull-up">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-12.jpg') }}"
                                                                        alt="Avatar" height="30" width="30">
                                                                </li>
                                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-placement="bottom" title="Alberto Glotzbach"
                                                                    class="avatar pull-up">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-13.jpg') }}"
                                                                        alt="Avatar" height="30" width="30">
                                                                </li>
                                                                <li class="d-inline-block pl-50">
                                                                    <p class="text-muted mb-0 font-small-3">+10 more</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- user profile likes avatar ends -->
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                        <span class="ml-25">12</span>
                                                        <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                        <span class="ml-25">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user profile nav tabs feed middle section user-3 card ends -->
                                        <!-- user profile nav tabs feed middle section story swiper start -->
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-0">Stories</h5>
                                                    <div class="user-profile-stories swiper-container pt-1">
                                                        <div class="swiper-wrapper user-profile-images">
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('app-assets/images/profile/portraits/avatar-portrait-1.jpg') }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    alt="story image">
                                                                <div class="card-img-overlay bg-overlay">
                                                                    <div class="user-swiper-text">ureka_23</div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('app-assets/images/profile/portraits/avatar-portrait-2.jpg') }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    alt="story image">
                                                                <div class="card-img-overlay bg-overlay">
                                                                    <div class="user-swiper-text">devine_lena</div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('app-assets/images/profile/portraits/avatar-portrait-3.jpg') }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    alt="story image">
                                                                <div class="card-img-overlay bg-overlay">
                                                                    <div class="user-swiper-text">venice_like852</div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('app-assets/images/profile/portraits/avatar-portrait-4.jpg') }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    alt="story image">
                                                                <div class="card-img-overlay bg-overlay">
                                                                    <div class="user-swiper-text">june5211</div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('app-assets/images/profile/portraits/avatar-portrait-5.jpg') }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    alt="story image">
                                                                <div class="card-img-overlay bg-overlay">
                                                                    <div class="user-swiper-text">defloya_456</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user profile nav tabs feed middle section story swiper ends -->
                                        <!-- user profile nav tabs feed middle section user-4 card starts -->
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-header user-profile-header">
                                                    <div class="avatar mr-50 align-top">
                                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-18.jpg') }}"
                                                            alt="avtar images" width="32" height="32">
                                                        <span class="avatar-status-online"></span>
                                                    </div>
                                                    <div class="d-inline-block mt-25">
                                                        <h6 class="mb-0 text-bold-500">Petey Cruiser</h6>
                                                        <p class="text-muted"><small>21 hours ago</small></p>
                                                    </div>
                                                    <i class='cursor-pointer bx bx-dots-vertical-rounded float-right'></i>
                                                </div>
                                                <div class="card-body py-0">
                                                    <p>It's more efficient 🙌 to split each route's components into a
                                                        separate chunk, and only load them when the route is visited. Frest
                                                        comes with built-in light and dark layouts, select as per your
                                                        preference.</p>
                                                </div>
                                                <div class="card-footer d-flex justify-content-between pt-1">
                                                    <div class="d-flex align-items-center">
                                                        <i class="cursor-pointer bx bx-comment-dots font-medium-4"></i>
                                                        <span class="ml-25">0</span>
                                                        <i class="cursor-pointer bx bx-share-alt font-medium-4 ml-1"></i>
                                                        <span class="ml-25">2</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user profile nav tabs feed middle section user-4 card ends -->
                                    </div>
                                    <!-- user profile nav tabs feed middle section ends -->
                                </div>
                                <!-- user profile nav tabs feed ends -->
                            </div>
                            <div class="tab-pane" id="friends" aria-labelledby="friends-tab" role="tabpanel">
                                <!-- user profile nav tabs friends start -->
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5>Friends</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-2.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-online"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Petey Cruiser</a></h6>
                                                                <small class="text-muted">Flask</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-3.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-offline"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Anna Sthesia</a></h6>
                                                                <small class="text-muted">Devloper</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-4.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-busy"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Paul Molive</a></h6>
                                                                <small class="text-muted">Designer</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-5.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-busy"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Anna Mull</a></h6>
                                                                <small class="text-muted">Worker</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-5.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-away"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Gail Forcewind</a></h6>
                                                                <small class="text-muted">Lawyer</small>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-16.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-offline"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Paige Turner</a></h6>
                                                                <small class="text-muted">Student</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-busy"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Bob Frapples</a></h6>
                                                                <small class="text-muted">Professor</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-8.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-online"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Mario super</a></h6>
                                                                <small class="text-muted">Scientist</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-2.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-online"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Petey Cruiser</a></h6>
                                                                <small class="text-muted">Flask</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-3.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-offline"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Anna Sthesia</a></h6>
                                                                <small class="text-muted">Devloper</small>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h5 class="mt-2">Mutual Friends</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-26.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-online"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">jackeu decoy</a></h6>
                                                                <small class="text-muted">Network</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-25.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-offline"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Sthesia Anna</a></h6>
                                                                <small class="text-muted">Devloper</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-24.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-busy"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Molive Paul</a></h6>
                                                                <small class="text-muted">Designer</small>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-23.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-busy"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Mull Anna</a></h6>
                                                                <small class="text-muted">Worker</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-22.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-away"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Forcewind Gail</a></h6>
                                                                <small class="text-muted">Lawyer</small>
                                                            </div>
                                                        </li>
                                                        <li class="media my-50">
                                                            <a href="JavaScript:void(0);">
                                                                <div class="avatar mr-1">
                                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-21.jpg') }}"
                                                                        alt="avtar images" width="32" height="32">
                                                                    <span class="avatar-status-offline"></span>
                                                                </div>
                                                            </a>
                                                            <div class="media-body">
                                                                <h6 class="media-heading mb-0"><a
                                                                        href="javaScript:void(0);">Paige Turner</a></h6>
                                                                <small class="text-muted">Student</small>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- user profile nav tabs friends ends -->
                            </div>
                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <!-- user profile nav tabs profile start -->
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-16.jpg') }}"
                                                                class="rounded" alt="group image" height="120"
                                                                width="120" />
                                                        </div>
                                                        <div class="col-12 col-sm-9">
                                                            <div class="row">
                                                                <div class="col-12 text-center text-sm-left">
                                                                    <h6 class="media-heading mb-0">valintini_007<i
                                                                            class="cursor-pointer bx bxs-star text-warning ml-50 align-middle"></i>
                                                                    </h6>
                                                                    <small class="text-muted align-top">{{ $user->first_name }}  {{ $user->last_name }}</small>
                                                                </div>
                                                                <div class="col-12 text-center text-sm-left">
                                                                    <div class="mb-1">
                                                                        <span class="mr-1">122
                                                                            <small>Posts</small></span>
                                                                        <span class="mr-1">4.7k
                                                                            <small>Followers</small></span>
                                                                        <span class="mr-1">652
                                                                            <small>Following</small></span>
                                                                    </div>
                                                                    <p>Algolia helps businesses across industries quickly
                                                                        create relevant😎, scalable😀, and
                                                                        lightning😍
                                                                        fast search and discovery experiences.</p>
                                                                    <button
                                                                        class="btn btn-sm d-none d-sm-block float-right btn-light-primary">
                                                                        <i
                                                                            class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edit</span>
                                                                    </button>
                                                                    <button
                                                                        class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary">
                                                                        <i
                                                                            class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Edit</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h5 class="card-title">Basic details</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>California</li>
                                                <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i>(+56) 454
                                                    45654 </li>
                                                <li><i class="cursor-pointer bx bx-time mb-1 mr-50"></i>July 10</li>
                                                <li><i
                                                        class="cursor-pointer bx bx-envelope mb-1 mr-50"></i>{{ $user->email }}
                                                </li>
                                            </ul>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6><small class="text-muted">Cell Phone</small></h6>
                                                    <p>(+46) 456 54432</p>
                                                </div>
                                                <div class="col-6">
                                                    <h6><small class="text-muted">Family Phone</small></h6>
                                                    <p>(+46) 454 22432</p>
                                                </div>
                                                <div class="col-6">
                                                    <h6><small class="text-muted">Reporter</small></h6>
                                                    <p>John Doe</p>
                                                </div>
                                                <div class="col-6">
                                                    <h6><small class="text-muted">Manager</small></h6>
                                                    <p>Richie Rich</p>
                                                </div>
                                                <div class="col-12">
                                                    <h6><small class="text-muted">Bio</small></h6>
                                                    <p>Built-in customizer enables users to change their admin panel look &
                                                        feel based on their
                                                        preferences Beautifully crafted, clean & modern designed admin theme
                                                        with 3 different demos &
                                                        light - dark versions.</p>
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-sm d-none d-sm-block float-right btn-light-primary mb-2">
                                                <i
                                                    class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edit</span>
                                            </button>
                                            <button
                                                class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary">
                                                <i
                                                    class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Edit</span></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- user profile nav tabs profile ends -->
                            </div>
                        </div>
                    </div>
                    <!-- user profile nav tabs content ends -->
                    <!-- user profile right side content start -->
                    <div class="col-lg-3">
                        <!-- user profile right side content related groups start -->
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Related Groups
                                        <i class="cursor-pointer bx bx-dots-vertical-rounded align-top float-right"></i>
                                    </h5>
                                    <div class="media d-flex align-items-center mb-1">
                                        <a href="JavaScript:void(0);">
                                            <img src="{{ asset('app-assets/images/banner/banner-30.jpg') }}" class="rounded"
                                                alt="group image" height="64" width="64" />
                                        </a>
                                        <div class="media-body ml-1">
                                            <h6 class="media-heading mb-0"><small>Play Guitar</small></h6><small
                                                class="text-muted">2.8k
                                                members (7 joined)</small>
                                        </div>
                                        <i
                                            class="cursor-pointer bx bx-plus-circle text-primary d-flex align-items-center "></i>
                                    </div>
                                    <div class="media d-flex align-items-center mb-1">
                                        <a href="JavaScript:void(0);">
                                            <img src="{{ asset('app-assets/images/banner/banner-31.jpg') }}" class="rounded"
                                                alt="group image" height="64" width="64" />
                                        </a>
                                        <div class="media-body ml-1">
                                            <h6 class="media-heading mb-0"><small>Generic memes</small></h6><small
                                                class="text-muted">9k
                                                members (7 joined)</small>
                                        </div>
                                        <i
                                            class="cursor-pointer bx bx-plus-circle text-primary d-flex align-items-center "></i>
                                    </div>
                                    <div class="media d-flex align-items-center">
                                        <a href="JavaScript:void(0);">
                                            <img src="{{ asset('app-assets/images/banner/banner-32.jpg') }}" class="rounded"
                                                alt="group image" height="64" width="64" />
                                        </a>
                                        <div class="media-body ml-1">
                                            <h6 class="media-heading mb-0"><small>Cricket fan club</small></h6><small
                                                class="text-muted">7.6k
                                                members</small>
                                        </div>
                                        <i class="cursor-pointer bx bx-lock text-muted d-flex align-items-center"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user profile right side content related groups ends -->
                        <!-- user profile right side content gallery start -->
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">Gallery
                                        <i class="cursor-pointer bx bx-dots-vertical-rounded align-top float-right"></i>
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-10.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-11.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-12.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-13.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-05.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-06.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-07.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-08.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                        <div class="col-md-4 col-6 pl-25 pr-0 pb-25">
                                            <img src="{{ asset('app-assets/images/profile/user-uploads/user-09.jpg') }}"
                                                class="img-fluid" alt="gallery avtar img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- user profile right side content gallery ends -->
                    </div>
                    <!-- user profile right side content ends -->
                </div>
                <!-- user profile content section start -->
            </div>
        </div>
    </section>
    <!-- page user profile ends -->
@endsection

@section('extra-js')
<script src="{{ asset('app-assets/vendors/js/extensions/swiper.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/page-user-profile.js') }}"></script>
@endsection
