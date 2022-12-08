@extends('frontend.layouts.layouts', ['title' => $title])
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2 {
            background: #fff;
            border: 1px solid #f5f8f8;
            box-shadow: none;
            border-radius: 4px;
            color: #939598;
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">

        <!-- Timeline
            ================================================= -->
        <div class="timeline">
            <div class="timeline-cover"
                style="background: url('{{ asset('frontend/images/Rectangle 158.png') }}') no-repeat;">

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

                        <!-- Post Create Box
                    ================================================= -->
                        <div class="create-post">
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="tools">
                                        <button class="btn btn-primary pull-right" data-toggle="modal"
                                            data-target="#createNewPost">Create New Event</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Post Create Box End-->

                        <!-- Post Content
                    ================================================= -->
                        @foreach ($posts as $key => $post)
                            <div class="post-content">
                                <img src="{{ $post->media_url[0] }}" alt="post-image" class="img-responsive post-image" />
                                <div class="post-container">
                                    <img src="{{ getUserProfileImage($post->user) }}" alt="user"
                                        class="profile-photo-md pull-left" />
                                    <div class="post-detail">
                                        <div class="user-info">
                                            <h5><a href="{{ route('client.news.feed') }}"
                                                    class="profile-link">{{ getUserFullName($post->user) }}</a> <span
                                                    class="following">{!! $user->attachFollowStatus($post->user)->has_followed
                                                        ? '<span>following</span?'
                                                        : '<span class="red">not following</span>' !!}</span></h5>
                                            <p class="text-muted" style="margin: 0px">
                                                @if ($post->friends)
                                                    @foreach ($post->friends as $value)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        <span class="nice"><a
                                                                href="#">{{ '@' . $value }}</a></span>
                                                    @endforeach
                                                @endif
                                            </p>
                                            <p class="text-muted" style="margin: 0px">
                                                @if ($post->tags)
                                                    @foreach ($post->tags as $value)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        <span class="nice"><a
                                                                href="#">{{ '#' . $value->name }}</a></span>
                                                    @endforeach
                                                @endif
                                            </p>
                                            <p class="text-muted">Published about {{ calculatePostTitme($post) }}</p>
                                        </div>
                                        <div class="reaction">
                                            <a class="btn text-green like-post" pl-count="{{ $post->like_count }}"
                                                p-id="{{ $post->id }}" p-user={{ $post->user_apps_id }}><i
                                                    class="icon ion-thumbsup"></i>{{ $user->id == $post->user_apps_id ? $post->like_count : null }}</a>
                                            {{-- <a class="btn text-red dislike-post" pd-count="{{ $post->dislike_count }}"
                                    p-id="{{ $post->id }}"><i
                                        class="fa fa-thumbs-down"></i>{{ $post->dislike_count }} </a> --}}
                                        </div>
                                        <div class="line-divider"></div>
                                        <div class="post-text">
                                            <p> {{ $post->description }}<i class="em em-anguished"></i> <i
                                                    class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                        </div>
                                        <div class="line-divider"></div>
                                        @foreach ($post->comment as $index => $comment)
                                            <div class="post-comment">
                                                <img src="{{ getUserProfileImage($comment->user) }}" alt=""
                                                    class="profile-photo-sm" />
                                                <p><a href="{{ route('client.news.feed') }}"
                                                        class="profile-link">{{ getUserFullName($comment->user) }} </a><i
                                                        class="em em-laughing"></i>
                                                    {{ $comment->text }} </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    @include('frontend.layouts.include.post_model')
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // $.fn.modal.Constructor.prototype.enforceFocus = function() {};

            $('#detail-checkbox').on('change', function() {
                let isChecked = $(this).is(':checked');
                console.log('isChecked', isChecked);
                if (isChecked) $('.ticket-detail').removeClass('d-none');
                else $('.ticket-detail').addClass('d-none');
            })

            // friend list search.
            $('.userSearch').select2({
                placeholder: 'Select Friends',
                // tags: true,
                ajax: {
                    url: "{{ route('client.search.users') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.user_name,
                                    id: item.user_name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            // tag list search.
            $('.tagSearch').select2({
                placeholder: 'Select Tags',
                tags: true,
                ajax: {
                    url: "{{ route('client.search.tags') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name.en,
                                    id: item.name.en
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.like-post').on('click', function(){

                let userId = @JSON($user->id);
                let postid = $(this).attr('p-id');
                let postUser = $(this).attr('p-user');
                let currentCount = $(this).attr('pl-count');
                currentCount = parseInt(currentCount) + 1;
                $(this).html('<i class="icon ion-thumbsup"></i>'+ currentCount);
                let route = "{{ route('client.like.user.post') }}"
                likePost(postid, route)
            })
            $('.dislike-post').on('click', function(){
                console.log('dislike clicked');
                let postid = $(this).attr('p-id');
                console.log('postId', postid);
                let currentCount = $(this).attr('pd-count');
                console.log('currentCOunt ', currentCount);
                $(this).html('<i class="fa fa-thumbs-down"></i>'+parseInt(currentCount) + 1);
                let route = "{{ route('client.dislike.user.post') }}"
                likePost(postid, route)
            })

            function likePost(postId, route) {
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'post_id': postId,
                    },
                    success: function(data) {
                        return true;
                    }
                });
            }
        });
    </script>
@endsection
