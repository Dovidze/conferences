<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function index()
    {
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'administrator') {
            $users = User::with('role')->get();
            return view('admin.index', compact('users'));
        }

       return redirect('/home')->with('error', __('a_no_permission'));
    }

    public function updateRole(Request $request, User $user)
    {
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'administrator') {
            $request->validate([
                'role_id' => 'required|exists:roles,id',
            ]);

            $user->role_id = $request->role_id;
            $user->save();

            return redirect()->back()->with('success', __('a_success_role_update'));
        }

        return redirect('/home')->with('error', __('a_no_permission'));
    }

    public function editUser($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

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

        return redirect()->route('admin.index')->with('success',__('a_success_user_update'));
    }
}
