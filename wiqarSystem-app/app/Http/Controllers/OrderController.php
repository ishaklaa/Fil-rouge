<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if (!$activity->is_available || $activity->quantity < $order['qty']) {
                $errors[] = $activity->title . " is not available";
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'message' => 'order has not been created',
                'errors'  => $errors
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
            'user_id'  => $user->id,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'total'    => $total,
        ]);

        foreach ($orders as $order) {
            $cashierOrder->activities()->attach($order['id'], ['quantity' => $order['qty']]);
        }

        return response()->json([
            'message' => 'order has been created',
            'orderId' => $cashierOrder->id
        ]);
    }
    public function cashierOrders(){
        $user = Auth::user();
        $orders = $user->orders()->get() ?? collect();
        return view('ordersHistory',compact('orders'));
    }


}
