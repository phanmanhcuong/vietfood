<header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Vietfood</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li>{!! link_to_route('ranking.like', 'Like Ranking') !!}</li>
                        <li>{!! link_to_route('posts.create', 'Create Post') !!}</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->avatar_url != null)
                                    <img class="img-rounded" src="{{ Auth::user()->avatar_url }}" width="20px" height="20px"></img>
                                @else
                                    <img class="img-rounded" src="{{ Gravatar::src(Auth::user()->email, 20) }}" alt="">
                                @endif
                                {{ Auth::user()->name }} 
                                <span class="caret">
                            </a>
                            <ul class="dropdown-menu">
                                <li>{!! link_to_route('users.edit_profile_get', 'My Profile', ['id' => Auth::id()]) !!}</li>
                                <li>{!! link_to_route('users.show_posts', 'My Posts', ['id' => Auth::id()]) !!}</li>
                                <li role="separator" class="divider"></li>
                                <li>{!! link_to_route('logout.get', 'Logout') !!}</li>
                            </ul>
                        </li>
                    @else
                        <li>{!! link_to_route('signup.get', 'Signup') !!}</li>
                        <li>{!! link_to_route('login', 'Login') !!}</li>
                    @endif
                    
                </ul>
            </div>
        </div>
    </nav>
</header>