@extends('layouts.app')

@section('content')
<h1>@lang('cards.myCards')</h1>

@include('card.index', $cards)

@endsection
