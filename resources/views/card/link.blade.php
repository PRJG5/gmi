@extends('layouts.container')

@section('container-title')
	@lang('card.linkCard')
@endsection

@section('container-body')
	<div class="row">
		<div class="col-sm">
			@include('card.raw', [

			])
		</div>
		<div class="col-sm">
			<input type="button" value="@lang('card.linkCard')" title="@lang('card.linkCard')"/>
		</div>
		<div class="col-sm">

		</div>
	</div>
@endsection

@extends('card.editable', [
	'action' => "/cards/{$cardOrigin->card_id}/{$cardLinked->card_id}/link",
	'card' => $cardOrigin,
	'editable' => false,
	'languages' => $languages,
	'user' => $userOrigin,
])

@section('buttons')

@endsection

@extends('card.editable', [
	'action' => "/cards/{$cardOrigin->card_id}/{$cardLinked->card_id}/link",
	'card' => $cardLinked,
	'editable' => false,
	'languages' => $languages,
	'user' => $userLinked,
])
