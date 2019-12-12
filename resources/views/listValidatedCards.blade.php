
@extends('layouts.app')

@section('content')
<h1>@lang('cards.listValidatedCards')</h1>

@include('card.index', $cards)

@endsection
