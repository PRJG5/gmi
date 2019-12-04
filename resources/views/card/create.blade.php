@extends('layouts.container')

@section('container-title')
	@lang('card.createCard')
@endsection

@section('container-body')
	<form action="{{ route('cards.store')}}" method="POST">

		@csrf

		<div class="form-group row">
			<label for="heading" class="col-sm-2 col-form-label">@lang('card.heading') :</label>
			<input name="heading" class="form-control col-sm-10" type="text" value=""
				   placeholder="@lang('card.heading')" title="@lang('card.heading')" required/>
		</div>

		<div class="form-group row">
			<label for="phonetic" class="col-sm-2 col-form-label">@lang('card.phonetic') :</label>
			<input name="phonetic" class="form-control col-sm-10" type="text" value=""
				   placeholder="@lang('card.phonetic')" title="@lang('card.phonetic')"/>
		</div>

		<div class="form-group row">
			<label for="language_id" class="col-sm-2 col-form-label">@lang('card.language') :</label>
			<select name="language_id" class="form-control col-sm-10" type="text"
					title="@lang('card.language')" required>
				@foreach  ($languages as $lang)
					<option value="{{ $lang->key }}"
							{{ (isset($card) && ($card->language_id == $lang->key)) ? 'selected' : '' }} title="{{ $lang->description }}">{{ $lang->description }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="domain_id" class="col-sm-2 col-form-label">@lang('card.domain') :</label>
			<select name="domain_id" class="form-control col-sm-10" type="text" title="@lang('card.domain')">
				@foreach($domain as $dom)
					<option value="{{ $dom->id }}"
							{{ (isset($card) && ($card->domain_id == $dom->id)) ? 'selected' : ''}} title="{{ $dom->content }}">{{ $dom->content }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="subdomain_id" class="col-sm-2 col-form-label">@lang('card.subdomain') :</label>
			<select name="subdomain_id" class="form-control col-sm-10" type="text"
					title="@lang('card.subdomain')">
				@foreach($subdomain as $subdom)
					<option value="{{ $subdom->id }}"
							{{ (isset($card) && ($card->subdomain_id == $subdom->id)) ? 'selected' : ''}} title="{{ $subdom->content }}">{{ $subdom->content }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group row">
			<label for="definition" class="col-sm-2 col-form-label">@lang('card.definition') :</label>
			<input name="definition" class="form-control col-sm-10" type="text" value=""
				   placeholder="@lang('card.definition')" title="@lang('card.definition')"/>
		</div>

		<div class="form-group row">
			<label for="note" class="col-sm-2 col-form-label">@lang('card.note') :</label>
			<input name="note" class="form-control col-sm-10" type="text" value="" placeholder="@lang('card.note')"
				   title="@lang('card.note')"/>
		</div>

		<div class="form-group row">
			<label for="context" class="col-sm-2 col-form-label">@lang('card.context') :</label>
			<textarea name="context" class="form-control col-sm-10" placeholder="@lang('card.context')"
					  title="@lang('card.context')"></textarea>
		</div>

		<div class="form-group form-check">
			<input class="btn btn-primary" type="submit" value="@lang('card.createCard')"
				   title="@lang('card.createCard')"/>
		</div>

	</form>
	@extends('layouts.error')
@endsection
