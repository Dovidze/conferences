@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Redaguoti konferenciją: {{ $conference->title }}</h1>

        <form action="{{ route('conferences.update', $conference) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Pavadinimas</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $conference->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Aprašymas</label>
                <textarea class="form-control" id="description" name="description" required>{{ $conference->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Pradžios laikas</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ date('Y-m-d H:i', strtotime($conference->start_time)) }}" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">Pabaigos laikas</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ date('Y-m-d H:i', strtotime($conference->end_time)) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Išsaugoti pokyčius</button>
        </form>
    </div>
@endsection
