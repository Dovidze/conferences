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
                <label for="name" class="form-label">{{ __('name') }}:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Enter your name" required>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="email" class="form-label">{{ __('email') }}:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">{{ __('save') }}</button>
        </form>
    </div>
@endsection
