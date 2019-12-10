@extends('layouts.card')
@extends('layouts.app')

@section('content')

	@section('card-header')
		@lang('cards.createCard')
	@endsection

	@section('card-body')
		<form action="{{route('cards.store')}}" method="POST">

			@csrf
			
			<input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

			<div class="form-group row">
				<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('cards.heading') :</label>
				<input name="heading" type="text" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{ old('heading') }}">
				@error('heading')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			<div class="form-group row">
				<label for="phonetic" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic') :</label>
				<input name="phonetic" type="text" placeholder="@lang('cards.phonetic')" title="@lang('cards.phonetic')" value="{{ old('phonetic') }}"/>
				@error('phonetic')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			
			@if (!isset($card) || in_array($card->language_id, $languages))
			<div class="form-group row">
				<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('cards.language') :</label> 
				<select name="language_id" type="text" title="@lang('cards.language')" style="max-width:185px;">
					@foreach($languages as $lang)
					<option value="{{ $lang->slug }}" title="{{ $lang->content }}" >{{ $lang->content }}</option>
					@endforeach
				</select>
				@error('language_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			@endif
			
			@if (!isset($card) || in_array($card->domain_id, $domain))
			<div class="form-group row">
				<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.domain') :</label>
				<select name="domain_id" type="text" title="@lang('cards.domain')">
					@foreach($domain as $dom)
					<option value="{{ $dom->id}}" title="{{ $dom->content }}" >{{ $dom->content }}</option>
					@endforeach
				</select>
				@error('domain_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			@endif

			@if (!isset($card) || in_array($card->subdomain_id, $subdomain))
			<div class="form-group row">
				<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.subdomain') :</label>
				<select name="subdomain_id" type="text" title="@lang('cards.subdomain')">
					@foreach($subdomain as $subdom)
					<option value="{{ $subdom->id}}" title="{{ $subdom->content }}" >{{ $subdom->content }}</option>
					@endforeach
				</select>
				@error('subdomain_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			@endif

			<div class="form-group row">
				<label for="note" class="col-md-6 col-form-label text-md-right">@lang('cards.note') :</label>
				<input name="note" type="text" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{ old('note') }}"/>
				@error('note')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			<div class="form-group row">
				<label for="context" class="col-md-6 col-form-label text-md-right">@lang('cards.context') :</label>
				<textarea name="context" type="text" placeholder="@lang('cards.context')" title="@lang('cards.context')">{{ old('context') }}</textarea>
				@error('context')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			<div class="form-group row">
				<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('cards.definition') :</label>
				<textarea name="definition" type="text" placeholder="@lang('cards.definition')" title="@lang('cards.definition')">{{ old('definition') }}</textarea>
				@error('definition')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		
			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="btn btn-primary" value="@lang('cards.createCard')"/>
				</div>
			</div>

		</form>
		@extends('layouts.error')

	@endsection

@endsection
