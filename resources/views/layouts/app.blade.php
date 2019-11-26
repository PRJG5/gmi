<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ config('app.name') }}" >

	<!-- Favicon -->
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-114x114.png') }}"		sizes="114x114">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-120x120.png') }}"		sizes="120x120">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-144x144.png') }}"		sizes="144x144">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-152x152.png') }}"		sizes="152x152">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-180x180.png') }}"		sizes="180x180">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-57x57.png') }}"		sizes="57x57">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-60x60.png') }}"		sizes="60x60">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-72x72.png') }}"		sizes="72x72">
	<link rel="apple-touch-icon"			href="{{ asset('img/icons/favicon-76x76.png') }}"		sizes="76x76">
	<link rel="icon"						href="{{ asset('img/icons/favicon-16x16.png') }}"		sizes="16x16"	type="image/png">
	<link rel="icon"						href="{{ asset('img/icons/favicon-192x192.png') }}"		sizes="192x192"	type="image/png">
	<link rel="icon"						href="{{ asset('img/icons/favicon-32x32.png') }}"		sizes="32x32"	type="image/png">
	<link rel="icon"						href="{{ asset('img/icons/favicon-96x96.png') }}"		sizes="96x96"	type="image/png">
	<link rel="icon"						href="{{ asset('img/icons/favicon.ico') }}"								type="image/x-icon">
	<link rel="shortcut icon"				href="{{ asset('img/icons/favicon.ico') }}"				 				type="image/x-icon">
	<link rel="manifest"					href="{{ asset('manifest.json') }}">
	<meta name="msapplication-TileImage"	content="{{ asset('img/icons/favicon-144x144.png') }}">
	<meta name="msapplication-TileColor"	content="#007BFF">
	<meta name="theme-color"				content="#007BFF">

	<title>{{ config('app.name') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/jQuery/jQuery.min.js') }}" defer></script>
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
				<a class="navbar-brand" href="{{ route('root') }}">
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
								<a class="nav-link" href="{{ route('login') }}">@lang('auth.login')</a>
							</li>
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}">@lang('auth.register')</a>
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
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">@lang('auth.logout')</a>
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
