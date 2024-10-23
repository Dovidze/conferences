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
                        <p><strong>{{__('start_time')}}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                        <p><strong>{{__('end_time')}}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                        <p><strong>{{__('organizer')}}:</strong> {{ $conference->user->name }}</p>

                        @if($conference->end_time < now())
                            <div class="alert alert-danger">{{__('a_conference_ended')}}</div>
                        @else
                            @if ($registrations->contains('user_id', auth()->id()))
                                <div class="alert alert-success">{{__('a_conference_user_already_registered')}}</div>
                            @else
                                <form action="{{ route('conferences.register', $conference) }}" method="POST" class="mb-3">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">{{__('register')}}</button>
                                </form>
                            @endif

                            @if(auth()->check() && auth()->user()->role->id == 3) <!-- Patikrinimas, ar vartotojas yra administratorius -->
                            <div class="d-flex mb-2">
                                <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2" onclick="return confirm('{{__('a_conference_confirm_delete')}}');">{{__('delete')}}</button>
                                </form>
                                <a href="{{ route('conferences.edit', $conference) }}" class="btn btn-warning">{{__('edit')}}</a>
                            </div>

                            @endif
                    </div>
                </div>
            </div>
        </div>
        <h3>{{__('registered_users')}}: {{ $registrationsCount }}</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif

        @if(auth()->check() && auth()->user()->role->id == 2) <!-- Patikrinimas, ar vartotojas yra administratorius -->
                        <h3>{{__('registered_users')}}: {{ $registrationsCount }}</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
    </div>

@endsection
