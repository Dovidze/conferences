<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\ConferenceRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::with('user')->get();
        return view('conferences.index', compact('conferences'));
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
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);


        Conference::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => now()->format('Y-m-d'), // Nustatome dabartinę datą
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('conferences.index')->with('success', 'Konferencija sukurta!'); // Patikrinkite, ar šis metodas pasiekiamas
    }

    public function show(Conference $conference)
    {
        $registrations = $conference->registrations()->with('user')->get();
        return view('conferences.show', compact('conference', 'registrations'));
    }

    public function register(Request $request, Conference $conference)
    {
        // Patikrinkite, ar konferencija yra pasibaigusi
        if ($conference->end_time < now()) {
            return redirect()->route('conferences.show', $conference)->with('error', 'Konferencija jau pasibaigusi, negalite registruotis.');
        }

        $existingRegistration = ConferenceRegistration::where('conference_id', $conference->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRegistration) {
            return redirect()->route('conferences.show', $conference)->with('error', 'Jūs jau esate užsiregistravę į šią konferenciją.');
        }

        ConferenceRegistration::create([
            'conference_id' => $conference->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('conferences.show', $conference)->with('success', 'Sėkmingai užsiregistravote!');
    }
    public function destroy(Conference $conference)
    {
        $conference->delete();
        return redirect()->route('conferences.index')->with('success', 'Konferencija sėkmingai ištrinta!');
    }
}
