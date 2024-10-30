<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\ConferenceRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConferenceController extends Controller
{
    public function index()
    {
        list($upcomingConferences, $pastConferences) = $this->getConferences();

        return view('conferences.index', compact('upcomingConferences', 'pastConferences'));

    }
    public function welcome()
    {
        list($upcomingConferences, $pastConferences) = $this->getConferences();

        $registrations = auth()->check() ? auth()->user()->registrations : collect();

        return view('welcome', compact('upcomingConferences', 'registrations', 'pastConferences'));
    }
    public function list()
    {
        list($upcomingConferences, $pastConferences) = $this->getConferences();

        return view('conferences.list', compact('upcomingConferences', 'pastConferences'));// Grą
    }
    private function getConferences()
    {
        $upcomingConferences = Conference::where('start_time', '>', now())
            ->with('user')
            ->withCount('registrations')
            ->get()
            ->sortBy(function ($conference) {
                return Carbon::now()->diffInDays(Carbon::parse($conference->start_time), false);
            });

        $pastConferences = Conference::where('end_time', '<', now())
            ->with('user')
            ->withCount('registrations')
            ->get();

        return [$upcomingConferences, $pastConferences];
    }
    public function create()
    {
        return view('conferences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|after_or_equal:today',
            'end_time' => 'required|date|after:start_time',
        ]);


        Conference::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => now()->format('Y-m-d'),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('conferences.list')->with('success', __('a_conference_created'));
    }

    public function show(Conference $conference)
    {
        // Gauti registruotų asmenų skaičių
        $registrationsCount = $conference->registrations()->count();
        $registrations = $conference->registrations()->with('user')->get();

        return view('conferences.show', compact('conference','registrations','registrationsCount'));
    }

    public function register(Request $request, Conference $conference)
    {
        // if conference is ended
        if ($conference->end_time < now()) {
            return redirect()->route('conferences.show', $conference)->with('error', __('a_conference_ended_cant_reg'));
        }

        $existingRegistration = ConferenceRegistration::where('conference_id', $conference->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRegistration) {
            return redirect()->route('conferences.show', $conference)->with('error', __('a_user_already_registered'));
        }


        ConferenceRegistration::create([
            'conference_id' => $conference->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('conferences.show', $conference)->with('success',__('a_user_registered_successfully'));
    }
    public function unregister(Conference $conference)
    {
        $registration = $conference->registrations()->where('user_id', auth()->id())->first();

        if ($registration) {
            $registration->delete();
            return redirect()->back()->with('success', __('You have successfully unregistered from the conference.'));
        }

        return redirect()->back()->with('error', __('You are not registered for this conference.'));
    }

    public function edit(Conference $conference)
    {
        return view('conferences.edit', compact('conference'));
    }
    public function update(Request $request, Conference $conference)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $conference->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('conferences.list')->with('success', __('a_conference_updated_successfully'));
    }
    public function destroy(Conference $conference)
    {


        // delete conf
        $conference->delete();

        return redirect()->route('conferences.list')->with('success', __('a_conference_deleted_successfully'));
    }

}
