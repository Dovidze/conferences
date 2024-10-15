@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->check() && (auth()->user()->role->id == 3))
            <a href="{{ route('conferences.create') }}" class="btn btn-success mb-3 w-100">Sukurti naują konferenciją</a>
        @endif
        <div class="card mb-2 bg-opacity-50">
            <div class="card-header text-center fs-4 ">Planuojamos konferencijos</div>
        </div>
        @if($upcomingConferences->isEmpty())
            <div class="alert alert-warning">Planuojamų konferencijų nėra.</div>
        @else
                <div class="row gx-2">
                    @foreach ($upcomingConferences as $conference)
                        <div class="col-md-6 mb-2 ">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $conference->title }}</h5>
                                    <p class="card-text text-truncate" style="max-width: 100%;">{{ $conference->description }}</p>

                                    <!-- Pradžios ir pabaigos laikas vienoje eilutėje -->
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text"><strong>Pradžia:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                        <p class="card-text"><strong>Pabaiga:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                    </div>

                                    <!-- Sukūrimo data ir organizatorius kitoje eilutėje -->
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text"><strong>Data:</strong> {{ $conference->date }}</p>
                                        <p class="card-text mx-auto"><strong>Užsiregistravę:</strong> {{ $conference->registrations_count }}</p>
                                        <p class="card-text"><strong>Organizatorius:</strong> {{ $conference->user->name }}</p>
                                    </div>

                                    <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info">Peržiūrėti</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        @endif
            @if(auth()->check() && (auth()->user()->role->id == 2 || auth()->user()->role->id == 3))
                <div class="card mb-2 bg-gray-red-low">
                    <div class="card-header text-center fs-4">Pasibaigusios konferencijos</div>
                </div>
                @if($pastConferences->isEmpty())
                    <div class="alert alert-warning">Pasibaigusių konferencijų nėra.</div>
                @else
                    <div class="row gx-2">
                        @foreach ($pastConferences as $conference)
                            <div class="col-md-6 mb-2 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $conference->title }}</h5>
                                        <p class="card-text text-truncate" style="max-width: 100%;">{{ $conference->description }}</p>

                                        <!-- Pradžios ir pabaigos laikas vienoje eilutėje -->
                                        <div class="d-flex justify-content-between">
                                            <p class="card-text"><strong>Pradžia:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                            <p class="card-text"><strong>Pabaiga:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                                        </div>

                                        <!-- Sukūrimo data ir organizatorius kitoje eilutėje -->
                                        <div class="d-flex justify-content-between">
                                            <p class="card-text"><strong>Data:</strong> {{ $conference->date }}</p>
                                            <p class="card-text mx-auto"><strong>Užsiregistravę:</strong> {{ $conference->registrations_count }}</p>
                                            <p class="card-text"><strong>Organizatorius:</strong> {{ $conference->user->name }}</p>
                                        </div>

                                        <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info">Peržiūrėti</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    @endsection
