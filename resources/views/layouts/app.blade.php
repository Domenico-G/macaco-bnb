<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Macaco B&B @yield('title')</title>

        {{-- favicon --}}
        <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png">
        <link rel="manifest" href="favicon_package_v0.16/site.webmanifest">
        <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        {{-- FontAwesome vers. 5.15.1 --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- nav section --}}
            <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                <div class="container bnb-container">
                    <div class="bnb-logoContainer">
                        <div class="bnb-brandName">
                            <span>Macaco B&B</span>
                        </div>
                        <a class="logo" href="{{ url('/') }}">
                            <img src="imageOfPage/macaco-bnb-logo.png" alt="">
                        </a>
                    </div>

                    {{-- burger menu button --}}
                    <button class="navbar-toggler bnb-buttonStyle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    {{-- menu a tendina --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                <a class="nav-link" href="{{ url('/') }}">
                                Home
                                </a>
                            </li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto ">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown  bnb-burgerMenu">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- MAIN SECTION --}}
            <main>
                @yield("content")
            </main>

            {{-- FOOTER SECTION --}}
            <footer >
                <div class="container bnb-container">
                    <div class="col-lg-9 bnb-creditsContainer">
                        <div class="bnb-creaditsCreators">
                            Macaco B&B is
                            created by team 6 with &hearts;
                            boolean class #25 &copy; ADGGD
                        </div>
                    </div>
                    {{--
                        sezione contatti social con link esterni alle rispettive pagine
                    --}}
                    <div class="col-lg-3 bnb-rightFoot">
                        <a href="https://www.facebook.com">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="https://www.instagram.com">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com">
                            <i class="fab fa-twitter-square"></i>
                        </a>
                        <a href="https://www.linkedin.com">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
