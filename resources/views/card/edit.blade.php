@extends('layouts.card')

@section('card-header')
@lang('card.editCard')
@endsection

@section('card-body')
	<form action="{{route('cards.store')}}" method="POST">
		@csrf
		<div class="form-group row">
			<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('card.heading') :</label>
			<input type="text" name="heading" id="heading" value="{{$card->heading}}" readonly>
		</div>

		<input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

		<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('card.language') :</label> 
		<label>{{$card->language_id}}</label>
		

		@if (!isset($card) || in_array($card->domain_id, $domain))
		<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('card.domain') :</label>
		<select name="domain_id" class="domain_id" type="text" value="{{$card->domain_id}}" title="@lang('card.domain')">
			@foreach($domain as $dom)
			<option value="{{ $dom->key}}" {{ (isset($card) && ($card->domain_id == $dom->key)) ? 'selected' : ''}} title="{{ $dom->description }}" >{{ $dom->description }}</option>
			@endforeach
		</select>
		@endif

		@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
		<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('card.subdomain') :</label>
		<select name="subdomain_id" class="subdomain_id" type="text" value="{{$card->subdomain_id}}" title="@lang('card.subdomain')">
			@foreach($subdomain as $subdom)
			<option value="{{ $subdom->key}}" {{ (isset($card) && ($card->qubdomain_id == $subdom->key)) ? 'selected' : ''}} title="{{ $subdom->description }}" >{{ $subdom->description }}</option>
			@endforeach
		</select>
		@endif


		<label for="note_id" class="col-md-6 col-form-label text-md-right">@lang('card.note') :</label>
		<input name="note_id" class="note_id" type="text" value="{{$card->note_id}}" title="@lang('card.note')"/>

		<label for="context_id" class="col-md-6 col-form-label text-md-right">@lang('card.context') :</label>
		<textarea name="context_id" class="context_id" value="{{$card->context_id}}" title="@lang('card.context')"></textarea>


		<br>
		<button type="submit" class="btn btn-primary">@lang('card.editCard')</button>

	</form>
	
	<!--<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />-->
	<a href="mailto:{{$owner->name}}<{{$owner->email}}>?subject={{$mail['subject']}}&body={{$mail['body']}}" class="buttonLike">@lang('misc.sendEmail')</a>
	@extends('layouts.error')
@endsection
