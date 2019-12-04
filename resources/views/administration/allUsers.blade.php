@extends('layouts.app')

@section('content')
<div class="container">
	<tr class="row justify-content-center">
		<table class="table" style="text-align:center">
			<thead class="thead-dark">
				<tr>
					<th scope="col">@lang('users.name')</th>
					<th scope="col">@lang('users.email')</th>
					<th scope="col">@lang('users.role')</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					@if($user->role == \App\Enums\Roles::ADMIN)
					<tr scope="row" class="table-danger">
					@elseif($user->role == \App\Enums\Roles::MOD)
					<tr scope="row" class="table-primary">
					@elseif($user->role == \App\Enums\Roles::USERS)
					<tr scope="row" class="table-success">
					@else
					<tr scope="row" class="">
					@endif
						<th>{{ $user->name }}</th>
						<td>{{ $user->email }}</td>
						<td>
							<select id="authors" class="form-control" name="author" required="" onchange="updateRole({{ $user->id }}, this)">
								@foreach(\App\Enums\Roles::getValues() as $role)
									<option value="{{ $role }}" @if($user->role == $role) selected @endif>{{ \App\Enums\Roles::getDescription($role) }}</option>
								@endforeach
							</select>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">@lang('misc.changesSaved')</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">Your Changes have been saved.</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function updateRole(userId, event) {
	xhr("POST",
		"{{ route('updateRole') }}",
		{
			"X-CSRF-TOKEN": getCookie("XSRF-TOKEN"),
		},
		{
			"_method":	"PUT",
			"_token":	getCookie("XSRF-TOKEN"),
			"userId":	userId,
			"role":		event.value,
		},
	)
	.then((response) => {
		switch(event.value) {
			case "0":
				event.parentElement.parentElement.className = "table-danger";
				break;
			case "1":
				event.parentElement.parentElement.className = "table-primary";
				break;
			case "2":
				event.parentElement.parentElement.className = "table-success";
				break;
			default:
				event.parentElement.parentElement.className = "table-default";
		}
		$("#exampleModal").modal('show');
	})
	.catch((err) => {
		alert(err);
	});
}
</script>
@endsection
