@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('user_edit') }}:</h1>
        <h1>{{ $user->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{ __('name') }}:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">{{ __('email') }}:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('save') }}</button>
        </form>
    </div>
@endsection
