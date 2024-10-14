@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Konferencijos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrinimas, ar vartotojas yra administratorius -->
        <a href="{{ route('conferences.create') }}" class="btn btn-primary">Sukurti naują konferenciją</a>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Aprašymas</th>
                <th>Pradžios laikas</th>
                <th>Pabaigos laikas</th>
                <th>Sukūrimo data</th>
                <th>Sukūrė</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td class="text-truncate" style="max-width: 500px;">{{ $conference->description }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</td>
                    <td>{{ $conference->date }}</td> <!-- Rodyti sukūrimo datą -->
                    <td>{{ $conference->user->name }}</td>
                    <td>
                        <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info">Peržiūrėti</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
