@extends('layouts.app')
@section('content')
	<h1>@lang('cards.addDomainsSubdomainsLanguages')</h1>

	<div style="display:none;" class="alert" role="alert" id="infosStatus"></div>

	<div>
		<div class="form-group">
			<label for="domain">@lang('cards.domain')</label>
			<input id="domain" class="form-control" name="language" placeholder="@lang('cards.domainsName')" type="text">
		</div>
		<button onclick="addDomain()" class="btn btn-primary">@lang('cards.addDomain')</button>
	</div>

	<hr>

	<div>
		<div class="form-group">
			<label for="subdomain">@lang('cards.subdomain')</label>
			<input id="subdomain" class="form-control" name="subdomain" placeholder="@lang('cards.subdomainsName')" type="text">
		</div>
		<button onclick="addSubdomain()" class="btn btn-primary">@lang('cards.addSubdomain')</button>
	</div>

	<hr>

	<div>
		<form class="form-group">
			<label for="language">@lang('cards.language')</label>
			<input id="language" class="form-control" name="language" placeholder="@lang('cards.languagesName')" type="text">
			<input id="codeIso" class="form-control" name="codeIso" placeholder="@lang('cards.languagesISOCode')" type="text">
			<input type="radio" name="issigned" value="1" id="rbIsSigned" checked>
			<label for="rbIsSigned">@lang('cards.is_signed')</label><br>
			<input type="radio" name="issigned" value="0" id="rbIsNotSigned">
			<label for="rbIsNotSigned">@lang('cards.is_not_signed')</label><br>
			<button onclick="addLanguage()" class="btn btn-primary">@lang('cards.addLanguage')</button>
		</form>
	</div>

	<script>
		function alertBt(parseJson) {
			if (parseJson['error'] !== undefined) {
					$("#infosStatus").removeClass("alert-success");
					$("#infosStatus").addClass("alert-danger");
					$("#infosStatus").text(parseJson['error']);
				} else if (parseJson['success'] !== undefined) {
					$("#infosStatus").removeClass("alert-danger");
					$("#infosStatus").addClass("alert-success");
					$("#infosStatus").text(parseJson['success']);
				}
				$("#infosStatus").fadeIn();
				setTimeout(function(){ $("#infosStatus").fadeOut(); }, 3000);
		}

		function addSubdomain() {
			const xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					alertBt(JSON.parse(this.responseText));
					$("#subdomain").val("");
				}
			};
            const nameSubdomain = $('#subdomain').val();
			xhttp.open("GET", "/api/addsubdomain/" + nameSubdomain, true);
			xhttp.send();
		}

		function addLanguage() {
            const xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					alertBt(JSON.parse(this.responseText));
					$("#language").val("");
					$("#codeIso").val("");
				}
			};
            const nameLanguage = $('#language').val();
            const codeIso = $("#codeIso").val();
			const isSigned = $("#rbIsSigned").prop('checked');
			xhttp.open("GET", "/api/addlanguage/" + nameLanguage + "/code/" + codeIso + "/issigned/" + isSigned, true);
			xhttp.send();
		}

		function addDomain() {
            const xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					alertBt(JSON.parse(this.responseText));
					$("#domain").val("");
				}
			};
            const domain = $('#domain').val();
			xhttp.open("GET", "/api/adddomain/" + domain, true);
			xhttp.send();
		}
	</script>
@endsection
