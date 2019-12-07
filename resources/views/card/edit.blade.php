@extends('layouts.card')
@extends('layouts.app')
@section('content')
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

		<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
		<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="{{isset($phonetic) ? $phonetic->textDescription : ' '}}" title="Phonetic"/>

        <!--METTRE LES VALEURS PAR DEFAUT A DOMAIN ET SUBDOMAIN-->
        <label for="domain_id" class="col-md-6 col-form-label text-md-right">Domain:</label>
		<select name="domain_id" class="domain_id" type="text" value="{{$card->domain_id}}" title="Domain">
			@foreach($domain as $dom)
			<option value="{{ $dom->id}}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}" >{{ $dom->content }}</option>
			@endforeach
		</select>

		<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Subdomain:</label>
		<select name="subdomain_id" class="subdomain_id" type="text" value="{{$card->subdomain_id}}" title="Subdomain">
			@foreach($subdomain as $subdom)
			<option value="{{ $subdom->id}}" {{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}} title="{{ $subdom->content }}" >{{ $subdom->content }}</option>
			@endforeach
		</select>


		<label for="definition" class="col-md-6 col-form-label text-md-right">Definition:</label>
		<textarea name="definition" class="definition" value="{{isset($definition) ? $definition->definition_content : ' '}}">{{isset($definition) ? $definition->definition_content : ""}}</textarea>

        <label for="note" class="col-md-6 col-form-label text-md-right">Note:</label>
		<input name="note" class="note" type="text" value="{{isset($note) ? $note->description : ' '}}"/>

		<label for="context" class="col-md-6 col-form-label text-md-right">Contexte:</label>
		<textarea name="context" class="context" value="{{isset($context) ? $context->context_to_string : ' '}}">{{isset($context) ? $context->context_to_string : ""}}</textarea>

        <br>
		<button type="submit" class="btn btn-primary"> Validate </button>

    </form>

<br>
<br>
<!--<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />-->
	@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
		<a href="mailto:{{$owner->email}}?subject={{$mail['subject']}}&body={{$mail['description']}}" class="buttonLike">Send mail</a>
	@endif
	@extends('layouts.error')
@endsection
@endsection

