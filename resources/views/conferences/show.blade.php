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

                                <form id="unregistrationForm" action="{{ route('conferences.unregister', $conference) }}" method="POST" class="mb-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary">{{__('unregister')}}</button>
                                </form>
                            @else
                                @auth
                                    @if(auth()->check() && (auth()->user()->role->id != 3))
                                        <form id="registrationForm" action="{{ route('conferences.register', $conference) }}" method="POST" class="mb-3">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">{{__('register')}}</button>
                                        </form>
                                    @endif
                                @else
                                    <div class="alert alert-warning">{{__('login_required')}}</div>
                                @endauth
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->check() && (auth()->user()->role->id == 2 || auth()->user()->role->id == 3))
        <h3>{{__('registered_users')}}: {{ $registrationsCount }}</h3>
        <ul>
            @foreach ($registrations as $registration)
                <li>{{ $registration->user->name }}</li>
            @endforeach
        </ul>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Registration Alert
            document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __('success') }} !',
                    text: '{{ __('a_you_have_registered') }} !',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    setTimeout(() => {
                        e.target.submit();
                    }, 100);
                });
            });

            // Unregistration Alert
            document.getElementById('unregistrationForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __('success') }} !',
                    text: '{{ __('a_you_have_unregistered') }} !',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    setTimeout(() => {
                        e.target.submit();
                    }, 100);
                });
            });
        });
    </script>
@endsection
