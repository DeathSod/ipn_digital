@guest
<header>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark fixed-top justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}">IPN Digital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse container mr-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                {{-- @guest --}}
                    @yield('nav-layout')
                {{-- @endguest --}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                {{-- @guest --}}
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                {{-- @else --}}
                    {{-- <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if( $people )
                                {{ $people->PE_Name." ".$people->PE_LastName }}
                            @elseif( $companies )
                                {{ $companies->CO_Name }}
                            @endif
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li> --}}
                {{-- @endguest --}}
            </ul>
        </div>
    </nav>
</header>
@else
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('title')

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand nav-name col-sm-3 col-md-2 mr-0 text-center" href="/home">
            @if( isset($people) )
                {{ $people->PE_Name." ".$people->PE_LastName }}
            @elseif( isset($companies) )
                {{ $companies->CO_Name }}
            @else
                Dashboard
            @endif
        </a>
        <p class="text-center text-light  my-0 mx-auto"> Balance: {{ $user->US_Credits }}$ </p>
        <ul class="navbar-nav">
            <li class="nav-item text-nowrap">
                <a class="nav-link px-5 font-weight-bold bg-logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <span data-feather="power"></span>
                    Sign out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link{{ isset($home) ? ' active' : '' }}" href="/home">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ isset($portals_active) ? ' active' : '' }}" href="/home/portals">
                            <span data-feather="shopping-cart"></span>
                            Buy Ads
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ isset($campaigns) ? ' active' : '' }}" href="/home/campaigns">
                            <span data-feather="truck"></span>
                            Your Campagns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ isset($purchases) ? ' active' : '' }}" href="/home/purchases">
                            <span data-feather="bar-chart-2"></span>
                            Purchase History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ isset($settings) ? ' active' : '' }}" href="/home/settings">
                            <span data-feather="settings"></span>
                            Settings
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-light">
                @yield('content-main')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>
</html>
@endguest