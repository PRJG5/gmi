@extends('card.show', [
	'action' => $action,
	'card' => $card,
	'domain' => $domain,
	'editable' => true,
	'languages' => $languages,
	'subdomain' => $subdomain,
	'owner' => $owner,
])

@section('csrf')
@csrf
@endsection

@section('error_language_id')
	@error('language_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_heading')
	@error('heading')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_owner_id')
	@error('owner_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('edit')
@endsection

@section('delete')
@endsection

@section('owner')
@show
