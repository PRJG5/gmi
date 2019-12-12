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
				<input type="text" name="heading" class="heading" id="heading" placeholder="@lang('cards.heading')" title="@lang('cards.heading')" value="{{ old('heading') }}" required>
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
				<input name="phonetic" oninput="showPhoneticDiv(this)" type="text" placeholder="@lang('cards.phonetic')" title="@lang('cards.phonetic')" value="{{ old('phonetic') }}"/>
				@error('phonetic')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
			<!-- Classic tabs -->
				<div class="classic-tabs mx-2" id="phoneticDiv" style="width:100%;display:none">
					<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
						<li class="nav-item">
							<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#profile-classic-orange"
							   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#follow-classic-orange"
							   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#contact-classic-orange"
							   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																										  aria-hidden="true"></i></a>
						</li>
					</ul>

					<div class="tab-content card" id="myClassicTabContentOrange">
						<div class="tab-pane fade active show" id="profile-classic-orange" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
							<label for="phonetic_img" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_img') :</label>
							<input name="phonetic_img" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_img')" value="{{ old('phonetic_img') }}"/>
						</div>
						<div class="tab-pane fade" id="follow-classic-orange" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
							<label for="phonetic_link" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_link') :</label>
							<input name="phonetic_link" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_link')" value="{{ old('phonetic_link') }}"/>
						</div>
						<div class="tab-pane fade" id="contact-classic-orange" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
							<label for="phonetic_music" class="col-md-6 col-form-label text-md-right">@lang('cards.phonetic_music') :</label>
							<input name="phonetic_music" type="url" placeholder="www.example.com" title="@lang('cards.phonetic_music')" value="{{ old('phonetic_music') }}"/>
						</div>
					</div>

				</div>
				<!-- Classic tabs -->
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
				<textarea id="context" oninput="showContextDiv(this)" name="context" class="context" value="" title="@lang('cards.context')" placeholder="@lang('cards.context')">{{ old('context') }}</textarea>
				<input type="text" name="#" oninput="showContextDiv(this)" id="contextURL" placeholder="www.example.com" style="display:none;">
				@error('context')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
				<!-- Classic tabs -->
				<div class="classic-tabs mx-2" id="contextDiv" style="width:100%;display:none">
					<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
						<li class="nav-item">
							<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#context_img"
							   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#context_link"
							   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#context_music"
							   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																										  aria-hidden="true"></i></a>
						</li>
					</ul>

					<div class="tab-content card" id="myClassicTabContentOrange">
						<div class="tab-pane fade active show" id="context_img" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
							<label for="context_img" class="col-md-6 col-form-label text-md-right">@lang('cards.context_img') :</label>
							<input name="context_img" type="url" placeholder="www.example.com" title="@lang('cards.context_img')" value="{{ old('context_img') }}"/>
						</div>
						<div class="tab-pane fade" id="context_link" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
							<label for="context_link" class="col-md-6 col-form-label text-md-right">@lang('cards.context_link') :</label>
							<input name="context_link" type="url" placeholder="www.example.com" title="@lang('cards.context_link')" value="{{ old('context_link') }}"/>
						</div>
						<div class="tab-pane fade" id="context_music" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
							<label for="context_music" class="col-md-6 col-form-label text-md-right">@lang('cards.context_music') :</label>
							<input name="context_music" type="url" placeholder="www.example.com" title="@lang('cards.context_music')" value="{{ old('context_music') }}"/>
						</div>
					</div>

				</div>
				<!-- Classic tabs -->
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
				<input name="note" type="text" oninput="showNoteDiv(this)" placeholder="@lang('cards.note')" title="@lang('cards.note')" value="{{ old('note') }}"/>
				@error('note')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
				<!-- Classic tabs -->
				<div class="classic-tabs mx-2" id="noteDiv" style="width:100%;display:none">
					<ul class="nav tabs-orange" id="myClassicTabOrange" role="tablist">
						<li class="nav-item">
							<a class="nav-link  waves-light active show" id="profile-tab-classic-orange" data-toggle="tab" href="#note_image"
							   role="tab" aria-controls="profile-classic-orange" aria-selected="true"><i class="fas fa-image"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="follow-tab-classic-orange" data-toggle="tab" href="#note_link"
							   role="tab" aria-controls="follow-classic-orange" aria-selected="false"><i class="fas fa-link"
																										 aria-hidden="true"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link waves-light" id="contact-tab-classic-orange" data-toggle="tab" href="#note_music"
							   role="tab" aria-controls="contact-classic-orange" aria-selected="false"><i class="fas fa-music"
																										  aria-hidden="true"></i></a>
						</li>
					</ul>

					<div class="tab-content card" id="myClassicTabContentOrange">
						<div class="tab-pane fade active show" id="note_image" role="tabpanel" aria-labelledby="profile-tab-classic-orange">
							<label for="note_img" class="col-md-6 col-form-label text-md-right">@lang('cards.note_img') :</label>
							<input name="note_img" type="url" placeholder="www.example.com" title="@lang('cards.note_img')" value="{{ old('note_img') }}"/>
						</div>
						<div class="tab-pane fade" id="note_link" role="tabpanel" aria-labelledby="follow-tab-classic-orange">
							<label for="note_link" class="col-md-6 col-form-label text-md-right">@lang('cards.note_link') :</label>
							<input name="note_link" type="url" placeholder="www.example.com" title="@lang('cards.note_link')" value="{{ old('note_link') }}"/>
						</div>
						<div class="tab-pane fade" id="note_music" role="tabpanel" aria-labelledby="contact-tab-classic-orange">
							<label for="note_music" class="col-md-6 col-form-label text-md-right">@lang('cards.note_music') :</label>
							<input name="note_music" type="url" placeholder="www.example.com" title="@lang('cards.note_music')" value="{{ old('note_music') }}"/>
						</div>
					</div>

				</div>
				<!-- Classic tabs -->
			</div>
			@if(isset($cardOriginId))
			<div class="form-group row">
				
					<input type="hidden"  name= "cardOriginId" value="{{$cardOriginId}}"/>
				
			</div>
			@endif
		
			<div class="form-group row">
				<div style="margin:auto;">
					<input type="submit" class="submitButton btn btn-primary" value="@lang('cards.createCard')"/>
				</div>
			</div>

			

		</form>
		<script>
			function showPhoneticDiv(event){
				if(event.value.length != 0){
					$('#phoneticDiv').show();
				}else{
					$('#phoneticDiv').hide();
				}
			}
			function showNoteDiv(event){
				if(event.value.length != 0){
					$('#noteDiv').show();
				}else{
					$('#noteDiv').hide();
				}
			}
			function showContextDiv(event){
				if(event.value.length != 0){
					$('#contextDiv').show();
				}else{
					$('#contextDiv').hide();
				}
			}
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

			// CHANGE THE VIEW ACCORDING TO THE LANGUAGE
			function switchSignedLanguage() {
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
			}
			$( document ).ready(function(){
				$("#selectLanguage").change(switchSignedLanguage); // Change the view when the language change
				switchSignedLanguage(); // Change the view if the first language is signed
			});

		</script>
		@extends('layouts.error')

	@endsection {{-- Section card-body--}}

@endsection {{-- Section content--}}
