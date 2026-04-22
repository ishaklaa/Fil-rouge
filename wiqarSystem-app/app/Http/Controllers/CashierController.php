<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activities = Activity::all() ?? collect();
            return view('cashierDashboard', compact('activities','user'));
        }

}
