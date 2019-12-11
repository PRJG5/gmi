@extends('layouts.app')
@section('content')
    <div class="container table-responsive">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align:center">
            <thead>
                <tr>
                    <th class="th-sm">@lang('users.name')</th>
                    <th class="th-sm">@lang('users.email')</th>
                    <th class="th-sm">@lang('users.role')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->role == \App\Enums\Roles::ADMIN)<tr class="table-danger">
                    @elseif($user->role == \App\Enums\Roles::MOD)<tr class="table-warning">
                    @elseif($user->role == \App\Enums\Roles::USERS)<tr class="table-success">
                    @else<tr>
                    @endif
                        <td><strong>{{$user->name}}</strong></td>
                        <td>{{$user->email}}</td>
                        <td>
                            <select id="authors" class="form-control" name="author" required="" onchange="updateRole({{$user->id}}, this)">
                                @foreach(\App\Enums\Roles::getValues() as $role)
                                    <option value="{{$role}}" @if($user->role == $role) selected @endif>{{\App\Enums\Roles::getDescription($role)}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function updateRole(userId,event) {
            $.ajax({
                url: '{{ route('admin.updateRole') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                data: {
                    userId: userId,
                    role: event.value,
                },
                success: function (data) {
                    if (data.status == "SUCCESS") {
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.type,
                            text: data.message,
                        })
                    }
                },
                error: function () {
                    alert('failure');
                }
            });
        }
    </script>
    <script src="{{ asset('js/data.js') }}" ></script>
@endsection
