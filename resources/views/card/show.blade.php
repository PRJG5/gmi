{{--
Next 8 HTML lines must be put in the base Blade tmplate.
// TODO
--}}
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Card">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/default/common.css') }}" >
		<title>Card {{ isset($card) ? strval($card->cardId) : '' }}</title>

		{{--
		Styling is devided into 2 files:
		* One for the ganaral layout (css/card.css)
		* One for the color style, like a theme system (css/card.css)
		--}}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}" >
		<link rel="stylesheet" type="text/css" href="{{ asset('css/themes/default/card.css') }}" >
	</head>
	<body>
		<form class="card" action="{{ isset($action) ? $action : '' }}" method="post">

			@section('card_id')
			<input name="card_id" class="card_id" type="hidden" value="{{ isset($card) ? $card->card_id : '' }}" />
			@show
			
			@section('owner_id')
			<input name="owner_id" class="owner_id" type="hidden" value="{{isset($user) ? $user->id : ''}}" />
			@show

			@section('csrf')
				{{--
					This section is empty in the show method
					But will be filled if the form has to be edited
					i.e. in a "create" action or an "edit" action.
				--}}
			@show

			@section('patch')
				{{--
					This section is empty in the show method
					But will be filled if the form has to be sent for special action
					i.e. in a "delete" action or an "edit" action.
				--}}
			@show

			<div class="cardHeader">
				{{--
					Classes are used for inputs for style
					Rather than id's in case of multiple cards rendered
					At the same time on the screen
					i.e. in case of linking two cards.
				--}}
				
				@if (!isset($card) || in_array($card->language_id, $languages))
				<select name="language_id" 	class="language_id" type="text" placeholder="Language"	value="{{ isset($card) ? $card->language_id : '' }}"	title="Langue"	{{ (isset($editable) && $editable) ? '' : 'disabled' }}	required>
					@foreach  ($languages as $lang)
					<option value="{{ $lang->key }}" {{ (isset($card) && ($card->language_id == $lang->key)) ? 'selected' : '' }} title="{{ $lang->description }}">{{ $lang->description }}</option>
					@endforeach
				</select>
				@endif

				@section('error_language_id')
				@show

				<input name="heading" class="heading" type="text" placeholder="Titre"	value="{{ isset($card) ? $card->heading : '' }}" title="{{ isset($card) ? $card->heading : '' }}" {{ (isset($editable) && $editable) ? '' : 'disabled' }}	required />
				
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
				@if (!isset($card) || in_array($card->domain_id, $domain))
				<select name="domain_id" class="domain_id" type="text" placeholder="Domain"	value="{{ isset($card) ? $card->domain_id : '' }}"	title="Domain"	{{ (isset($editable) && $editable) ? '' : 'disabled' }}	required>
					@foreach($domain as $dom)
						<option value="{{ $dom->key}}" {{ (isset($card) && ($card->domain_id == $dom->key)) ? 'selected' : ''}} title="{{ $dom->description }}">{{ $dom->description }}</option>
					@endforeach	
				</select>
				@endif	
				@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
				<select name="subdomain_id" class="subdomain_id" type="text" placeholder="Subdomain"	value="{{ isset($card) ? $card->subdomain_id : '' }}"	title="Subdomain"	{{ (isset($editable) && $editable) ? '' : 'disabled' }}	required>
					@foreach($subdomain as $subdom)
						<option value="{{ $subdom->key}}" {{ (isset($card) && ($card->qubdomain_id == $subdom->key)) ? 'selected' : ''}} title="{{ $subdom->description }}">{{ $subdom->description }}</option>
					@endforeach	
				</select>
				@endif
				@section('error_owner_id')
				@show


				
				@section('owner')
				<label for="owner">Nom du propriétaire :</label>
				<input name="owner"value="{{ isset($user) ? $user->name : '' }}" disabled /> 
				@show

			</div>

			@section('buttons')
			@show

		</form>

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
