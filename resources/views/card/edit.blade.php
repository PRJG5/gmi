@extends('layouts.card')

@section('card-header')
@lang('card.editCard')
@endsection

@section('card-body')
	<form action="{{ route('cards.store')}}" method="POST">

		@csrf
		
		<div class="form-group row">
			<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('card.heading') :</label>
			<input name="heading" class="heading" type="text" value="{{ $card->heading }}" placeholder="@lang('card.heading')" title="@lang('card.heading')" readonly/>
		</div>

		<div class="form-group row">
			<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('card.language') :</label>
			<select name="language_id" class="language_id" type="text" value="" title="@lang('card.language')" readonly>
				@foreach  ($languages as $lang)
				<option value="{{ $lang->key }}" {{ $card->language_id == $lang->key ? 'selected' : '' }} title="{{ $lang->description }}" >{{ $lang->description }}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group row">
			<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('card.domain') :</label>
			<select name="domain_id" class="domain_id" type="text" value="{{ $card->domain_id }}" title="@lang('card.domain')">
				@foreach($domain as $dom)
				<option value="{{ $dom->key }}" {{ $card->domain_id == $dom->key ? 'selected' : ''}} title="{{ $dom->description }}" >{{ $dom->description }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
			<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('card.subdomain') :</label>
			<select name="subdomain_id" class="subdomain_id" type="text" value="{{ $card->subdomain_id }}" title="@lang('card.subdomain')">
				@foreach($subdomain as $subdom)
				<option value="{{ $subdom->key }}" {{ $card->subdomain_id == $subdom->key ? 'selected' : ''}} title="{{ $subdom->description }}" >{{ $subdom->description }}</option>
				@endforeach
			</select>
			@endif
		</div>

		<div class="form-group row">
			<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('card.definition') :</label>
			<input name="definition" class="definition" type="text" value="{{ isset($definition) ? $definition->definition_content : '' }}" placeholder="@lang('card.definition')" title="@lang('card.definition')"/>
		</div>

		<div class="form-group row">
			<label for="note" class="col-md-6 col-form-label text-md-right">@lang('card.note') :</label>
			<input name="note" class="note" type="text" value="{{ isset($note) ? $note->description : '' }}" placeholder="@lang('card.note')" title="@lang('card.note')"/>
		</div>

		<div class="form-group row">
			<label for="context" class="col-md-6 col-form-label text-md-right">@lang('card.context') :</label>
			<textarea name="context" class="context" placeholder="@lang('card.context')" title="@lang('card.context')">{{ isset($context) ? $context->context_to_string : '' }}</textarea>
		</div>

		<div class="form-group form-check">
			<input class="btn btn-primary" type="submit" value="@lang('misc.save')" title="@lang('misc.save')"/>
			<a class="btn btn-secondary" href="mailto:{{ $owner->name }}<{{$owner->email }}>?subject={{$mail['subject']}}&body={{$mail['body']}}" title="@lang('misc.sendEmail')">@lang('misc.sendEmail')</a>
		</div>

	</form>
	
	<!--<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />-->
	@extends('layouts.error')
@endsection
