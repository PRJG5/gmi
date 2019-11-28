@extends('layouts.card')

@section('card-header')
@lang('card.myCards')
@endsection
@section('card-body')
@lang('users.userData')
@foreach ($cards as $card)
    @include('card.show')
@endforeach
@endsection
