<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteesController extends Controller
{
    public function index()
    {
        $committees = Committee::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('committees.index', compact('committees'));
    }

    public function show(Committee $committee)
    {
        return view('committees.show', compact('committee'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
        Committee::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    
        return redirect()->route('committees.index')->with('success', 'Committee created successfully');
        
        
    }
} 