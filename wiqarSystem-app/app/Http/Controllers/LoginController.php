<?php

namespace App\Http\Controllers;
use App\Models\Shift;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('loginPage');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if (!Auth::attempt($validated)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }
        $request->session()->regenerate();
        if (Auth::user()->role_id == 3) {
            $user = Auth::user();
            Shift::create([
                'user_id' => $user->id,
            ]);
            return redirect()->route('cashier.dashboard');
        }
        elseif (Auth::user()->role_id == 1 ||Auth::user()->role_id == 2){
            return redirect()->route('admin.dashboard');
        }
        return redirect('/');
    }

    public function logout()
    {
        if (Auth::user()->role_id == 3) {

            $shift = Auth::user()->shifts()->latest()->first();
            if ($shift) {
                $shift->update(['ends_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')]);
            }
        }
        Auth::logout();
        return redirect()->route('login.show');

    }
}
