@extends('layouts.card')
@extends('layouts.app')
@section('content')
@section('card-header')

    Register Card
    
@endsection

@section('card-body')
    <form action="{{route('cards.store')}}" method="POST">
		@csrf
		
		{{-- VEDETTE --}}
        <div class="form-group row">
            <label for="heading" class="col-md-6 col-form-label text-md-right"> Vedette : </label>
			<input type="text" name="heading" id="heading" required>
		</div>
        <div class="form-group row" id="formHeadingURL" style="display:none;">
			<label for="headingURL" class="col-md-6 col-form-label text-md-right"> Vedette URL : </label>
			<input type="text" name="headingURL" id="headingURL" placeholder="www.example.com">
        </div>

		{{-- PHONETIC --}}
        <div class="form-group row" id="formPhonetic">
			<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
			<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="" title="Phonetic"/>
		</div>
		
		{{-- LANGUAGES --}}
        <div class="form-group row" id="formLanguage">
			<label for="language_id" class="col-md-6 col-form-label text-md-right">Langue : </label> 
			@if (count($languages) != 0)
				<select id="selectLanguage" name="language_id" class="language_id" type="text" title="Language" required>
					@foreach  ($languages as $lang)
						<option value="{{ $lang->slug }}" title="{{ $lang->content }}" >{{ $lang->content }}</option>
					@endforeach
				</select>
			@else
				<p id="selectLanguage">Pas de langues liées au compte</p> 
			@endif
			
		</div>       
		
		{{-- DOMAINS --}}
        <div class="form-group row" id="formDomaine">
			<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domaine : </label> 
			<select name="domain_id" class="domain_id" type="text" title="Domain" >
				<option value="" >----</option>
				@foreach  ($domains as $domain)
					<option value="{{ $domain->id }}" title="{{ $domain->content }}" >{{ $domain->content }}</option>
				@endforeach
			</select>
        </div> 

		{{-- SUBDOMAINS --}}
        <div class="form-group row" id="formSubDomaine">
			<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Sous domaine : </label> 
			<select name="subdomain_id" class="subdomain_id" type="text" title="Subdomain" >
				<option value="" >----</option>
				@foreach  ($subdomains as $subdomain)
					<option value="{{ $subdomain->id }}" title="{{ $subdomain->content }}" >{{ $subdomain->content }}</option>
				@endforeach
			</select>
        </div> 
		
		{{-- CONTEXT --}}
		<div class="form-group row" id="formContexte">
			<label for="context" class="col-md-6 col-form-label text-md-right">Contexte : </label>
			<textarea id="context" name="context" class="context" placeholder="Context" value="" title="Context" placeholder="Un contexte"></textarea>
			<input type="text" name="contextURL" id="contextURL" placeholder="www.example.com" style="display:none;">
		</div>

		{{-- DEFINITION --}}
		<div class="form-group row" id="formDefinition">
			<label for="definition" class="col-md-6 col-form-label text-md-right">Definition : </label>
			<textarea id="definition" name="definition" class="context" placeholder="Definition" value="" title="Definition" placeholder="Une définition"></textarea>
			<input type="text" name="definitionURL" id="definitionURL" placeholder="www.example.com" style="display:none;">
		</div>

		{{-- NOTE --}}
		<div class="form-group row" id="formNote">
			<label for="note" class="col-md-6 col-form-label text-md-right">Note : </label>
			<input id="note" name="note" class="note" type="text" placeholder="Note" value="" title="Note" placeholder="Une note"/>
		</div>

        <br>
        <button type="submit" class="btn btn-primary"> Register Card</button>

    </form>
    @extends('layouts.error')
@endsection {{-- Section card-body--}}
@endsection {{-- Section content--}}

@section('myScripts')
<script>
$( document ).ready(function(){
	$("#selectLanguage").change(function() {
		if ($("#selectLanguage").val() == "SSI" //TODO: no hard code
			|| $("#selectLanguage").val() == "LSBN"
			|| $("#selectLanguage").val() == "LSBF") {
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
@endsection
