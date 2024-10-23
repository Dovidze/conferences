<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Conferences') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">{{ __('home') }}</a>
                        </li>


                    </ul>
                    <ul><li><a href="{{ url('lang/en') }}">{{ trans('locale.en') }}</a></li></ul>
                    <ul><li><a href="{{ url('lang/lt') }}">{{ trans('locale.lt') }}</a></li></ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrina, ar vartotojas yra prisijungęs ir turi administratoriaus rolę -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">{{ __('user_management') }}</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                        </li>
                        @endif
                            @if(auth()->check() && auth()->user()->role->id == 2) <!-- Patikrina, ar vartotojas yra prisijungęs ir turi administratoriaus rolę -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                            </li>
                            @endif
                            @if(auth()->check() && auth()->user()->role->id == 1) <!-- Patikrina, ar vartotojas yra prisijungęs ir turi administratoriaus rolę -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                            </li>
                            @endif
                        <li class="nav-item">
                            <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
