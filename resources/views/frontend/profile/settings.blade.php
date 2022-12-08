@extends('frontend.layouts.layouts', ['title' => $title])
@section('content')
    <div class="container">

        <!-- Timeline
        ================================================= -->
        <div class="timeline">
            <div class="timeline-cover" style="background: url('{{ asset("frontend/images/Rectangle 158.png") }}') no-repeat;">

                <!--Timeline Menu for Large Screens-->
                <div class="timeline-nav-bar hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-info">
                                <img src="{{ getUserProfileImage($user) }}" alt=""
                                    class="img-responsive profile-photo" />
                                <h3>{{ $user->full_name }}</h3>
                                {{-- <p class="text-muted">Creative Director</p> --}}
                            </div>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-inline profile-menu">
                                @include('frontend.profile.profile_menu')
                            </ul>
                            <ul class="follow-me list-inline">
                                <li>{{ $user->followers_count }} people following her</li>
                                {{-- <li><button class="btn-primary">Add Friend</button></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Timeline Menu for Large Screens End-->

                <!--Timeline Menu for Small Screens-->
                <div class="navbar-mobile hidden-lg hidden-md">
                    <div class="profile-info">
                        <img src="{{ getUserProfileImage($user) }}" alt="" class="img-responsive profile-photo" />
                        <h4>{{ $user->full_name }}</h4>
                        {{-- <p class="text-muted">Creative Director</p> --}}
                    </div>
                    <div class="mobile-menu">
                        <ul class="list-inline">
                            @include('frontend.profile.profile_menu')
                        </ul>
                        {{-- <button class="btn-primary">Add Friend</button> --}}
                    </div>
                </div>
                <!--Timeline Menu for Small Screens End-->

            </div>
            <div id="page-contents">
                <div class="row">
                    <div class="col-md-3">

                        <!--Edit Profile Menu-->
                        <ul class="edit-menu">
                            <li><i class="icon ion-ios-information-outline"></i><a
                                    href="{{ route('client.edit.user.profile') }}">Basic Information</a></li>
                            <li class="active"><i class="icon ion-ios-settings"></i><a
                                    href="{{ route('client.user.account.settings') }}">Account Settings</a></li>
                            <li><i class="icon ion-ios-locked-outline"></i><a href="{{ route('client.user.change.password') }}">Change
                                    Password</a></li>
                        </ul>
                    </div>
                    <div class="col-md-7">

                        <!-- Profile Settings
                ================================================= -->
                        <div class="edit-profile-container">
                            <div class="block-title">
                                <h4 class="grey"><i class="icon ion-ios-settings"></i>Account Settings</h4>
                                <div class="line"></div>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                    voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                    occaecati cupiditate</p>
                                <div class="line"></div>
                            </div>
                            <div class="edit-block">
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Enable follow me</strong></div>
                                                <p>Enable this if you want people to follow you</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Send me notifications</strong></div>
                                                <p>Send me notification emails my friends like, share or message me</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Text messages</strong></div>
                                                <p>Send me messages to my cell phone</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Enable tagging</strong></div>
                                                <p>Enable my friends to tag me on their posts</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Enable sound</strong></div>
                                                <p>You'll hear notification sound when someone sends you a private message
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 static">

                        <!--Sticky Timeline Activity Sidebar-->
                        <div id="sticky-sidebar">
                            <h4 class="grey">Suggested User</h4>
                            @foreach ($suggestedUsers as $item)
                            <div class="feed-item">
                                <div class="live-activity">
                                  <div class="follow-user">
                                      <img src="{{ getUserProfileImage($item) }}" alt=""
                                          class="profile-photo-sm pull-left" />
                                      <div>
                                          <h5><a href="{{ route('client.news.feed') }}">{{ $item->full_name }}</a></h5>
                                          <form action="{{ route('client.follow.user') }}" method="POST">
                                              @csrf
                                              <input type="hidden" name="user_id" value="{{ $item->id }}">
                                              <button type="submit" class="btn btn-small text-green">Add friend</button>
                                          </form>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
