@extends('layouts.card')
@extends('layouts.app')
@section('content')
@section('card-header')

    Register Card
    
@endsection

@section('card-body')
    <form action="{{route('cards.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="heading" class="col-md-6 col-form-label text-md-right"> Vedette : </label>
            <input type="text" name="heading" id="heading">
        </div>

		<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
		<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="" title="Phonetic"/>
		
        <input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

        @if (!isset($card) || in_array($card->language_id, $languages))
        <label for="language_id" class="col-md-6 col-form-label text-md-right">Langue : </label> 
		<select name="language_id" class="language_id" type="text" value="{{ isset($card) ? $card->language_id : '' }}" title="Language">
			@foreach  ($languages as $lang)
			<option value="{{ $lang->slug }}" {{ (isset($card) && ($card->language_id == $lang->slug)) ? 'selected' : '' }} title="{{ $lang->content }}" >{{ $lang->content }}</option>
			@endforeach
		</select>
		@endif
        

        @if (!isset($card) || in_array($card->domain_id, $domain))
		<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domain:</label>
		<select name="domain_id" class="domain_id" type="text" value="{{ isset($card) ? $card->domain_id : '' }}" title="Domain">
			@foreach($domain as $dom)
			<option value="{{ $dom->id}}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}" >{{ $dom->content }}</option>
			@endforeach
		</select>
		@endif

		@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
		<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Subdomain:</label>
		<select name="subdomain_id" class="subdomain_id" type="text" value="{{ isset($card) ? $card->subdomain_id : '' }}" title="Subdomain">
			@foreach($subdomain as $subdom)
			<option value="{{ $subdom->id}}" {{ (isset($card) && ($card->qubdomain_id == $subdom->id)) ? 'selected' : ''}} title="{{ $subdom->content }}" >{{ $subdom->content }}</option>
			@endforeach
		</select>
		@endif


        <label for="note" class="col-md-6 col-form-label text-md-right">Note:</label>
		<input name="note" class="note" type="text" placeholder="Note" value="" title="Note"/>

		<label for="context" class="col-md-6 col-form-label text-md-right">Contexte:</label>
		<textarea name="context" class="context" placeholder="Context" value="" title="COntext"></textarea>

		<label for="definition" class="col-md-6 col-form-label text-md-right">Definition:</label>
		<textarea name="definition" class="context" placeholder="Definition" value="" title="Definition"></textarea>

		

        <br>
        <button type="submit" class="btn btn-primary"> Register Card</button>

    </form>
    @extends('layouts.error')
@endsection
@endsection