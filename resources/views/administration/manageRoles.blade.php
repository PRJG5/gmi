@extends('layouts.container')

@section('container-title')
	@lang('users.manageRoles')
@endsection

@section('container-body')
	<div class="container">
		<div class="row justify-content-center">
			<table class="table" style="text-align:center">
				<caption>Here are all the users and their role. You can edit their role at any moment.</caption>
				<thead class="thead-dark">
					<tr>
						<th scope="col">@lang('users.name')</th>
						<th scope="col">@lang('users.email')</th>
						<th scope="col">@lang('users.role')</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($users as $user)
					@if($user->role == 0)
						<tr scope="row" class="table-danger">
					@elseif($user->role == 1)
						<tr scope="row" class="table-warning">
					@elseif($user->role == 2)
						<tr scope="row" class="table-success">
					@else
						<tr scope="row" class="">
					@endif
							<th scope="col">{{ $user->name }}</th>
							<td>{{ $user->email }}</td>
							<td>
								<select id="authors" class="form-control" name="author" required=""
										onchange="updateRole({{ $user->id }}, this)">
									@foreach($roles as $role)
										<option value="{{ $role }}"
												@if($user->role == $role) selected @endif>{{ \App\Enums\Roles::getDescription($role) }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						@endforeach
				</tbody>
			</table>
			<div class="modal fade" id="successModel" tabindex="-1" role="dialog" aria-labelledby="successModelLabel"
				 aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="successModelLable">@lang('misc.changesSaved')</h5>
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
			<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
				 aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="errorModalLabel">@lang('misc.error')</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger" role="alert">@lang('misc.error')</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
        function updateRole(userId, select) {
            xhr("POST",
                "{{ route('updateRole') }}",
                {
                    "X-CSRF-TOKEN": getCookie("XSRF-TOKEN"),
                },
                {
                    "_method": "PUT",
                    "_token": getCookie("XSRF-TOKEN"), // who is sending the request
                    "userId": userId, // who to change to role
                    "role": select.value, // what is the new role
                },
            )
                .then((response) => {
					response = JSON.prase(response.responseText);
					if(response.data) {
						switch (select.value) {
							case "0":
								select.parentElement.parentElement.className = "table-danger";
								break;
							case "1":
								select.parentElement.parentElement.className = "table-warning";
								break;
							case "2":
								select.parentElement.parentElement.className = "table-success";
								break;
							default:
								select.parentElement.parentElement.className = "table-default";
						}
						$("#successModel").modal('show');
					} else {
						throw new Error(response.errors[0])
					}
                })
                .catch((err) => {
                    $("#errorModal").modal('show');
                });
        }
	</script>
@endsection
