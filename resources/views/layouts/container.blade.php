@extends('layouts.app')

@section('container')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">@yield('container-title')</div>
					<div class="card-body">@yield('container-body')</div>
				</div>
			</div>
		</div>
	</div>
@endsection
