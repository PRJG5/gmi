<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ config('app.name') }}" >

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/icons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-icon-180x180.png">
	<link rel="apple-touch-icon" sizes="57x57" href="/img/icons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/icons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/icons/apple-icon-76x76.png">
	<link rel="icon" href="img/icons/favicon.ico" type="/image/x-icon">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/icons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/icons/favicon-96x96.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon">
	<meta name="msapplication-TileColor" content="#007BFF">
	<meta name="msapplication-TileImage" content="/img/icons/ms-icon-144x144.png">
	<meta name="theme-color" content="#007BFF">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name') }}</title>

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
	<script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}" defer></script>
	<script src="{{ asset('js/Bootstrap/bootstrap.bundle.min.js') }}" defer></script>
	<script src="{{ asset('js/xhr.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/serviceWorker.js') }}"></script>

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
					{{ config('app.name') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('misc.toggleNavigation')">
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
								<a class="nav-link" href="{{ route('login') }}">@lang('login.login')</a>
							</li>
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}">@lang('login.register')</a>
								</li>
							@endif
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ \App\Enums\Roles::getDescription(Auth::user()->role) }} : {{ Auth::user()->name }} <span class="caret"></span></a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('myCards') }}">@lang('card.myCards')</a>
									<a class="dropdown-item" href="{{ route('cards.index') }}">@lang('card.allCards')</a>
									<a class="dropdown-item" href="{{ route('searchCardByAuthor') }}">@lang('card.searchCardByAuthor')</a>
									@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
										<a class="dropdown-item" href="{{ route('allUsers') }}">@lang('users.users')</a>
									@endif
									<a class="dropdown-item" href="{{ route('addBasicData') }}">@lang('misc.addBasicData')</a>
									<a class="dropdown-item" href="{{ route('importLanguages') }}">@lang('misc.importLanguages')</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">@lang('login.logout')</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
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
