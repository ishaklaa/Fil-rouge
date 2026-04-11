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
        $user = Auth::user();


        $discount = $request->discount;
        $orders = $request->orders;
        foreach ($orders as $order) {
            $id = $order["id"];
            $qty = $order["qty"];
            $activity = Activity::find($id);
            if (!$activity) {
                $errors[] = "Activity not found";
                continue;
            }
            if (!$activity->is_available || $activity->quantity < $qty) {
                $errors[] = $activity->title . " is not available";
            }
        }
        if (!empty($errors)) {
            return response()->json([
                'message' => 'order has not been created',
                'errors'  => $errors
            ]);
        }
        $cashierOrder = Order::create([
            'user_id'  => $user->id,
            'discount' => $discount,
        ]);
        foreach ($orders as $order) {
            $id  = $order["id"];
            $qty = $order["qty"];
            $cashierOrder->activities()->attach($id, ['quantity' => $qty]);
        }
        return response()->json([
            'message' => 'order has been created'
        ]);
    }


}
