<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
    <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/Bootstrap/bootstrap.bundle.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/Bootstrap/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
                <a class="nav-link" href="{{ route('mesFiches') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('mesFiches-form').submit();">
                                        {{ __('Mes Fiches') }}
                </a>
        </li>  

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Recherche par 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/searchByUser">Auteur</a>
      </li>

        </ul>   
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ \App\Enums\Roles::getDescription(Auth::user()->role) }} : {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="/searchByUser">Recherche fiche par auteur</a>
                                    <a class="dropdown-item" href="{{ route('mesFiches') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('mesFiches-form').submit();">
                                        {{ __('Mes Fiches') }}
                                    </a>
                                    @if (Auth::user()->role == \App\Enums\Roles::ADMIN)
                                        <a class="dropdown-item" href="{{ route('ListingUsers') }}">
                                            {{ __('Roles') }}
                                        </a>
                                        <a class="dropdown-item" href="/addLanguage">Ajout domaine/sous-domaine/langues</a>
                                    @endif

                                    <a class="dropdown-item" href="/addLanguage">Ajout domaine/sous-domaine/langues</a>

                                    <a class="dropdown-item" href="/searchCard">Chercher fiche</a>

                                    <form id="mesFiches-form" action="{{ route('mesFiches') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <div class="container" style="max-width: 960px">
                        @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
