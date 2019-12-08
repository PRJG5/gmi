@extends('layouts.card')
@extends('layouts.app')
@section('content')
@section('card-header')

    Edit Card
    
@endsection {{-- Section card-header--}}

@section('card-body')
	<form action="{{route('cards.update', $card)}}" method="POST">
		@method('PUT')
        @csrf
	   
		{{-- HEADING --}}
		<div class="form-group row">
			<label for="heading" class="col-md-6 col-form-label text-md-right"> Vedette : </label>
			<input type="text" name="heading" id="heading" value="{{$card->heading}}" readonly>
		</div>
		@if ($card->isSignedLanguage())
			<div class="form-group row">
				<label for="headingURL" class="col-md-6 col-form-label text-md-right"> Vedette URL : </label>
				<input type="text" name="headingURL" id="headingURL" value="{{$card->headingURL}}" placeholder="www.example.com">
			</div>
		@endif

		{{-- LANGUAGE --}}
		<div class="form-group row">
			<label class="col-md-6 col-form-label text-md-right">Langue : </label> 
			<label>{{$card->language_id}}</label>
		</div>

		{{-- TODO: improve and do it with blade --}}
        <input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

		{{-- PHONETIC --}}
		@if (!$card->isSignedLanguage())
			<div class="form-group row">
				<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
				<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="{{isset($phonetic) ? $phonetic->textDescription : ''}}" title="Phonetic"/>
			</div>
		@endif		
		
		{{-- DOMAIN --}}
		<div class="form-group row">
			<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domain:</label>
			<select name="domain_id" class="domain_id" type="text" value="{{$card->domain_id}}" title="Domain">
				@foreach($domain as $dom)
				<option value="{{ $dom->id}}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}" >{{ $dom->content }}</option>
				@endforeach
			</select>
		</div>
        

		{{-- SUBDOMAIN --}}
		<div class="form-group row">
			<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Subdomain:</label>
			<select name="subdomain_id" class="subdomain_id" type="text" value="{{$card->subdomain_id}}" title="Subdomain">
				@foreach($subdomain as $subdom)
				<option value="{{ $subdom->id}}" {{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}} title="{{ $subdom->content }}" >{{ $subdom->content }}</option>
				@endforeach
			</select>
		</div>

		{{-- DEFINITION --}}
		<div class="form-group row">
			<label for="definition" class="col-md-6 col-form-label text-md-right">Definition:</label>
			{{$def = $card->definition}}
			@if ($card->isSignedLanguage())
				<input name="definition" class="definition" type="text" value="{{isset($def) ? $def->definition_content : ''}}" placeholder="www.example.com">
			@else
				<textarea name="definition" class="definition" value="{{isset($def) ? $def->definition_content : ''}}" placeholder="Une définition">{{isset($def) ? $def->definition_content : ""}} </textarea>
			@endif
		</div>

		{{-- CONTEXT --}}
		<div class="form-group row">
			<label for="context" class="col-md-6 col-form-label text-md-right">Contexte:</label>
			{{$context = $card->context}}
			@if ($card->isSignedLanguage())
				<input name="context" class="context" type="text" value="{{isset($context) ? $context->context_to_string : ''}}" placeholder="www.example.com">
			@else
				<textarea name="context" class="context" value="{{isset($context) ? $context->context_to_string : ''}}" placeholder="Un contexte">{{isset($context) ? $context->context_to_string : ""}}</textarea>
			@endif
		</div>

		{{-- NOTE --}}
		<div class="form-group row">
			<label for="note" class="col-md-6 col-form-label text-md-right">Note:</label>
			<input name="note" class="note" type="text" value="{{isset($note) ? $note->description : ''}}" placeholder="{{$card->isSignedLanguage() ? "www.example.com" : "Une note"}}"/>
		</div>

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
@endsection {{-- Section card-body--}}
@endsection {{-- Section content--}}