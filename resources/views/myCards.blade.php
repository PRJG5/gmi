@extends('card.index', [
	'cards' => $cards,
])

@section('card-header')
@lang('card.myCards')
@endsection
