<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin-dashboard', [
            'user' => Auth::user(),
            'totalUsers' => User::count(),
            'totalBranches' => Branch::count(),
            'totalActivities' => Activity::count(),
            'ordersToday' => Order::whereDate('created_at', today())->count(),
            'recentUsers' => User::with('role')->latest()->take(5)->get(),
        ]);
    }
}
