<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">{{ __('home') }}</a>
                        </li>
                    </ul>
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

                                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
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
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(app()->getLocale() == 'en')
                                <span class="flag-icon flag-icon-gb"></span>
                            @elseif(app()->getLocale() == 'lt')
                                <span class="flag-icon flag-icon-lt"></span>
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            @if(app()->getLocale() == 'lt')
                                <li>
                                    <a class="dropdown-item" href="{{ url('lang/en') }}">
                                        <span class="flag-icon flag-icon-gb"></span> {{ __('english') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ url('lang/lt') }}">
                                        <span class="flag-icon flag-icon-lt"></span> {{ __('lithuanian') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
</header>
