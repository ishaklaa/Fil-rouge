<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index(){
        $activities = Activity::all() ?? collect();
        return response()->json([
            'activities'=>$activities
        ]);


    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'is_available' => 'required|boolean',
            'quantity' => 'required|integer',
        ]);
        Activity::created($validated);
    }
    public function update(Request $request ,$id)
    {
        $activity = Activity::where('id',$id)->first();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'is_available' => 'required|boolean',
        ]);
        $activity->update($validated);

    }
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
    }

}
