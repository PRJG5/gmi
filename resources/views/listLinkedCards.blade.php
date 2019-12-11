
@extends('layouts.app')

@section('content')
<h1>@lang('cards.listLinkedCards')</h1>

@include('card.index', $cards)

@endsection
