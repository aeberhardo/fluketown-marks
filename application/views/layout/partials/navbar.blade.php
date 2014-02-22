<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">

            @if (Auth::check())
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            @endif
            
            <a class="brand" href="{{ URL::home() }}">fluketown|marks</a>

            <div class="nav-collapse collapse">

                <ul class="nav">
                    @if (Auth::check())
                        <li><div><a href="{{ URL::to_action('bookmarks@new') }}"><button class="btn btn-primary"><i class="icon-plus icon-white"></i> Add flukemark</button></a></div></li>
                        <li><a href="{{ URL::to_action('tags') }}"><i class="icon-tags icon-white"></i> Tags</a></li>
                        <li><a href="{{ URL::to_action('bookmarks@favorites') }}"><i class="icon-star icon-white"></i> Favorites</a></li>
                    @endif
                </ul>

                @if (Auth::check())
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> {{ e(Auth::user()->username) }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to_action('profile') }}"><i class="icon-user"></i> Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ URL::to_action('auth@logout') }}"><i class="icon-signout"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif

                @if (Auth::check())
                    {{ Form::open('bookmarks/search', 'GET', array('class' => 'navbar-search pull-right')) }}
                        <div>
                            {{ Form::text('q', Input::get('q'), array('class' => 'search-query', 'placeholder' => 'Search')) }}
                            <i class="icon-search cursor-default"></i>
                        </div>
                    {{ Form::close() }}
                @endif




            </div>

        </div>
    </div>
</div>
