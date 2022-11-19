@extends('frontend.layouts.layouts', ['title' => __('Landing Page')])
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
    <div id="page-contents">
        <div class="container">
            <div class="row">
                <!-- Newsfeed Common Side Bar Left
                              ================================================= -->
                <div class="col-md-3 static">
                    <div class="profile-card">
                        <img src="{{ getUserProfileImage($user) }}" alt="user" class="profile-photo" />
                        <h5><a href="{{ route('client.news.feed') }}"
                                class="text-white">{{ $user->first_name . ' ' . $user->last_name }}</a>
                        </h5>
                        <a href="#" class="text-white"><i class="ion ion-android-person-add"></i>
                            {{ $user->followers_count }} followers</a>
                    </div>
                    <!--profile card ends-->
                    <ul class="nav-news-feed">
                        <li><i class="icon ion-ios-paper"></i>
                            <div><a href="{{ route('client.news.feed') }}">My Newsfeed</a></div>
                        </li>
                        {{-- <li><i class="icon ion-ios-people"></i>
                            <div><a href="newsfeed-people-nearby.html">People Nearby</a></div>
                        </li> --}}
                        <li><i class="icon ion-ios-people-outline"></i>
                            <div><a href="#">Friends</a></div>
                        </li>
                        <li><i class="icon ion-chatboxes"></i>
                            <div><a href="#">Messages</a></div>
                        </li>
                        {{-- <li><i class="icon ion-images"></i>
                            <div><a href="newsfeed-images.html">Images</a></div>
                        </li> --}}
                        <li><i class="icon ion-power" style="color: red"></i>
                            <div>
                                <a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{-- <li><i class="icon ion-ios-videocam"></i>
                            <div><a href="newsfeed-videos.html">Videos</a></div>
                        </li> --}}
                    </ul>
                    <!--news-feed links ends-->
                    {{-- <div id="chat-block">
                        <div class="title">Chat online</div>
                        <ul class="online-users list-inline">
                            <li><a href="newsfeed-messages.html" title="Linda Lohan"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Sophia Lee"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="John Doe"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Alexis Clark"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="James Carter"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Robert Cook"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Richard Bell"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Anna Young"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                            <li><a href="newsfeed-messages.html" title="Julia Cox"><img src="https://via.placeholder.com/300"
                                        alt="user" class="img-responsive profile-photo" /><span
                                        class="online-dot"></span></a></li>
                        </ul>
                    </div> --}}
                    <!--chat block ends-->
                </div>

                <div class="col-md-7">

                    <!-- Post Create Box
                                ================================================= -->
                    <div class="create-post">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="form-group">
                                    {{-- <img src="{{ getUserProfileImage($user) }}" alt="" class="profile-photo-md" /> --}}
                                    {{-- <textarea name="texts" id="exampleTextarea" cols="30" rows="1" class="form-control"
                                        placeholder="Write what you wish"></textarea> --}}
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="tools">
                                    <button class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#createNewPost">Create New Event</button>
                                    {{-- <select class="livesearch form-control p-3" name="friends[]" multiple="multiple"></select> --}}
                                    {{-- <ul class="publishing-tools list-inline">
                                        <li><a href="#"><i class="ion-compose"></i></a></li>
                                        <li><a href="#"><i class="ion-images"></i></a></li>
                                        <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                                        <li><a href="#"><i class="ion-map"></i></a></li>
                                    </ul>
                                    <button class="btn btn-primary pull-right">Publish</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Post Create Box End-->

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
                                            @if($post->friends)
                                            @foreach ($post->friends as $value)
                                                {{ $loop->first ? '' : ', ' }}
                                                <span class="nice"><a href="#">{{ '@' . $value }}</a></span>
                                            @endforeach
                                            @endif
                                        </p>
                                        <p class="text-muted" style="margin: 0px">
                                            @if($post->tags)
                                            @foreach ($post->tags as $value)
                                                {{ $loop->first ? '' : ', ' }}
                                                <span class="nice"><a href="#">{{ '#' . $value->name }}</a></span>
                                            @endforeach
                                            @endif
                                        </p>
                                        <p class="text-muted">Published about {{ calculatePostTitme($post) }}</p>
                                    </div>
                                    <div class="reaction">
                                        <a class="btn text-green like-post" pl-count="{{ $post->like_count }}"
                                            p-id="{{ $post->id }}"><i
                                                class="icon ion-thumbsup"></i>{{ $post->like_count }}</a>
                                        <a class="btn text-red dislike-post" pd-count="{{ $post->dislike_count }}"
                                            p-id="{{ $post->id }}"><i
                                                class="fa fa-thumbs-down"></i>{{ $post->dislike_count }} </a>
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
                    {{-- <video class="post-video" controls>
                        <source src="{{ asset('frontend/videos/1.mp4') }}" type="video/mp4">
                    </video> --}}
                </div>

                <!-- Newsfeed Common Side Bar Right
                              ================================================= -->
                <div class="col-md-2 static">
                    <div class="suggestions" id="sticky-sidebar">
                        <h4 class="grey">Suggested People</h4>
                        @foreach ($suggestedUsers as $user)
                            <div class="follow-user">
                                <img src="{{ getUserProfileImage($user) }}" alt=""
                                    class="profile-photo-sm pull-left" />
                                <div>
                                    <h5><a href="{{ route('client.news.feed') }}">{{ $user->full_name }}</a></h5>
                                    <form action="{{ route('client.follow.user') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-small text-green">Add friend</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- create new post modal --}}
    <div class="modal fade" id="createNewPost" tabindex="-1" role="dialog" aria-labelledby="createNewPostLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="modal-title" id="createNewPostLabel">Creat a Post</h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="toggle-switch">
                                <span>Share to your story</span>
                                <label class="switch">
                                    <input type="checkbox" name="is_story">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('client.create.new.event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my-password">Add a Title<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="text" name="title" title="Add a Title"
                                placeholder="Add a Title" />
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add a Description<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="text" name="description"
                                title="Add a Description" placeholder="Add a Description" />
                        </div>
                        <div class="form-group">
                            <label for="my-password">Tag Friends</label> <br>
                            <select class="userSearch form-control p-3" name="friends[]" multiple="multiple"></select>
                            {{-- <input class="form-control input-group-lg" type="text" name="friends"
                                title="add @ Tag Friends" placeholder="add @ Tag Friends" id="friends-list" /> --}}
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add #Tags</label>
                            <select class="tagSearch form-control p-3" name="tags[]" multiple="multiple"></select>
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add Media<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="file" name="images[]" title="Add Media"
                                placeholder="Add #Tags" multiple />
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="my-password">Add Ticket details<span class="text-danger">*</span></label>
                                    <div class="toggle-switch">
                                        <label class="switch" style="margin-top: -20px">
                                            <input type="checkbox" name="ticket_detail" id="detail-checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ticket-detail d-none">
                            <div class="form-group">
                                <label for="my-password">Ticket price({{ currency() }})<span
                                        class="text-danger">*</span></label>
                                <input class="form-control input-group-lg" type="number" name="ticket_price"
                                    title="Ticket price" placeholder="Ticket price ({{ currency() }})" />
                            </div>
                            <div class="form-group">
                                <label for="my-password">No. of Tickets <span class="text-danger">*</span></label>
                                <input class="form-control input-group-lg" type="number" name="total_tickets"
                                    title="No. of  Tickets" placeholder="No. of  Tickets" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">PUBLISH YOUR POST</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                    text: item.user_name,
                                    id: item.user_name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.like-post').on('click', function(){
                console.log('like clicked');
                let postid = $(this).attr('p-id');
                console.log('postId', postid);
                let currentCount = $(this).attr('pl-count');
                console.log('currentCOunt ', currentCount);
                $(this).html('<i class="icon ion-thumbsup"></i>'+ parseInt(currentCount) + 1);
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
