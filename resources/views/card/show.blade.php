@extends('layouts.container')

@section('container-title')
	@lang('card.card')
@endsection

@section('container-body')
	@include('card.raw', [
		'card' => $card,
		'context' => $context,
		'definition' => $definition,
		'domain' => $domain,
		'language' => $language,
		'note' => $note,
		'owner' => $owner,
		'phonetic' => $phonetic,
		'subdoamin' => $subdomain,
	])
	<br>
	<div>
		@if($user->role == 0 || $user->speaks($card->language_id))
			<a href="{{ route('cards.edit', $card) }}" class="btn btn-primary">@lang('card.editCard')</a>
		@endif
		@if($user->role == 0)
			<a class="btn btn-secondary"
				href="mailto:{{ $owner->name }}<{{$owner->email }}>?subject={{$mail['subject']}}&body={{$mail['body']}}"
				title="@lang('misc.sendEmail')">@lang('misc.sendEmail')</a>
		@endif
		@if($user->role < 2)
			<form style="display:inline;" action="{{ route('cards.destroy', $card) }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger float-right">@lang('card.deleteCard')</button>
			</form>
		@endif
	</div>
@endsection
