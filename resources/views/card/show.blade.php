@extends('layouts.card')

@section('card-header')
@lang('card.card')
@endsection

@section('card-body')

@include('card.raw', [
	'card' => $card,
	'context' => $context,
	'definition' => $definition,
	'domain' => $domain,
	'languages' => $languages,
	'note' => $note,
	'owner' => $owner,
	'phonetic' => $phonetic,
	'subdoamin' => $subdomain,
])

<div>
	@if(Auth::user()->role != \App\Enums\Roles::USERS
		|| in_array($card->language_id, Auth::user()->getLanguagesKeyArray()))
		<a href="{{ route('cards.edit', $card) }}" class="btn btn-primary">@lang('card.editCard')</a>
	@endif
	@if(Auth::user()->role != \App\Enums\Roles::USERS)
		<form style="display:inline;" action="{{ route('cards.destroy', $card) }}" method="POST">
			@csrf
			@method('DELETE')
			<button class="btn btn-danger float-right" style="">@lang('card.deleteCard')</button>
		</form>
	@endif
</div>
@endsection
