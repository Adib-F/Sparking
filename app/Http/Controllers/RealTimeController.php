<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\SubZona;
use App\Models\Slot;
use Illuminate\Http\Request;

class RealTimeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua zona dengan subzona dan semua slot
        $zonas = Zona::with(['subzonas.slots'])->get();

        // Tambahkan properti available dan total slot ke setiap zona
        $zonas->each(function ($zona) {
            $zona->total = $zona->subzonas->sum(function ($subzona) {
                return $subzona->slots->count();
            });
            $zona->available = $zona->subzonas->sum(function ($subzona) {
                return $subzona->slots->where('keterangan', 'Tersedia')->count();
            });
        });

        // Ambil zona yang dipilih dari request atau default ke zona pertama
        $selectedZonaId = $request->input('zona'); // Tidak default ke zona pertama
        $selectedZona = $selectedZonaId ? Zona::with(['subzonas.slots'])->find($selectedZonaId) : null;
        $subzonas = $selectedZona ? $selectedZona->subzonas : collect([]);

        // Tambahkan properti total_slots ke setiap subzona
        $subzonas->each(function ($subzona) {
            $subzona->total_slots = $subzona->slots->count();
        });

        // Ambil subzona yang dipilih dari request
        $selectedSubzonaId = $request->input('subzona', null);

        // Hitung slot berdasarkan status untuk subzona yang dipilih
        $slotStats = [
            'total' => 0,
            'tersedia' => 0,
            'terisi' => 0,
            'diperbaiki' => 0,
        ];
        if ($selectedSubzonaId) {
            $slotStats = [
                'total' => Slot::where('subzona_id', $selectedSubzonaId)->count(),
                'tersedia' => Slot::where('subzona_id', $selectedSubzonaId)->where('keterangan', 'Tersedia')->count(),
                'terisi' => Slot::where('subzona_id', $selectedSubzonaId)->where('keterangan', 'Terisi')->count(),
                'diperbaiki' => Slot::where('subzona_id', $selectedSubzonaId)->where('keterangan', 'Perbaikan')->count(),
            ];
        }


        // Hitung total zona, subzona, dan slot untuk status real-time
        $totalZona = $zonas->count();
        $totalSubzona = $zonas->sum(fn($zona) => $zona->subzonas->count());
        $totalSlot = Slot::count();

        return view('realTime', [
            'zonas' => $zonas,
            'selectedZona' => $selectedZona,
            'selectedZonaId' => $selectedZonaId,
            'subzonas' => $subzonas,
            'selectedSubzonaId' => $selectedSubzonaId,
            'slotStats' => $slotStats,
            'totalZona' => $totalZona,
            'totalSubzona' => $totalSubzona,
            'totalSlot' => $totalSlot,
            'title' => 'real-time'
        ]);
    }

}
