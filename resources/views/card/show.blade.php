{{--
Next 4 lines must be put in the base Blade tmplate.
// TODO
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
		Styling is devided into 2 files:
		* One for the ganaral layout (css/card.css)
		* One for the style, like a theme system (css/card.css)
		--}}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/default/card.css') }}" >
	</head>
	<body>
		<form class="card" action="{{ isset($action) ? $action : '' }}" method="post">
			@section('csrf')
				{{--
					This section is empty in the show method
					But will be filled if the form has to be edited
					i.e. in a "create" action or an "edit" action.
				--}}
			@show
			@yield('patch', '')
			{{--
				This section is empty in the show method
				But will be filled if the form has to be sent for special action
				i.e. in a "delete" action or an "edit" action.
			--}}
			<div class="cardHeader">
				{{--
					Classes are used for inputs for style
					Rather than id's in case of multiple cards
					At the same time on the screen
					i.e. in case of linking two cards.
				--}}
				@section('cardId')
				<input name="cardId" class="id" type="hidden" value="{{ isset($card) ? $card->cardId : '' }}">
				@show
				<select name="language_id" 	class="language_id" type="text" placeholder="Language"	value="{{ isset($card) ? $card->language_id : '' }}"	title="Langue"	{{ (isset($editable) && $editable) ? '' : 'disabled' }}	required>
					@forelse ($languages as $lang)
						<option value="{{ $lang->key }}" {{ (isset($card) && ($card->key == $lang->key)) ? 'selected' : '' }} title="{{ $lang->description }}">{{ $lang->description }}</option>
					@empty
						<option></option>
					@endforelse
				</select>
				@section('error_language_id')
				@show
				<input name="heading" class="heading" type="text" placeholder="Vedette"	value="{{ isset($card) ? $card->heading : '' }}" title="{{ isset($card) ? $card->heading : '' }}" {{ (isset($editable) && $editable) ? '' : 'disabled' }}	required >
				@section('error_heading')
				@show
				{{--
					phonetic
				--}}
			</div>
			<div class="cardBody">
				{{--
					domain
					sub-domain
					definition
					context
					note
				--}}
				@section('error_owner_id')
				@show
				<label>Nom du propriétaire : {{$user->name}}</label>
				<input type="hidden" name="owner_id" value="{{$user->id}}"/>
			</div>
			@section('buttons')
			@show
		</form>
		@section('edit')
		<a href="{{ isset($card) ? $card->card_id : '' }}/edit" class="buttonLike"	title="Edit">Edit</a>
		@show
		@section('delete')
		<form action="cards/{{ isset($card) ? $card->card_id : '' }}" method="post">
			@method('DELETE')
			@csrf
			<input type="submit" class="buttonLike" value="Delete"	title="Delete">
		</form>
		@show
	</body>
</html>