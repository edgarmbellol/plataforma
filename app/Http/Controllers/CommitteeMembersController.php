<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeMembersController extends Controller
{
    public function index(Committee $committee)
    {
        $members = $committee->members()
            ->with('user')
            ->orderBy('role')
            ->paginate(10);

        return view('committees.members.index', compact('committee', 'members'));
    }
}
