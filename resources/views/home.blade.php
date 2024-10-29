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

                    <h5 class="card-title mb-3">{{ __('role') }}: <strong>{{ auth()->user()->role->name }}</strong></h5>

                    <div class="mb-3">
                        @if(auth()->check() && auth()->user()->role->id == 3) <!-- Administrator -->
                        <h6 class="text-primary mb-2">{{ __('Admin Options') }}</h6>
                        <a class="btn btn-outline-primary me-2" href="{{ route('admin.index') }}">{{ __('user_management') }}</a>
                        <a class="btn btn-outline-primary me-2" href="{{ route('conferences.list') }}">{{ __('conference_management') }}</a>
                        @endif

                        @if(auth()->check() && auth()->user()->role->id == 2) <!-- Employee -->
                        <h6 class="text-secondary">{{ __('Employee Options') }}</h6>
                        <a class="btn btn-outline-secondary me-2" href="{{ route('conferences.index') }}">{{ __('conferences') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
