<?php

namespace App\Http\Controllers;

use App\Models\SubZona;
use Illuminate\Http\Request;
use App\Models\Slot;

class PublicSlotController extends Controller
{
    public function index(){
        return view('realtime_public', [
            'title' => 'real-time',
        ]);
    }

    public function getData()
{
    $subzone = SubZona::first(); 

    $slots = Slot::where('id_subzona', $subzone->id)->get();

    return response()->json([
        'subzone' => [
            'nama' => $subzone->nama,
            'foto_url' => asset('storage/' . $subzone->foto),
        ],
        'slots' => $slots
    ]);
}
}
