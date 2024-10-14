@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Planuojamos konferencijos</h2>
        @if($upcomingConferences->isEmpty())
            <div class="alert alert-warning">Planuojamų konferencijų nėra.</div>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Aprašymas</th>
                    <th>Pradžia</th>
                    <th>Pabaiga</th>
                    <th>Sukūrimo data</th>
                    <th>Kūrėjas</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>
                <tbody>
                @foreach($upcomingConferences as $conference)
                    <tr>
                        <td>{{ $conference->title }}</td>
                        <td class="text-truncate" style="max-width: 500px;">{{ $conference->description }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</td>
                        <td>{{ $conference->date }}</td>
                        <td>{{ $conference->user->name }}</td>
                        <td>
                            <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info">Peržiūrėti</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if(auth()->check() && (auth()->user()->role->id == 2 || auth()->user()->role->id == 3))
            <h2>Pasibaigusios konferencijos</h2>
            @if($pastConferences->isEmpty())
                <div class="alert alert-warning">Pasibaigusių konferencijų nėra.</div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Aprašymas</th>
                        <th>Pradžia</th>
                        <th>Pabaiga</th>
                        <th>Sukūrimo data</th>
                        <th>Kūrėjas</th>
                        <th>Veiksmai</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pastConferences as $conference)
                        <tr>
                            <td>{{ $conference->title }}</td>
                            <td class="text-truncate" style="max-width: 500px;">{{ $conference->description }}</td>
                            <td>{{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</td>
                            <td>{{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</td>
                            <td>{{ $conference->date }}</td>
                            <td>{{ $conference->user->name }}</td>
                            <td>
                                <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info">Peržiūrėti</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection
