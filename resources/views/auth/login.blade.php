@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">@lang('auth.login')</div>
				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						
						@csrf

						<div class="form-group row">
							<label for="email" class="col-md-3 col-form-label">@lang('users.email')</label>
							<input name="email" type="email" class="col-md-8 form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-3 col-form-label">@lang('auth.password')</label>
							<input name="password" type="password" class="col-md-8 form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
							@error('password')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							@enderror
						</div>

						<div class="form-group row">
							<div class="form-check">
								<input name="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
								<label for="remember" class="form-check-label">@lang('auth.rememberMe')</label>
							</div>
						</div>

						<div class="form-group row">
							<button type="submit" class="btn btn-primary">@lang('auth.login')</button>
							@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">@lang('auth.passwordForgotten')</a>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
