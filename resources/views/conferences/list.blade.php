@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->check() && (auth()->user()->role->id == 3))
            <a href="{{ route('conferences.create') }}" class="btn btn-success mb-3 w-100">{{__('conference_create')}}</a>
        @endif
        <div class="card mb-2 bg-gray-green-low">
            <div class="card-header text-center fs-4">{{ __('conferences_active') }}</div>
        </div>
        @if($upcomingConferences->isEmpty())
            <div class="alert alert-warning">{{ __('a_no_active_conferences') }}</div>
        @else
            <div class="row">
                @foreach ($upcomingConferences as $conference)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header fs-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $conference->title }}</div>
                            <div class="card-body">
                                <p class="description">{{ $conference->description }}</p>
                                <p><strong>{{ __('start_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                <p><strong>{{ __('end_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                <p><strong>{{ __('organizer') }}:</strong> {{ $conference->user->name }}</p>

                                <div class="d-flex">
                                    <a href="{{ route('conferences.show', $conference) }}" class="btn btn-info me-2">{{ __('show') }}</a>
                                    <a href="{{ route('conferences.edit', $conference) }}" class="btn btn-warning me-2">{{ __('edit') }}</a>

                                 @if(auth()->check() && auth()->user()->role->id == 3) {{-- Only administrator can delete --}}
                                    <form id="deleteForm" action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-button me-2">{{ __('delete') }}</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="card mb-2 bg-gray-red-low">
            <div class="card-header text-center fs-4">{{ __('conferences_ended') }}</div>
        </div>
        @if($pastConferences->isEmpty())
            <div class="alert alert-warning">{{ __('a_no_ended_conferences') }}</div>
        @else
            <div class="row">
                @foreach ($pastConferences as $conference)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header fs-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $conference->title }}</div>
                            <div class="card-body">
                                <p class="description">{{ $conference->description }}</p>
                                <p><strong>{{ __('start_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                <p><strong>{{ __('end_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                <p><strong>{{ __('organizer') }}:</strong> {{ $conference->user->name }}</p>

                                <div class="d-flex">
                                    <a href="{{ route('conferences.show', $conference) }}" class="btn btn-info me-2">{{ __('show') }}</a>
                                    @if(auth()->check() && auth()->user()->role->id == 3)  {{-- Only administrator can delete --}}
                                    <form id="deleteForm" action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-button me-2">{{ __('delete') }}</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
