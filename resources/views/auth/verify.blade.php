@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">@lang('verify.verifyEmail')</div>

				<div class="card-body">
					@if (session('resent'))
						<div class="alert alert-success" role="alert">
							@lang('verify.verificationLinkSent')
						</div>
					@endif

					@lang('verify.checkEmails')
					@lang('verify.ifEmailNotRecieved')
					<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
						@csrf
						<button type="submit" class="btn btn-link p-0 m-0 align-baseline">@lang('verify.clickToRequestVerificationLink')</button>.
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
