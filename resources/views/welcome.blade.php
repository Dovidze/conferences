@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Student Information -->
        <div class="student-info mb-4">
            <h5>{{ __('student_information') }}</h5>
            <p><strong>{{ __('name') }}:</strong> Dovydas</p>
            <p><strong>{{ __('surname') }}:</strong> Andrulis</p>
            <p><strong>{{ __('group') }}:</strong> PIT-21-I-NT</p>
        </div>

        <div class="card mb-2 bg-gray-green-low">
            <div class="card-header text-center fs-4">{{ __('conferences_active') }}</div>
        </div>
        @if($upcomingConferences->isEmpty())
            <div class="alert alert-warning">{{ __('a_no_active_conferences') }}</div>
        @else
            <div class="row gx-2">
                @foreach ($upcomingConferences as $conference)
                    <div class="col-md-6 mb-2 ">
                        @if (auth()->check() && $registrations && $registrations->contains('conference_id', $conference->id))
                            <div class="card h-100 border-success custom-shadow">
                        @else
                            <div class="card h-100">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $conference->title }}
                                @php
                                    $daysLeft = ceil(\Carbon\Carbon::now()->floatDiffInDays(\Carbon\Carbon::parse($conference->start_time), false));
                                @endphp
                                    <span class="text-success">({{ __('left') }} {{ $daysLeft }} {{ __('d.') }})</span>
                            </h5>
                            <p class="card-text text-truncate" style="max-width: 100%;">{{ $conference->description }}</p>

                            <div class="d-flex justify-content-between">
                                <p class="card-text"><strong>{{__('start_time')}}:</strong> {{ date('Y-m-d H:i', strtotime($conference->start_time)) }}</p>
                                <p class="card-text"><strong>{{__('end_time')}}:</strong> {{ date('Y-m-d H:i', strtotime($conference->end_time)) }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="card-text"><strong>{{__('created')}}:</strong> {{ $conference->date }}</p>
                                <p class="card-text mx-auto"><strong>{{__('registered_users')}}:</strong> {{ $conference->registrations_count }}</p>
                                <p class="card-text"><strong>{{__('organizer')}}:</strong> {{ $conference->user->name }}</p>
                            </div>

                            <div class="d-flex align-items-center">
                                <a href="{{ route('conferences.show', $conference->id) }}" class="btn btn-info me-2">{{ __('show') }}</a>
                                @if (auth()->check() && $registrations && $registrations->contains('conference_id', $conference->id))
                                    <p class="mb-0 text-success fw-bold">{{ __('you_are_registered') }}</p> <!-- Čia galite keisti tekstą, jei reikia -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

