<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\ConferenceRegistration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\UpdateConferenceRequest;
use App\Http\Requests\StoreConferenceRequest;

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

        //Days left
        $upcomingConferences->transform(function ($conference) {
            $now = Carbon::now();
            $startTime = Carbon::parse($conference->start_time);

            $diffInSeconds = $startTime->timestamp - $now->timestamp; // Sec difference
            $daysLeft = $diffInSeconds / (60 * 60 * 24); // Sec transfer to days

            // daysLeft round
            $conference->daysLeft = round($daysLeft);
            //$conference->daysLeft = $daysLeft;

            return $conference;
        });

        //Registrations count
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

    public function store(StoreConferenceRequest $request)
    {

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

        $registrationsCount = $conference->registrations()->count();
        $registrations = $conference->registrations()->with('user')->get();

        return view('conferences.show', compact('conference','registrations','registrationsCount'));
    }

    public function register(Conference $conference)
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
    public function update(UpdateConferenceRequest $request, Conference $conference)
    {

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
