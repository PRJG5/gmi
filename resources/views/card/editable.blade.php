@extends('card.show', [
	'action' => $action,
	'card' => $card,
	'domain' => $domain,
	'editable' => true,
	'languages' => $languages,
	'subdomain' => $subdomain,
	'owner' => $owner,
])

@section('csrf')
@csrf
@endsection

@section('buttons')
<input type="submit" 	class="buttonLike"	value="Submit"	title="Submit" />
<input type="reset" 	class="buttonLike"	value="Clear"	title="Clear" />
<a href="mailto:{{$user->email}}?subject={{$mail['subject']}}&body={{$mail['description']}}" class="buttonLike">Send mail</a>
@endsection

@section('error_language_id')
	@error('language_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_heading')
	@error('heading')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('error_owner_id')
	@error('owner_id')
		<p class="errorLike">{{ $message }}</p>
	@enderror
@show

@section('edit')
@endsection

@section('delete')
@endsection

@section('owner')
@show
