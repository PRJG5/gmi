@extends('layouts.card')
@section('card-header')
@lang('misc.addBasicData')
@endsection
@section('card-body')
<!-- Domain -->
<div>
	<div style="display:none;" class="alert alert-success" role="alert" id="statusSuccess">@lang('misc.saved')</div>
	<div style="display:none;" class="alert alert-danger" role="alert" id="statusError">@lang('misc.error')</div>
	<div class="form-group">
		<label for="domain">@lang('card.domain')</label>
		<input name="domain" id="subdomain" class="form-control" placeholder="@lang('misc.domainName')" type="text" />
	</div>
	<button onclick="addDomain()" class="btn btn-primary">@lang('misc.addDomain')</button>
</div>
<br>
<hr>

<!-- Subdomain -->
<div>
	<div style="display:none;" class="alert alert-success" role="alert" id="statusSuccess">@lang('misc.saved')</div>
	<div style="display:none;" class="alert alert-danger" role="alert" id="statusError">@lang('misc.error')</div>
	<div class="form-group">
		<label for="subdomain">@lang('card.subdomain')</label>
		<input name="subdomain" id="subdomain" class="form-control" placeholder="@lang('misc.subdomainName')" type="text" />
	</div>
	<button onclick="addSubdomain()" class="btn btn-primary">@lang('misc.addSubdomain')</button>
</div>
<br>
<hr>

<!-- language -->
<div>
	<div class="form-group">
		<label for="language">@lang('card.language')</label>
		<input id="language" class="form-control" name="language" placeholder="@lang('misc.languageName')" type="text" />
		<label for="codeIso">@lang('misc.languageISOCode')</label>
		<input id="codeIso" class="form-control" name="codeIso" placeholder="@lang('misc.languageISOCode')" type="text" />
	</div>
	<br>
	<button onclick="addLanguage()" class="btn btn-primary">Ajouter</button>
</div>

<script>
function addDomain() {
	alert("TODO");
}

/**
 * Adds a new subdomain into the database
 */
function addSubdomain() {
	const nameSubdomain = $('#subdomain').val();
	if(nameSubdomain.trim().length > 0) {
		xhr("post", `{{ route('addSubdomains', '') }}/${nameSubdomain}`)
		.then(() => {
			$("#statusSuccess").fadeIn();
			$("#subdomain").val("");
			setTimeout(() => {
				$("#statusSuccess").fadeOut();
			}, 3000);
		})
		.catch(() => {
			$("#statusError").fadeIn();
			$("#subdomain").val("");
			setTimeout(() => {
				$("#statusError").fadeOut();
			}, 3000);
		});
	}
}

function addLanguage() {
	let nameLanguage = $('#language').val();
	let codeIso = $("#codeIso").val();
	xhr("GET", "/api/addlanguage/" + nameLanguage + "/code/" + codeIso)
	.then((result) => {
		alertBt(JSON.parse(result));
		$("#language").val("");
		$("#codeIso").val("");
	})
	.catch();
}

function alertBt(parseJson) {
	if (parseJson['error'] != undefined) {
		$("#infosStatus").removeClass("alert-success");
		$("#infosStatus").addClass("alert-danger");
		$("#infosStatus").text(parseJson['error']);
	} else if (parseJson['success'] != undefined) {
		$("#infosStatus").removeClass("alert-danger");
		$("#infosStatus").addClass("alert-success");
		$("#infosStatus").text(parseJson['success']);
	}
	$("#infosStatus").fadeIn();
	setTimeout(function(){ $("#infosStatus").fadeOut(); }, 3000);
}
</script>
@endsection
