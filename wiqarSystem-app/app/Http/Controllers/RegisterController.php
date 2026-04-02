<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\table;

class RegisterController extends Controller
{
    public function store (Request $request){
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:8|confirmed',
            'role_id'     => 'required|integer|exists:roles,id',
            'business_id' => 'required|integer|exists:businesses,id',
            'branch_id'   => 'required|integer|exists:branches,id',
        ]);
        User::create([
            ...$validated,
            'password' => bcrypt($validated['password']),
        ]);
    }
}
