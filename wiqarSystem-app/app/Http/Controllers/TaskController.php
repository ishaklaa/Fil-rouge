<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTaks(Request $request){
     $order = Order::find($request->id);
     $discount = $order->discount;
     $activities = $order->activities()->get();
     return response()->json([
         'activities'=> $activities,
         'discount' => $discount

     ]);
    }
}
