@extends('layouts.card')

@section('card-header')
@yield('title')
@endsection

@section('card-body')
@if ($cards->isEmpty())
	<div class="alert alert-warning" role="alert">@lang('card.noCards')</div>
@else
    @foreach ($cards as $card)
        <div class="row">
			<div class="col-md-4">{{$card->heading}}</div>
			<a href="{{ route('cards.show', $card->id) }}" class="btn btn-primary">@lang('card.viewDetails')</a>
		</div>
		<br>
    @endforeach
@endif
@yield('body')
@endsection
