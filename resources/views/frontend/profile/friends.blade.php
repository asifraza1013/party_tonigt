@extends('frontend.layouts.layouts', ['title' => $title])
@section('content')
    <div class="container">

        <!-- Timeline
        ================================================= -->
        <div class="timeline">
            <div class="timeline-cover" style="background: url('{{ asset('frontend/images/Rectangle 158.png') }}') no-repeat;">

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
                                <li>{{ $user->followers_count }} people following</li>
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
                    <div class="col-md-3"></div>
                    <div class="col-md-7">

                        <!-- Friend List
                ================================================= -->
                        <div class="friend-list">
                            <div class="row">
                                @foreach ($followers as $follower)
                                <div class="col-md-6 col-sm-6">
                                    <div class="friend-card">
                                        <img src="{{ getUserProfileImage($follower) }}" alt=""
                                            class="img-responsive cover" />
                                        <div class="card-info">
                                            <img src="{{ getUserProfileImage($follower) }}" alt=""
                                                class="profile-photo-lg" />
                                            <div class="friend-info">
                                                <a href="#" class="pull-right text-green">My Friend</a>
                                                <h5><a href="#" class="profile-link">{{ $follower->full_name }}</a></h5>
                                                <p>Student at Harvard</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
