@extends('layouts.card')

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

        <input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

        @if (!isset($card) || in_array($card->language_id, $languages))
        <label for="language_id" class="col-md-6 col-form-label text-md-right">Langue : </label> 
		<select name="language_id" class="language_id" type="text" value="{{ isset($card) ? $card->language_id : '' }}" title="Language">
			@foreach  ($languages as $lang)
			<option value="{{ $lang->key }}" {{ (isset($card) && ($card->language_id == $lang->key)) ? 'selected' : '' }} title="{{ $lang->description }}" >{{ $lang->description }}</option>
			@endforeach
		</select>
		@endif
        

        @if (!isset($card) || in_array($card->domain_id, $domain))
		<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domain:</label>
		<select name="domain_id" class="domain_id" type="text" value="{{ isset($card) ? $card->domain_id : '' }}" title="Domain">
			@foreach($domain as $dom)
			<option value="{{ $dom->key}}" {{ (isset($card) && ($card->domain_id == $dom->key)) ? 'selected' : ''}} title="{{ $dom->description }}" >{{ $dom->description }}</option>
			@endforeach
		</select>
		@endif

		@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
		<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Subdomain:</label>
		<select name="subdomain_id" class="subdomain_id" type="text" value="{{ isset($card) ? $card->subdomain_id : '' }}" title="Subdomain">
			@foreach($subdomain as $subdom)
			<option value="{{ $subdom->key}}" {{ (isset($card) && ($card->qubdomain_id == $subdom->key)) ? 'selected' : ''}} title="{{ $subdom->description }}" >{{ $subdom->description }}</option>
			@endforeach
		</select>
		@endif


        <label for="note_id" class="col-md-6 col-form-label text-md-right">Note:</label>
		<input name="note_id" class="note_id" type="text" placeholder="Note" value="" title=""/>

		<label for="context_id" class="col-md-6 col-form-label text-md-right">Contexte:</label>
		<textarea name="context_id" class="context_id" placeholder="Context" value="" title=""></textarea>


        <br>
        <button type="submit" class="btn btn-primary"> Register Card</button>

    </form>
    @extends('layouts.error')
@endsection