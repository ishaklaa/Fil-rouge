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
    public function show(){
        $activities = Activity::all() ?? collect();
        return view('activity',compact('activities'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:activities,title',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'is_available' => 'boolean',
        ]);

        $validated['is_available'] = $request->has('is_available');

        Activity::create($validated);

        return redirect()->back()->with('success', 'Activity created successfully.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:activities,title,' . $id,
            'description'  => 'nullable|string|max:1000',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'is_available' => 'boolean',
        ]);

        $validated['is_available'] = $request->has('is_available');

        $activity = Activity::findOrFail($id);
        $activity->update($validated);

        return redirect()->back()->with('success', 'Activity updated successfully.');
    }
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return redirect()->back();
    }

}
