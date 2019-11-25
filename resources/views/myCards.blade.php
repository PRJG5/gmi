@extends('layouts.card')

@section('card-header')
@lang('card.myCards')
@endsection
@section('card-body')
<!-- accès aux données du users via Auth::user() -->
@lang('users.userData')
<ul>
	<li>@lang('users.name'): {{ Auth::user()->name }}</li>
</ul>
@endsection
