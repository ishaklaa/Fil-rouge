<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show (){
        return view('loginPage');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (!Auth::attempt($validated)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }
        if (Auth::user()->role_id == 3){
            return view('cashierDashboard');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
