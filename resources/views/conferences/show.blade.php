@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $conference->title }}</h1>
        <p>{{ $conference->description }}</p>
        <p>Pradžia: {{ $conference->start_time }}</p>
        <p>Pabaiga: {{ $conference->end_time }}</p>

        @if($conference->end_time < now())
            <div class="alert alert-danger">Konferencija jau pasibaigusi.</div>
        @else
            @if ($registrations->contains('user_id', auth()->id()))
                <div class="alert alert-success">Jūs jau užsiregistravote į šią konferenciją.</div>
            @else
                <form action="{{ route('conferences.register', $conference) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Registruotis</button>
                </form>
            @endif
        @endif
        @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrinimas, ar vartotojas yra administratorius -->
        <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti šią konferenciją?');">Ištrinti</button>
        </form>
        <h3>Registracijų sąrašas:</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
        @if(auth()->check() && auth()->user()->role->id == 2) <!-- Patikrinimas, ar vartotojas yra administratorius -->
        <h3>Registracijų sąrašas:</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
    </div>
@endsection
