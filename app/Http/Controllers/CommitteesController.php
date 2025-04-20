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
} 