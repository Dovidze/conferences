@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Vartotojų valdymas</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($users->isEmpty())
            <div class="alert alert-warning">Vartotojų nėra.</div>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Vardas</th>
                    <th>El. paštas</th>
                    <th>Rolė</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role ? $user->role->name : 'Nėra' }}</td>
                        <td>
                            <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <select name="role_id" required>
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Guest</option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Employee</option>
                                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Administrator</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Atnaujinti rolę</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
