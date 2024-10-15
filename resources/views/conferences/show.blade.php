@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="card col-md-6 mb-2">
            <div class="card-header fs-4">{{ $conference->title }}</div>
        </div>
        <div class="row gx-2">
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $conference->description }}</p>
                        <p><strong>Pradžia:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                        <p><strong>Pabaiga:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                        <p><strong>Organizatorius:</strong> {{ $conference->user->name }}</p>

                        @if($conference->end_time < now())
                            <div class="alert alert-danger">Konferencija jau pasibaigusi.</div>
                        @else
                            @if ($registrations->contains('user_id', auth()->id()))
                                <div class="alert alert-success">Jūs jau užsiregistravote į šią konferenciją.</div>
                            @else
                                <form action="{{ route('conferences.register', $conference) }}" method="POST" class="mb-3">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Registruotis</button>
                                </form>
                            @endif

                            @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrinimas, ar vartotojas yra administratorius -->
                            <div class="d-flex mb-2">
                                <!-- Ištrinti mygtukas dešinėje -->
                                <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2" onclick="return confirm('Ar tikrai norite ištrinti šią konferenciją?');">Ištrinti</button>
                                </form>

                                <!-- Redaguoti mygtukas -->
                                <a href="{{ route('conferences.edit', $conference) }}" class="btn btn-warning">Redaguoti</a>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>

                        <h3>Užsiregistravę dalyviai: {{ $registrationsCount }}</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
        @if(auth()->check() && auth()->user()->role->id == 2) <!-- Patikrinimas, ar vartotojas yra administratorius -->
                        <h3>Užsiregistravę dalyviai: {{ $registrationsCount }}</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
    </div>

@endsection
