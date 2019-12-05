@extends('layouts.card')

@section('card-header')

    Edit Card
    
@endsection

@section('card-body')
	<form action="{{route('cards.update', $card)}}" method="POST">
		@method('PUT')
        @csrf
       
	    <label for="heading" class="col-md-6 col-form-label text-md-right"> Vedette : </label>
        <input type="text" name="heading" id="heading" value="{{$card->heading}}" readonly>

		<label for="language_id" class="col-md-6 col-form-label text-md-right">Langue : </label> 
		<input type="text" name="language_id" id="heading" value="{{$card->language_id}}" readonly>

        <input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

		@if (!$card->isSignedLanguage())
			<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
			<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="{{isset($phonetic) ? $phonetic->textDescription : ' '}}" title="Phonetic"/>
		@endif		
		
        <!--METTRE LES VALEURS PAR DEFAUT A DOMAIN ET SUBDOMAIN-->

        @if (!isset($card) || in_array($card->domain_id, $domain))
		<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domain:</label>
		<select name="domain_id" class="domain_id" type="text" value="{{$card->domain_id}}" title="Domain">
			@foreach($domain as $dom)
			<option value="{{ $dom->key}}" {{ (isset($card) && ($card->domain_id == $dom->key)) ? 'selected' : ''}} title="{{ $dom->description }}" >{{ $dom->description }}</option>
			@endforeach
		</select>
		@endif

		@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
		<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Subdomain:</label>
		<select name="subdomain_id" class="subdomain_id" type="text" value="{{$card->subdomain_id}}" title="Subdomain">
			@foreach($subdomain as $subdom)
			<option value="{{ $subdom->key}}" {{ (isset($card) && ($card->subdomain_id == $subdom->key)) ? 'selected' : ''}} title="{{ $subdom->description }}" >{{ $subdom->description }}</option>
			@endforeach
		</select>
		@endif


		<label for="definition" class="col-md-6 col-form-label text-md-right">Definition:</label>
		@if ($card->isSignedLanguage())
			<input name="definition" class="definition" type="text" value="{{isset($definition) ? $definition->definition_content : ' '}}" placeholder="www.example.com">
		@else
			<textarea name="definition" class="definition" value="{{isset($definition) ? $definition->definition_content : ' '}}" placeholder="Une définition">{{isset($definition) ? $definition->definition_content : ""}} </textarea>
		@endif

		<label for="note" class="col-md-6 col-form-label text-md-right">Note:</label>
		<input name="note" class="note" type="text" value="{{isset($note) ? $note->description : ' '}}" @if ($card->isSignedLanguage())
			placeholder="www.example.com"
		@else
			placeholder="Une note"
		@endif/>
		

		<label for="context" class="col-md-6 col-form-label text-md-right">Contexte:</label>
		@if ($card->isSignedLanguage())
			<input name="context" class="context" type="text" value="{{isset($context) ? $context->context_to_string : ' '}}" placeholder="www.example.com">
		@else
			<textarea name="context" class="context" value="{{isset($context) ? $context->context_to_string : ' '}}">{{isset($context) ? $context->context_to_string : ""}}</textarea>
		@endif
        <br>
		<button type="submit" class="btn btn-primary">Sauvegarder</button>

    </form>

<br>
<br>
<!--<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />-->
	@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
		<a href="mailto:{{$owner->email}}?subject={{$mail['subject']}}&body={{$mail['description']}}" class="buttonLike">Send mail</a>
	@endif
	@extends('layouts.error')
@endsection

