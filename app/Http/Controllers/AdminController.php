<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Patikrinkite, ar vartotojas yra administratorius
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'administrator') {
            $users = User::with('role')->get();
            return view('admin.index', compact('users'));
        }

        // Jei vartotojas nėra administratorius, peradresuokite arba grąžinkite klaidą
        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function updateRole(Request $request, User $user)
    {
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'administrator') {
            $request->validate([
                'role_id' => 'required|exists:roles,id',
            ]);

            $user->role_id = $request->role_id;
            $user->save();

            return redirect()->back()->with('success', 'User role updated successfully.');
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }

    // Metodas, skirtas redaguoti vartotoją
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Metodas, skirtas atnaujinti vartotojo duomenis
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Vartotojo duomenys sėkmingai atnaujinti.');
    }
}
