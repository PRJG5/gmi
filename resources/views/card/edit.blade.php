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

			<input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

			<div class="form-group row">
				<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('cards.heading') :</label>
				<input name="heading" type="text" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{$card->heading}}" readonly>
			</div>

			<div class="form-group row">
				<label for="phonetic" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic') :</label>
				<input name="phonetic" type="text" placeholder="@lang('cards.phonetic')" title="@lang('cards.phonetic')" value="{{isset($phonetic) ? $phonetic->textDescription : '' }}"/>
			</div>

			<div class="form-group row">
				<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('cards.language') :</label> 
				<input name="language_id" type="text" placeholder="@lang('cards.language')" title="@lang('cards.language')" value="{{$card->language_id}}" readonly>
			</div>

			<!--METTRE LES VALEURS PAR DEFAUT A DOMAIN ET SUBDOMAIN-->
			<div class="form-group row">
				<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.domain') :</label>
				<select name="domain_id" title="@lang('cards.domain')">
					@foreach($domain as $dom)
					<option value="{{ $dom->id}}" title="{{ $dom->content }}" {{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}}>{{ $dom->content }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group row">
				<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.subdomain') :</label>
				<select name="subdomain_id" title="@lang('cards.subdomain')">
					@foreach($subdomain as $subdom)
					<option value="{{ $subdom->id}}" title="{{ $subdom->content }}" {{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}}>{{ $subdom->content }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group row">
				<label for="note" class="col-md-6 col-form-label text-md-right">@lang('cards.note') :</label>
				<input name="note" type="text" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{isset($note) ? $note->description : ' '}}"/>
			</div>
			
			<div class="form-group row">
				<label for="context" class="col-md-6 col-form-label text-md-right">@lang('cards.context') :</label>
				<textarea name="context" type="text" placeholder="@lang('cards.context')" title="@lang('cards.context')">{{isset($context) ? $context->context_to_string : ''}}</textarea>
			</div>

			<div class="form-group row">
				<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('cards.definition') :</label>
				<textarea name="definition" type="text" placeholder="@lang('cards.definition')" title="@lang('cards.definition')">{{isset($definition) ? $definition->definition_content : ''}}</textarea>
			</div>

			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="btn btn-primary" value="@lang('cards.saveChanges')"/>
				</div>
			</div>

			@if(Auth::user()->role == \App\Enums\Roles::ADMIN)
				<div class="form-group row">
					<div style="margin:auto;">
						<a href="mailto:{{$owner->name}}<{{$owner->email}}>;?subject={{$mail['subject']}}&body={{$mail['description']}}">@lang('cards.contactOwner')</a>
					</div>
				</div>
			@endif

		</form>
		@extends('layouts.error')

	@endsection

@endsection
