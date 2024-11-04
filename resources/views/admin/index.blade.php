@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('user_management') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($users->isEmpty())
            <div class="alert alert-warning text-center my-4">
                {{ __('a_no_users') }}
            </div>
        @else
            <div class="table-responsive my-4">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('name') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('role') }}</th>
                        <th scope="col">{{ __('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ? $user->role->name : '' }}</td>
                            <td>
                                <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" class="d-inline-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <select name="role_id" class="form-select" required>
                                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Guest</option>
                                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Employee</option>
                                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Administrator</option>
                                        </select>
                                        <button type="button" id="update-role-{{ $user->id }}" class="btn btn-success ms-2" onclick="confirmRoleChange(event, {{ $user->role_id }}, this.form);">{{ __('update_role') }}</button>
                                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning ms-2">{{ __('edit') }}</a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function confirmRoleChange(event, currentRoleId, form) {
            const selectElement = form.querySelector('select[name="role_id"]');
            const newRoleId = selectElement.value;

            if (currentRoleId == '3' && newRoleId != '3') {
                event.preventDefault();

                Swal.fire({
                    text: '{{ __('are_you_sure_to_change_role') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('yes') }}',
                    cancelButtonText: '{{ __('cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Rodyti sėkmingą pranešimą
                        Swal.fire({
                            title: '{{ __('a_success_role_update') }}',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            form.submit();
                        });
                    }
                });
            } else {
                // If it is not administrator, just send that form without asking to confirm
                Swal.fire({
                    icon: 'success',
                    title: '{{ __('a_success_role_update') }}',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    form.submit();
                });
            }
        }
    </script>
@endsection
