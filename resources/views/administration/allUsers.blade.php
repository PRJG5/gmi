@extends('layouts.app')

@section('content')
<div class="container">
	<tr class="row justify-content-center">
		<table class="table" style="text-align:center">
			<thead class="thead-dark">
				<tr>
					<th scope="col">@lang('users.name')</th>
					<th scope="col">@lang('user.email')</th>
					<th scope="col">@lang('users.role')</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					@if($user->role == \App\Enums\Roles::ADMIN)<tr class="table-danger">
					@elseif($user->role == \App\Enums\Roles::MOD)<tr class="table-warning">
					@elseif($user->role == \App\Enums\Roles::USERS)<tr class="table-success">
					@else
					<tr>
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
	</div>
</div>
<script>
	function updateRole(userId, event) {
		console.log(userId, event.value);
		let status = "OK";
		if(status == "OK") {
			alert("@lang('users.roleUpdated')");
			location.reload();
		}
	}
</script>
@endsection
