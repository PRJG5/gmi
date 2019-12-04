@extends('card.template')

@section('template-title')
{{$card->heading}}
@endsection

@section('template-body')
<div>
	<section class="form-group row">
		<label class="col-sm-3 col-form-label">@lang('card.heading') :</label>
		<label class="col-sm-9 form-control h-auto">{{$card->heading}}</label>
	</section>

	@if(isset($card->phonetic_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.phonetic') :</label>
			<label class="col-sm-9 form-control h-auto">{{$phonetic->text_description}}</label>
		</section>
	@endif

	<section class="form-group row">
		<label class="col-sm-3 col-form-label">@lang('card.language') :</label>
		<label class="col-sm-9 form-control h-auto">{{$language->content}}</label>
	</section>

	@if(isset($card->domain_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.domain') :</label>
			<label class="col-sm-9 form-control h-auto">{{$domain->content}}</label>
		</section>
	@endif

	@if(isset($card->subdomain_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.subdomain') :</label>
			<label class="col-sm-9 form-control h-auto">{{$subdomain->content}}</label>
		</section>
	@endif

	@if(isset($card->definition_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.definition') :</label>
			<label class="col-sm-9 form-control h-auto">{{$definition->definition_content}}</label>
		</section>
	@endif

	@if(isset($card->note_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.note') :</label>
			<label class="col-sm-9 form-control h-auto">{{$note->description}}</label>
		</section>
	@endif

	@if(isset($card->context_id))
		<section class="form-group row">
			<label class="col-sm-3 col-form-label">@lang('card.context') :</label>
			<label class="col-sm-9 form-control h-auto">{{$context->context_to_string}}</label>
		</section>
	@endif
</div>
@endsection
