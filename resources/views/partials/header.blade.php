
<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">{{ __('home') }}</a>
                        </li>
                        <li class="nav-item mx-auto">
                            <a class="nav-link fw-bold" href="">{{ __('today_date') }} : {{ \Carbon\Carbon::now()->format('Y-m-d') }}</a>
                        </li>

                    <!-- Right Side Of Navbar -->
                        @if(auth()->check() && (auth()->user()->role->id == 3))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">{{ __('admin_menu') }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('home') }}">{{ __('dashboard') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('conferences.list') }}">{{ __('conference_management') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('user_management') }}</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(auth()->check() && (auth()->user()->role->id == 2))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">{{ __('employee_menu') }}</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('home') }}">{{ __('dashboard') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('conferences.index') }}">{{ __('all_conferences') }}</a></li>
                                </ul>
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
