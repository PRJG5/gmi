@extends('layouts.app')

@section('content')
	<h1>@lang('home.home') - {{ config('app.name', 'GMI') }}</h1>
	<ul>
		<li>
			<a href="{{ route('cards.index') }}">@lang('cards.allCards')</a>
		</li>
		<li>
			<a href="{{ route('cards.create') }}">@lang('cards.createCard')</a>
		</li>
		<li>
			<a href="{{ route('mesFiches') }}">@lang('cards.myCards')</a>
		</li>
		<li>
			<a href="{{ route('searchByUser') }}">@lang('cards.searchCardByAuthor') [ADMIN]</a>
		</li>
		<li>
			<a href="{{ route('searchCard') }}">@lang('cards.searchCardByHeadingOrLanguage')</a>
		</li>
		<li>
			<a href="{{ route('ListingUsers') }}">@lang('users.manageRoles') [ADMIN]</a>
		</li>
		<li>
			<a href="{{ route('basicData') }}">@lang('cards.addDomainsSubdomainsLanguages') [ADMIN]</a>
		</li>
	</ul>
@endsection
