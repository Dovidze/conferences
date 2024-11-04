@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('conference_edit')}}: </h1>
        <h1>{{ $conference->title }}</h1>

        <form action="{{ route('conferences.update', $conference) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">{{__('title')}}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $conference->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{__('description')}}</label>
                <textarea class="form-control" id="description" name="description" required>{{ $conference->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">{{__('start_time')}}</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" onkeydown="return false;" value="{{ date('Y-m-d H:i', strtotime($conference->start_time)) }}" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">{{__('end_time')}}</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" onkeydown="return false;" value="{{ date('Y-m-d H:i', strtotime($conference->end_time)) }}" required>
                @if ($errors->has('end_time'))
                    <div class="alert alert-warning">{{ $errors->first('end_time') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{__('save')}}</button>
        </form>
    </div>
@endsection
