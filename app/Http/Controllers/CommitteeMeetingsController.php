<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeMeetingsController extends Controller
{
    public function index(Committee $committee)
    {
        $meetings = $committee->meetings()
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('committees.meetings.index', compact('committee', 'meetings'));
    }
}
