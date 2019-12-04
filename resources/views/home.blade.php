@extends('layouts.container')

@section('container-title')
	{{ config('app.name') }}
@endsection

@section('container-body')
	<ul class="links">
		<li><a href="{{ route('home') }}">@lang('misc.home')</a></li>
		<li><a href="{{ route('cards.create') }}">@lang('card.createCard')</a></li>
		<li><a href="{{ route('myCards') }}">@lang('card.myCards')</a></li>
		<li><a href="{{ route('cards.index') }}">@lang('card.allCards')</a></li>
		<li><a href="{{ route('searchCard') }}">@lang('search.searchCard')</a></li>
		<li><a href="{{ route('searchCardByAuthor') }}">@lang('search.searchCardByAuthor')</a></li>
		<li><a href="{{ route('manageRoles') }}">@lang('users.manageRoles')</a></li>
		<li><a href="{{ route('addBasicData') }}">@lang('misc.addBasicData')</a></li>
		<li><a href="{{ route('importLanguages') }}">@lang('misc.importLanguages')</a></li>
	</ul>
@endsection
