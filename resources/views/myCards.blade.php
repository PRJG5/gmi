@extends('layouts.card')

@section('card-header')
@lang('card.myCards')
@endsection
@section('card-body')
@lang('users.userData')
@foreach ($cards as $card)
    @inject('cardController', 'App\Http\Controllers\CardController')
    {{ $cardController->show($card) }}
@endforeach
@endsection
