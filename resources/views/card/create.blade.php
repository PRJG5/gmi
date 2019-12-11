@extends('layouts.card')
@extends('layouts.app')

@section('content')

	@section('card-header')
		@lang('cards.createCard')
	@endsection

	@section('card-body')
		<form action="{{route('cards.store')}}" id="createForm" method="POST">

			@csrf
			
			<input type="hidden" name="owner" value="{{ isset($owner) ? $owner->name : '' }}" disabled/>

			
			{{-- VEDETTE --}}
			<div class="form-group row">
				<label for="heading" class="col-md-6 col-form-label text-md-right">@lang('cards.heading') :</label>
				<input type="text" name="heading" id="heading" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{ old('heading') }}" required>
				@error('heading')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			<div class="form-group row" id="formHeadingURL" style="display:none;">
				<label for="headingURL" class="col-md-6 col-form-label text-md-right"> Vedette URL : </label>
				<input type="text" name="headingURL" id="headingURL" placeholder="www.example.com">
				@error('headingURL')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			{{-- PHONETIC --}}
			<div class="form-group row" id="formPhonetic">
				<label for="phonetic" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic') :</label>
				<input name="phonetic" type="text" placeholder="@lang('cards.phonetic')" title="@lang('cards.phonetic')" value="{{ old('phonetic') }}"/>
				@error('phonetic')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			
			{{-- LANGUAGES --}}
			<div class="form-group row"  id="formLanguage">
				<label for="language_id" class="col-md-6 col-form-label text-md-right">@lang('cards.language') :</label> 
				<select id="selectLanguage" name="language_id" title="@lang('cards.language')" style="max-width:185px;" required>
					@foreach($languages as $lang)
						<option value="{{ $lang->slug }}" title="{{ $lang->content }}" data-issigned={{$lang->isSigned}}>{{ $lang->content }}</option>
					@endforeach
				</select>
				@error('language_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
			
			{{-- DOMAINS --}}
			<div class="form-group row" id="formDomaine">
				<label for="domain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.domain')</label> 
				<select name="domain_id" class="domain_id" type="text" title="@lang('cards.domain')" >
					<option value="" >----</option>
					@foreach  ($domains as $domain)
						<option value="{{ $domain->id }}" title="{{ $domain->content }}" >{{ $domain->content }}</option>
					@endforeach
				</select>
				@error('domain_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div> 

			{{-- SUBDOMAINS --}}
			<div class="form-group row" id="formSubDomaine">
				<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">@lang('cards.subdomain') : </label> 
				<select name="subdomain_id" class="subdomain_id" type="text" title="@lang('cards.subdomain')" >
					<option value="" >----</option>
					@foreach  ($subdomains as $subdomain)
						<option value="{{ $subdomain->id }}" title="{{ $subdomain->content }}" >{{ $subdomain->content }}</option>
					@endforeach
				</select>
				@error('subdomain_id')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		
			{{-- CONTEXT --}}
			<div class="form-group row" id="formContexte">
				<label for="context" class="col-md-6 col-form-label text-md-right">@lang('cards.context') : </label>
				<textarea id="context" name="context" class="context" value="" title="@lang('cards.context')" placeholder="@lang('cards.context')">{{ old('context') }}</textarea>
				<input type="text" name="contextURL" id="contextURL" placeholder="www.example.com" style="display:none;">
				@error('context')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			{{-- DEFINITION --}}
			<div class="form-group row" id="formDefinition">
				<label for="definition" class="col-md-6 col-form-label text-md-right">@lang('cards.definition') : </label>
				<textarea id="definition" name="definition" class="context" placeholder="@lang('cards.definition')" value="" title="@lang('cards.definition')">{{ old('definition') }}</textarea>
				<input type="text" name="definitionURL" id="definitionURL" placeholder="www.example.com" style="display:none;">
				@error('definition')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>

			{{-- NOTE --}}
			<div class="form-group row">
				<label for="note" class="col-md-6 col-form-label text-md-right">@lang('cards.note') :</label>
				<input name="note" type="text" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{ old('note') }}"/>
				@error('note')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			</div>
		
			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="submitButton btn btn-primary" value="@lang('cards.createCard')"/>
				</div>
			</div>

		</form>
		<script>
			$('.submitButton').click(function(e){
				e.preventDefault();
				$.ajax({
					url: '{{ route('cards.checkvedette') }}',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "post",
					data: {
						vedette: $('.heading').val(),
					},
					success: function (data) {
						if(data.status == "SUCCESS"){
							$( "#createForm" ).submit();
						}else{
							Swal.fire({
								title: 'Vedette déjà existante',
								text: "Une fiche validé avec la même vedette est déjà existante, que voulez-vous faire ?",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Consulter',
								cancelButtonText: 'Créer une nouvelle fiche quand même'
							}).then((result) => {
								if (result.value) {
									window.location.href = "/cards/"+data.id;
								}else if (result.dismiss === Swal.DismissReason.cancel) {
									$("#createForm").submit();
								}
							});
							console.log(data.id);
						}
					},
					error: function () {
						alert('failure');
					}
				});
			});

			$( document ).ready(function(){
				$("#selectLanguage").change(function() {
					if ($("#selectLanguage").find(":selected").data("issigned")) {
							$("#formHeadingURL").show();
							$("#formPhonetic").hide();
							$("#note").attr("placeholder", "wwww.example.com");
							$("#context").hide();
							$("#contextURL").show();
							$("#definition").hide();
							$("#definitionURL").show();
						} else {
							$("#formHeadingURL").hide();
							$("#formPhonetic").show();
							$("#note").attr("placeholder", "Une note");
							$("#context").show();
							$("#contextURL").hide();
							$("#definition").show();
							$("#definitionURL").hide();
						}
				});
				});
		</script>
		@extends('layouts.error')

	@endsection {{-- Section card-body--}}

@endsection {{-- Section content--}}
