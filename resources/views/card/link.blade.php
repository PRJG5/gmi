@include('layouts.app')


@extends('card.editable', [
    'action' => "/cards/{$cardOrigin->card_id}/{$cardLinked->card_id}/link",
	'card' => $cardOrigin,
	'editable' => false,
	'languages' => $languages,
	'user' => $userOrigin,
])

@section('buttons')
<input type="button" title="Link" />
@endsection

@extends('card.editable', [
    'action' => "/cards/{$cardOrigin->card_id}/{$cardLinked->card_id}/link",
	'card' => $cardLinked,
	'editable' => false,
	'languages' => $languages,
	'user' => $userLinked,
])