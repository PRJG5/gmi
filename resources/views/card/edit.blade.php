@extends('layouts.container')

@section('container-title')
	@lang('card.editCard')
@endsection

@section('container-body')
	<form action="{{ route('cards.update', $card)}}" method="POST">

		@method('PUT')
		@csrf

		<div class="form-group row">
			<label for="heading" class="col-sm-3 col-form-label">@lang('card.heading') :</label>
			<input name="heading" class="form-control col-sm-9" type="text" value="{{ $card->heading }}"
				   placeholder="@lang('card.heading')" title="@lang('card.heading')" readonly disabled/>
		</div>

		<div class="form-group row">
			<label for="phonetic" class="col-sm-3 col-form-label">@lang('card.phonetic') :</label>
			<input name="phonetic" class="form-control col-sm-9" type="text"
				   value="{{ isset($phonetic) ? $phonetic->text_description : '' }}"
				   placeholder="@lang('card.phonetic')" title="@lang('card.phonetic')"/>
		</div>

		<div class="form-group row">
			<label for="language_id" class="col-sm-3 col-form-label">@lang('card.language') :</label>
			<select name="language_id" class="form-control col-sm-9" type="text" title="@lang('card.language')"
					readonly disabled>
				@foreach($languages as $lang)
					<option value="{{ $lang->key }}"
							{{ $card->language_id == $lang->slug ? 'selected' : '' }} title="{{ $lang->content }}">{{ $lang->content }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="domain_id" class="col-sm-3 col-form-label">@lang('card.domain') :</label>
			<select name="domain_id" class="form-control col-sm-9" type="text"
					title="@lang('card.domain')">
				@foreach($domains as $dom)
					<option value="{{ $dom->id }}"
							{{ $card->domain_id == $dom->id ? 'selected' : ''}} title="{{ $dom->content }}">{{ $dom->content }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="subdomain_id" class="col-sm-3 col-form-label">@lang('card.subdomain') :</label>
			<select name="subdomain_id" class="form-control col-sm-9" type="text"
					title="@lang('card.subdomain')">
				@foreach($subdomains as $subdom)
					<option value="{{ $subdom->id }}"
							{{ $card->subdomain_id == $subdom->id ? 'selected' : ''}} title="{{ $subdom->content }}">{{ $subdom->content }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="definition" class="col-sm-3 col-form-label">@lang('card.definition') :</label>
			<input name="definition" class="form-control col-sm-9" type="text"
				   value="{{ isset($definition) ? $definition->definition_content : '' }}"
				   placeholder="@lang('card.definition')" title="@lang('card.definition')"/>
		</div>

		<div class="form-group row">
			<label for="note" class="col-sm-3 col-form-label">@lang('card.note') :</label>
			<input name="note" class="form-control col-sm-9" type="text"
				   value="{{ isset($note) ? $note->description : '' }}" placeholder="@lang('card.note')"
				   title="@lang('card.note')"/>
		</div>

		<div class="form-group row">
			<label for="context" class="col-sm-3 col-form-label">@lang('card.context') :</label>
			<textarea name="context" class="form-control col-sm-9" placeholder="@lang('card.context')"
					  title="@lang('card.context')">{{ isset($context) ? $context->context_to_string : '' }}</textarea>
		</div>

		<div class="form-group form-check">
			<input class="btn btn-primary" type="submit" value="@lang('misc.save')" title="@lang('misc.save')"/>
		</div>

	</form>
	@extends('layouts.error')
@endsection
