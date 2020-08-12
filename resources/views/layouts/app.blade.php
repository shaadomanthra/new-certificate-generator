<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The best repository for placement papers and aptitude questions for infosys, tcs nqt,tcs ninja, tcs digital, amcat, cocubes, accenture, cognizant, wipro and many more ">
    <meta name="keywords" content="campus placement preparation, wipro placement papers, infosys placement papers, aptitude questions, amcat previous papers, amcat preparation,tcs nqt, tcs ninja, tcs digital">
    <meta name="author" content="Kamal Teja">
    <meta name="csrf-token" content="h6YKkXDsIVOZK0aGhkFtDHBoY6K0qC3lugQI0DW7">
    <meta name="theme-color" content="#c25054">
    <link rel="manifest" href="/manifest.json">
    <meta property="og:url" content="https://xplore.co.in">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Xplore - The Best Assessment Platform">
    <meta property="og:description" content="The best repository for placement papers and aptitude questions for infosys, tcs nqt,tcs ninja, tcs digital, amcat, cocubes, accenture, cognizant, wipro and many more ">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="https://xplore.co.in/favicon.ico">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- My Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> 

    <title>{{config('app.name', 'Xplore - The Best Assessment Platform')}}</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                @auth
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" width="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto pt-3">
                            <!-- Authentication Links -->
                            {{-- @guest --}}
                                {{-- <li class="nav-item mr-3">
                                    <a class="btn btn-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif --}}
                            {{-- @else --}}
                                <li class="nav-item">
                                    <a href="/dashboard" class="nav-link text-dark font-weight-bold">Dashboard</a>
                                </li>
                                <li class="nav-item dropright">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-danger" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu bg-transparent border-0" aria-labelledby="navbarDropdown">
                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            {{-- @endguest --}}
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="container mt-5 text-center">
        <hr>
        <h6 class="text-muted">Copyright &copy; <a href="https://xplore.co.in" target="_blank" class="text-danger">Xplore</a></h6>
    </footer>
</body>
</html>
