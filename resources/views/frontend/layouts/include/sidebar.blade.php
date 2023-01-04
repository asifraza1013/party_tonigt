    <!-- Header
    ================================================= -->
    <header id="header" class="lazy-load visible">
        <nav class="navbar navbar-default navbar-fixed-top menu">
            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header w-lg-40">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('client.news.feed') }}">
                        <h3 class="bold" style="margin: auto; color: white; font-weight: bolder; font-family: serif;"><span><img src="{{ asset('frontend/images/party_tonight_light.png') }}" alt="logo" style="width: 10%"/></span> PARTY TONIGHT</h3>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                @guest
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    {{-- <ul class="nav navbar-nav navbar-right main-menu">
                        <li class="dropdown"><a href="{{ route('login') }}">Login</a></li>
                    </ul> --}}
                    <form class="navbar-form navbar-right hidden-sm">
                        <div class="form-group">
                            <i class="icon ion-android-search"></i>
                            <input type="text" class="form-control" placeholder="Search friends, photos, videos">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->
                @endguest
                @auth
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-menu">
                        <li class="dropdown"><a href="{{ route('client.news.feed') }}">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Timeline<span><img
                                        src="{{ asset('frontend/images/down-arrow.png') }}" alt="" /></span></a>
                            <ul class="dropdown-menu login">
                                <li><a href="{{ route('client.news.feed') }}">Timeline</a></li>
                                <li><a href="#">Timeline About</a></li>
                                {{-- <li><a href="#">Timeline Album</a></li> --}}
                                <li><a href="#">Timeline Friends</a></li>
                                <li><a href="{{ route('client.edit.user.profile') }}">Edit: User Profile</a></li>
                                <li><a href="#">Change Password</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">Contact</a></li>
                    </ul>
                    <form class="navbar-form navbar-right hidden-sm">
                        <div class="form-group">
                            <i class="icon ion-android-search"></i>
                            <input type="text" class="form-control" placeholder="Search friends, photos, videos">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->
                @endauth
            </div><!-- /.container -->
        </nav>
    </header>
    <!--Header End-->
