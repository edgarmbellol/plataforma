<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        // Configuración de las URLs de las herramientas
        $tools = [
            'moodle' => [
                'url' => 'https://moodle.zencode.com.co/', // URL externa de Moodle
                'enabled' => true,
            ],
            'committees' => [
                'url' => route('committees.index'),
                'enabled' => true,
            ]
        ];

        return view('tools.index', compact('tools'));
    }
} 