<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GMI') }}</title>



    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->
    <!-- <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('js/Bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/mdb.js') }}"></script>
    <script src="{{ asset('js/addons/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/solid.css" integrity="sha384-HTDlLIcgXajNzMJv5hiW5s2fwegQng6Hi+fN6t5VAcwO/9qbg2YEANIyKBlqLsiT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/regular.css" integrity="sha384-R7FIq3bpFaYzR4ogOiz75MKHyuVK0iHja8gmH1DHlZSq4tT/78gKAa7nl4PJD7GP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/brands.css" integrity="sha384-KtmfosZaF4BaDBojD9RXBSrq5pNEO79xGiggBxf8tsX+w2dBRpVW5o0BPto2Rb2F" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/fontawesome.css" integrity="sha384-8WwquHbb2jqa7gKWSoAwbJBV2Q+/rQRss9UXL5wlvXOZfSodONmVnifo/+5xJIWX" crossorigin="anonymous">
    <!-- Styles -->

    <link href="{{ asset('css/Bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{asset('css/mdb.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/datatables-select.min.css')}}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <!--Navbar -->
        <nav class="mb-1 navbar navbar-expand-md navbar-dark info-color">

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'GMI') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mesFiches') }}" onclick="event.preventDefault();
                                                     document.getElementById('mesFiches-form').submit();">
                            {{ __('Mes Fiches') }}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recherche
                        </a>
                        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            @if(Auth::user() && Auth::user()->role == \App\Enums\Roles::ADMIN)
                            <a class="dropdown-item" href="/searchByUser">Auteur</a>
                            @endif
                            <a class="dropdown-item" href="/searchCard">Vedette/Langue</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">

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
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search"></i>Recherche
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item" href="{{ route('mesFiches') }}" onclick="event.preventDefault();
                                                     document.getElementById('mesFiches-form').submit();">
                                {{ __('Mes Fiches') }}
                            </a>
                            <form id="mesFiches-form" action="{{ route('mesFiches') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="/searchCard">Recherche fiche par vedette/langue</a>
                            @if(Auth::user() && Auth::user()->role == \App\Enums\Roles::ADMIN)
                            <a class="dropdown-item" href="/searchByUser">Recherche fiche par auteur</a>
                            @endif




                        </div>


                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>Profil
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <h6 class="dropdown-header">{{ \App\Enums\Roles::getDescription(Auth::user()->role) }} : {{ Auth::user()->name }}</h6>
                            
                            <a class="dropdown-item" href="/modifyProfile">Modifier son profil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @if (Auth::user()->role == \App\Enums\Roles::ADMIN)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>Administration
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">

                            <a class="dropdown-item" href="{{ route('ListingUsers') }}">
                                {{ __('Roles') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('basicData') }}">
                                Ajout domaines/sous-domaines/langues
                            </a>


                        </div>
                    </li>
                    @endif

                    @endguest
                </ul>
            </div>

        </nav>


        <main class="py-4">
            <div class="container" style="max-width: 960px">
                @yield('content')
            </div>
        </main>
    </div>
    <!--
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
-->
</body>

</html>