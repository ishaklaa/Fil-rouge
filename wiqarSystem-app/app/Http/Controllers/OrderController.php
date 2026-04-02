<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addToOrder($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->first();
        if ($order) {
            $order->activities()->attach($id, ['quantity' => 1]);
        } else {
            $order = Order::create([
                'user_id' => $user->id,
                'discount' => 0,
            ]);
            $order->activities()->attach($id, ['quantity' => 1]);
        }
    }
    public function orderDecrease($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->first();
        if ($order) {
            $existing = $order->activities()->wherePivot('activity_id', $id)->first();
            if ($existing) {
                if ($existing->pivot->quantity > 1) {
                    $order->activities()->updateExistingPivot($id, [
                        'quantity' => $existing->pivot->quantity - 1,
                    ]);
                } else {
                    $order->activities()->detach($id);
                }
            }
        }
        return redirect()->back();
    }

    public function orderIncrease($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->first();
        if ($order) {
            $existing = $order->activities()->wherePivot('activity_id', $id)->first();

            if ($existing) {

                $order->activities()->updateExistingPivot($id, [
                    'quantity' => $existing->pivot->quantity + 1,
                ]);

            }
        }
        return redirect()->back();

    }
    public function removeFromOrder($id){
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->first();
        $order->activities()->detach($id);
        return redirect()->back();

    }
    public function setDiscount(Request $request){
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->first();
        $order->update([
            'discount' =>$request->discount,
        ]);

    }


}
