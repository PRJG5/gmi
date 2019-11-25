@extends('layouts.board')

@section('card-header')
@lang('card.allCards')
@endsection

@section('card-body')
	@foreach ($cards as $card)
		<div class="row">
			<div class="col-md-4">{{$card->heading}}</div>
			<a href="{{ route('cards.show', $card->id) }}" class="btn btn-primary">@lang('card.viewDetails')</a>
		</div>
		<br>
	@endforeach
	<a class="btn btn-primary" href="{{route('cards.create')}}">@lang('card.createCard')</a>
@endsection
