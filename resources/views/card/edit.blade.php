@extends('layouts.card')
@extends('layouts.app')

@section('content')

	@section('card-header')
		@lang('cards.editCard')
	@endsection

	@section('card-body')
		<form action="{{route('cards.update', $card)}}" method="POST">

			@method('PUT')

			@csrf

			{{-- AUTHOR --}}
			{{-- TODO: what is it ? --}}
			<input type="hidden" name="owner" value="{{ isset($card->owner) ? $card->owner->name : '' }}" disabled/>
	   
			{{-- HEADING --}}
			<div class="form-group row">
				<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('cards.heading') :</label>
				<input type="text" name="heading" id="heading" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{$card->heading}}" readonly>
			</div>
			{{-- HEADING URL --}}
			@if ($card->language->isSigned)
				<div class="form-group row">
					<label for="headingURL" class="col-md-6 col-form-label text-md-right">@lang('cards.headingURL') : </label>
					<input type="text" name="headingURL" id="headingURL" value="{{$card->headingURL}}" title="@lang('cards.headingURL')" placeholder="www.example.com">
				</div>
			@endif
			
			{{-- PHONETIC --}}
			@if (!$card->language->isSigned)
				<div class="form-group row">
					<label for="phonetic" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic') :</label>
					<input name="phonetic" class="phonetic" type="text" placeholder="@lang('cards.phonetic')" value="{{isset($card->phonetic) ? $card->phonetic->textDescription : ''}}" title="@lang('cards.phonetic')"/>
				</div>
			@endif
			
			{{-- LANGUAGE --}}
			<div class="form-group row">
				<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('cards.language') :</label> 
				<input name="language_id" type="text" placeholder="@lang('cards.language')" title="@lang('cards.language')" value="{{$card->language_id}}" readonly>
			</div>

			<!--METTRE LES VALEURS PAR DEFAUT A DOMAIN ET SUBDOMAIN-->
			{{-- DOMAIN --}}
			<div class="form-group row">
				<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.domain') :</label>
				<select name="domain_id" title="@lang('cards.domain')">
					@if (!isset($card->domain))
						<option value="" >----</option>
					@endif
					@foreach($domains as $dom)
						<option value="{{ $dom->id}}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}" >{{ $dom->content }}</option>
					@endforeach
				</select>
			</div>

			{{-- SUBDOMAIN --}}
			<div class="form-group row">
				<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.subdomain') :</label>
				<select name="subdomain_id" title="@lang('cards.subdomain')">
					@if (!isset($card->subdomain))
						<option value="" >----</option>
					@endif
					@foreach($subdomains as $subdom)
						<option value="{{ $subdom->id}}" title="{{ $subdom->content }}" {{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}}>{{ $subdom->content }}</option>
					@endforeach
				</select>
			</div>
			
			{{-- CONTEXT --}}
			<div class="form-group row">
				<label for="context" class="col-md-6 col-form-label text-md-right">@lang('cards.context') :</label>
				@php
					$context = $card->context
				@endphp
				@if ($card->language->isSigned)
					<input name="context" value="{{isset($context) ? $context->context_to_string : ''}}" placeholder="www.example.com" title="@lang('cards.context')" >
				@else
					<textarea name="context" value="{{isset($context) ? $context->context_to_string : ''}}" title="@lang('cards.context')" placeholder="@lang('cards.context')">{{isset($context) ? $context->context_to_string : ""}}</textarea>
				@endif
			</div>

			{{-- DEFINITION --}}
			<div class="form-group row">
				<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('cards.definition') : </label>
				@php
					$def = $card->definition
				@endphp 
				@if ($card->language->isSigned)
					<input name="definition" value="{{isset($def) ? $def->definition_content : ''}}" title="@lang('cards.definition')" placeholder="www.example.com">
				@else
					<textarea name="definition" value="{{isset($def) ? $def->definition_content : ''}}" title="@lang('cards.definition')" placeholder="@lang('cards.definition')">{{isset($def) ? $def->definition_content : ""}}</textarea>
				@endif
			</div>

			{{-- NOTE --}}
			<div class="form-group row">
				<label for="note" class="col-md-6 col-form-label text-md-right">@lang('cards.note') :</label>
				<input name="note" type="text" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{isset($note) ? $note->description : ' '}}"/>
			</div>

			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="btn btn-primary" value="@lang('cards.saveChanges')"/>
				</div>
			</div>

			@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
				<div class="form-group row">
					<div style="margin:auto;">
						<a href="mailto:{{$card->owner->name}}<{{$card->owner->email}}>;?subject={{$mail['subject']}}&body={{$mail['description']}}">@lang('cards.contactOwner')</a>
					</div>
				</div>
			@endif

		</form>
		@extends('layouts.error')

	@endsection {{-- Section card-body--}}

@endsection {{-- Section content--}}
