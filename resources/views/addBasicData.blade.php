@extends('layouts.card')

@section('card-header')
@lang('misc.addBasicData')
@endsection
@section('card-body')
<div style="display:none;" class="alert alert-success" role="alert" id="statusSuccess">@lang('misc.saved')</div>
<div style="display:none;" class="alert alert-danger" role="alert" id="statusError">@lang('misc.error')</div>
<div class="form-group">
	<label for="subdomain">@lang('card.subdomain')</label>
	<input name="subdomain" id="subdomain" class="form-control" placeholder="@lang('misc.subdomainName')" type="text" />
</div>
<button onclick="addSubdomain()" class="btn btn-primary">@lang('misc.addSubdomain')</button>
@endsection

<script>
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
</script>
