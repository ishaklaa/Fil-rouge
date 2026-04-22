<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $errors = [];
        $user = Auth::user();
        $discount = $request->discount;
        $orders = $request->orders;
        $subtotal = 0;

        foreach ($orders as $order) {
            $activity = Activity::find($order['id']);
            if (!$activity) {
                $errors[] = "Activity not found";
                continue;
            }
            $qty = filter_var($order['qty'], FILTER_VALIDATE_INT);
            if ($qty === false || $qty <= 0) {
                $errors[] = "Invalid quantity provided.";
            } elseif (!$activity->is_available || $activity->quantity < $qty) {
                $errors[] = $activity->title . " is not available";
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'message' => 'order has not been created',
                'errors' => $errors
            ]);
        }
        foreach ($orders as $order) {
            $activity = Activity::find($order['id']);
            $subtotal += $activity->price * $order['qty'];
            $activity->update([
                'quantity' => $activity->quantity - $order['qty'],
            ]);
        }

        $total = $subtotal - (($subtotal * $discount) / 100);

        $cashierOrder = Order::create([
            'user_id' => $user->id,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);

        foreach ($orders as $order) {
            $cashierOrder->activities()->attach($order['id'], ['quantity' => $order['qty']]);
        }

        return response()->json([
            'message' => 'order has been created',
            'orderId' => $cashierOrder->id
        ]);
    }

    public function cashierOrders()
    {
        $user = Auth::user();

        if (Auth::user()->role_id == 1 ){
            $orders = Order::all();
            return view('ordersHistory', compact('orders'));


        }elseif (Auth::user()->role_id == 2){
            $user = Auth::user();

            $orders = Order::wherehas('user',function ($q) use ($user){
                $q->where('users.branch_id',$user->branch_id);
            })->get();
            return view('ordersHistory', compact('orders'));

        }

        $orders = $user->orders()->get() ?? collect();

        return view('ordersHistory', compact('orders'));
    }

    public function statistics(Request $request)
    {
        $filter = $request->get('filter');
        $user = Auth::user();

        $query = Activity::withWhereHas('orders', function ($q) use ($user) {
            $q->whereHas('user', fn($u) => $u->where('branch_id', $user->branch_id));
        });
        match ($filter) {
            'name' => $query->orderBy('title'),
            'last_day' => $query = Activity::withWhereHas('orders', function ($q) use ($user) {
                $q->where('tasks.created_at', '>=', now()->subDay());
                $q->whereHas('user', fn($u) => $u->where('branch_id', $user->branch_id));
            }),
            'last_week' => $query = Activity::withWhereHas('orders', function ($q) use ($user) {
                $q->where('tasks.created_at', '>=', now()->subWeek());
                $q->whereHas('user', fn($u) => $u->where('branch_id', $user->branch_id));
            }),
            'last_month' => $query = Activity::withWhereHas('orders', function ($q) use ($user) {
                $q->where('tasks.created_at', '>=', now()->subMonth());
                $q->whereHas('user', fn($u) => $u->where('branch_id', $user->branch_id));
            }),
            default => $query->latest(),
        };
        $orderQuery = Order::wherehas('user', function ($q) use ($user) {
            $q->where('branch_id', $user->branch_id);
        });

        return view('statistic', [
            'activities' => $query->get(),
            'totalRevenue' => $orderQuery->sum('total'),
            'totalActivities' => $query->count(),
            'totalOrders' => $orderQuery->count(),
        ]);
    }


}
