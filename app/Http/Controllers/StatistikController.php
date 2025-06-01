<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $zonas = Zona::all();
        return view ('statistik', [
            'title' => "statistik",
            'zonas' => $zonas
        ]);
    }
}
