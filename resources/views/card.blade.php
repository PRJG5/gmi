@extends('layouts.app')

@section('content')
<h1>@lang('cards.card')</h1>

@include('card.show', $card)
    
@endsection
