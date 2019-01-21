<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Coffee</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="nav has-shadow">
            <div class="container">
                <div class="nav-left">
                    <a class="nav-item is-paddingless" href="{{route('home')}}">
                        <img src="{{asset('images/coffee-logo.png')}}" alt="E-Coffee Logo"/>
                    </a>
                </div>
                <a href="#" class="nav-item is-tab is-hidden-mobile m-l-10">Learn</a>
                <a href="#" class="nav-item is-tab is-hidden-mobile">Discuss</a>
                <a href="#" class="nav-item is-tab is-hidden-mobile">Share</a>
                <div class="nav-right">
                    @if(Auth::guest())
                        <a href="#" class="nav-item is tab">Login</a>
                        <a href="#" class="nav-item is tab">Join the Community</a>
                    @else
                        <button class="dropdown nav-item is-tab dropdown-toggle">
                            Hey Joel <span class="icon"><i  class="fa fa-caret-down"></i></span>
                            <ul class="dropdown-menu">
                                <li class="seperator"><a href="#">Profile</a></li>
                                <li class="seperator"><a href="#">Notifications</a></li>
                                <li class="seperator"><a href="#">Settings</a></li>
                                <li class="seperator"></li>
                                <li class="seperator"><a href="#">Logout</a></li>
                            </ul>
                        </button>
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
