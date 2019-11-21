{{--
Next 8 HTML lines must be put in the base Blade tmplate.
// TODO@extends('card.show', [
	'action' => $action,
	'card' => $card,
	'editable' => true,
	'languages' => $languages,
	'user' => $user,
])
--}}


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Card">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/default/common.css') }}" >
		<title>Card {{ isset($card) ? strval($card->cardId) : '' }}</title>

		{{--
		phonetic
		--}}
	</div>
	<div class="cardBody">

		@section('error_owner_id')
			@show

			@section('owner')
			<label for="owner">Owner:</label>
			<input name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled />
		@show

		{{--
		definition
		--}}

		@if (!isset($card) || in_array($card->domain_id, $domain))
		<label for="domain_id">Domain:</label>
		<select name="domain_id" class="domain_id" type="text" value="{{ isset($card) ? $card->domain_id : '' }}" title="Domain" {{ (isset($editable) && $editable) ? '' : 'disabled' }} required >
			@foreach($domain as $dom)
			<option value="{{ $dom->key}}" {{ (isset($card) && ($card->domain_id == $dom->key)) ? 'selected' : ''}} title="{{ $dom->description }}" >{{ $dom->description }}</option>
			@endforeach
		</select>
		@endif

		@section('edit')
		<a href="{{ isset($card) ? $card->card_id : '' }}/edit" class="buttonLike"	title="Edit">Edit</a>
		@show
		
		@section('delete')
		<form action="/cards/{{ isset($card) ? $card->card_id : '' }}" method="post">
			@method('DELETE')
			@csrf
			<input type="submit" class="buttonLike" value="Delete"	title="Delete" />
		</form>
		@show
	</body>
</html>
