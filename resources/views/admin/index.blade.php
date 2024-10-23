@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('user_management') }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($users->isEmpty())
            <div class="alert alert-warning">{{ __('a_no_users') }}</div>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('name') }}</th>
                    <th>{{ __('email') }}</th>
                    <th>{{ __('role') }}</th>
                    <th>{{ __('actions') }}</th>
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
                            <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <select name="role_id" required>
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Guest</option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Employee</option>
                                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Administrator</option>
                                </select>
                                <button type="submit" class="btn btn-primary">{{ __('update_role') }}</button>
                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-sm btn-warning">{{ __('edit') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
