@extends('layouts.app')

@section('content')
<div class="container">@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ __('role') }}: {{ auth()->user()->role->name }}
                        @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrina, ar vartotojas yra prisijungęs ir turi administratoriaus rolę -->
                            <a class="nav-link" href="{{ route('admin.index') }}">{{ __('user_management') }}</a>
                            <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                        @endif
                        @if(auth()->check() && auth()->user()->role->id == 2) <!-- Patikrina, ar vartotojas yra prisijungęs ir turi administratoriaus rolę -->
                            <a class="nav-link" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
