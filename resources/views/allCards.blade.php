@extends('layouts.app')

@section('content')
<h1>@lang('cards.allCards')</h1>

@include('card.index', $cards)

@endsection
