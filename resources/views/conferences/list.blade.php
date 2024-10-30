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
                                <p style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $conference->description }}
                                </p>
                                <p><strong>{{ __('start_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                <p><strong>{{ __('end_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                <p><strong>{{ __('organizer') }}:</strong> {{ $conference->user->name }}</p>

                                <div class="d-flex">
                                    <a href="{{ route('conferences.show', $conference) }}" class="btn btn-info me-2">{{ __('show') }}</a>
                                    <a href="{{ route('conferences.edit', $conference) }}" class="btn btn-warning me-2">{{ __('edit') }}</a>

                                    @if(auth()->check() && auth()->user()->role->id == 3) <!-- Administratorius -->
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
                            <div class="card-header fs-5">{{ $conference->title }}</div>
                            <div class="card-body">
                                <p>{{ $conference->description }}</p>
                                <p><strong>{{ __('start_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                <p><strong>{{ __('end_time') }}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                <p><strong>{{ __('organizer') }}:</strong> {{ $conference->user->name }}</p>

                                <div class="d-flex">
                                    <a href="{{ route('conferences.show', $conference) }}" class="btn btn-info me-2">{{ __('show') }}</a>
                                    @if(auth()->check() && auth()->user()->role->id == 3) <!-- Administratorius -->
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

@section('scripts')
    <script>
        // Delete/destroy conf Alert
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                // Raskite artimiausią formą
                const form = this.closest('form');

                Swal.fire({
                    title: '{{ __('a_conference_confirm_delete') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('yes_delete') }}',
                    cancelButtonText: '{{ __('cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Pranešimas apie sėkmingą ištrinimą
                        Swal.fire({
                            title: '{{ __('a_conference_deleted_successfully') }}', // Jūsų pranešimo antraštė
                            icon: 'success',
                            timer: 2000, // Paslėpti po 2 sekundžių
                            showConfirmButton: false
                        }).then(() => {
                                form.submit();
                        });
                    }
                });
            });
        });
    </script>
@endsection
