@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sukurti konferenciją</h1>

        <form action="{{ route('conferences.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Pavadinimas</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Aprašymas</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Pradžios laikas</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">Pabaigos laikas</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
            </div>
            <button type="submit" class="btn btn-primary">Sukurti konferenciją</button>
        </form>
    </div>
@endsection
