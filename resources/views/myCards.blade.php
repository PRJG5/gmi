@extends('layouts.container')

@section('container-title')
	@lang('card.myCards')
@endsection

@section('container-body')
	@include('card.list', [
		'cards' => $cards,
	])
	<a href="{{ route('cards.create') }}" class="btn btn-primary">@lang('card.createCard')</a>
@endsection
