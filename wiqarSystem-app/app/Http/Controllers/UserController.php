<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users    = User::with(['role', 'branch', 'shifts'])->get();
        $roles    = Role::all();
        $branches = Branch::all();

        return view('profile', compact('users', 'roles', 'branches','user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'role_id'   => 'required|exists:roles,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Profile created successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $id,
            'password'  => 'nullable|string|min:6',
            'role_id'   => 'required|exists:roles,id',
            'branch_id' => 'required|exists:branches,id',

        ]);
        $validated['status'] = $request->input('status');
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }



        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
