<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::with('users')->get();
        return view('branches',compact('branches'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name',
        ]);
        Branch::create($validated);
        return redirect()->back()->with('success', 'Branch created successfully.');

    }
    public function update(Request $request,$id){
        $branch = Branch::find($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name,' . $id,
        ]);
        $branch->update($validated);
        return redirect()->back();
    }

}
