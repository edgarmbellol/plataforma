<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        # Mostrar la vista dashboard
        return view('dashboard');
    }
}
