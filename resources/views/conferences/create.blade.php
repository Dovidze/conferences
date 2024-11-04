@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('conference_create')}}</h1>

        <form action="{{ route('conferences.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">{{__('title')}}</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{__('description')}}</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">{{__('start_time')}}</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" onkeydown="return false;" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">{{__('end_time')}}</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" onkeydown="return false;" required>
            </div>
            <button type="submit" class="btn btn-primary">{{__('create')}}</button>
        </form>
    </div>

@endsection
