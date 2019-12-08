@extends('layouts.card')
@extends('layouts.app')
@section('content')
@section('card-header')

    Register Card
    
@endsection

@section('card-body')
    <form action="{{route('cards.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="heading" class="col-md-6 col-form-label text-md-right"> Vedette : </label>
			<input type="text" name="heading" id="heading" required>
		</div>
		
        <div class="form-group row" id="formHeadingURL" hidden>
			<label for="headingURL" class="col-md-6 col-form-label text-md-right"> Vedette URL : </label>
			<input type="text" name="headingURL" id="headingURL" placeholder="www.example.com">
        </div>

        <div class="form-group row" id="formPhonetic">
			<label for="phonetic" class="col-md-6 col-form-label text-md-right">Phonetic:</label>
			<input name="phonetic" class="phonetic" type="text" placeholder="Phonetic" value="" title="Phonetic"/>
		</div>
		
        <div class="form-group row" id="formLanguage">
			<label for="language_id" class="col-md-6 col-form-label text-md-right">Langue : </label> 
			<select id="selectLanguage" name="language_id" class="language_id" type="text" {{-- value="{{$languages->id}}"--}} title="Language" required>
					<option value="FRA" title="FRA" >FRA</option>
					<option value="ILS" title="ILS" >ILS</option>
				{{-- @foreach  ($languages as $lang)
				<option value="{{ $lang->slug }}" title="{{ $lang->content }}" >{{ $lang->content }}</option>
				@endforeach --}}
			</select>
		</div>       
		
        {{-- <div class="form-group row" id="formDomaine">
			<label for="domain_id" class="col-md-6 col-form-label text-md-right">Domaine : </label> 
			<select name="domain_id" class="domain_id" type="text" value="{{$domains->id}}" title="Domain" >
				@foreach  ($domains as $domain)
					<option value="{{ $domain->id }}" title="{{ $domain->content }}" >{{ $domain->content }}</option>
				@endforeach
			</select>
        </div> 

        <div class="form-group row" id="formSubDomaine">
			<label for="subdomain_id" class="col-md-6 col-form-label text-md-right">Sous domaine : </label> 
			<select name="subdomain_id" class="subdomain_id" type="text" value="{{$subdomains->id}}" title="Subdomain" >
				@foreach  ($subdomains as $subdomain)
					<option value="{{ $subdomain->id }}" title="{{ $subdomain->content }}" >{{ $subdomain->content }}</option>
				@endforeach
			</select>
        </div>  --}}


		<div class="form-group row" id="formNote">
			<label for="note" class="col-md-6 col-form-label text-md-right">Note : </label>
			<input name="note" class="note" type="text" placeholder="Note" value="" title="Note" placeholder="Une note"/>
		</div>
        
		<div class="form-group row" id="formContexte">
			<label for="context" class="col-md-6 col-form-label text-md-right">Contexte : </label>
			<textarea name="context" class="context" placeholder="Context" value="" title="Context" placeholder="Un contexte"></textarea>
		</div>

		
		<div class="form-group row" id="formDefinition">
			<label for="definition" class="col-md-6 col-form-label text-md-right">Definition : </label>
			<textarea name="definition" class="context" placeholder="Definition" value="" title="Definition" placeholder="Une définition"></textarea>
		</div>

        <br>
        <button type="submit" class="btn btn-primary"> Register Card</button>

    </form>
    @extends('layouts.error')
@endsection
@endsection
