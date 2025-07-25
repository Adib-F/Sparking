<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Models\SubZona;
use App\Models\Zona;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ApiRealtimeController extends Controller
{

    public function getAllSubzonas()
{
    $subzonas = SubZona::select('id', 'nama_subzona', 'camera_id')
        ->whereNotNull('camera_id')
        ->get();

    return response()->json($subzonas);
}




    /**
     * Polling card zona di component informasi ringkas real time
     */
    public function getZonaslot()
    {
        $zonas = Zona::with('subzonas.slots')->get();

        $data = $zonas->map(function ($zona) {
            $allSlots = $zona->subzonas->flatMap(function ($subzona) {
                return $subzona->slots;
            });

            $available = $allSlots->where('keterangan', 'Tersedia')->count();
            $total = $allSlots->count(); // total semua slot tanpa filter

            return [
                'id' => $zona->id,
                'nama_zona' => $zona->nama_zona,
                'tersedia' => $available,
                'total' => $total,
            ];
        });

        return response()->json($data);
    }



    /**
     * Dropdown select subzona berdasarkan zona_id
     */
    public function getSubzonas($zonaId)
    {
        $subzonas = SubZona::where('zona_id', $zonaId)->get();
        return response()->json($subzonas);
    }

    /**
     * Mendapatkan detail subzona untuk card detail
     */
    public function getSubzonaDetails($subzonaId)
    {
        $subzona = SubZona::with(['slots' => function($query) {
            $query->orderBy('nomor_slot');
        }])->findOrFail($subzonaId);

        // Hitung statistik slot
        $slotStats = [
            'total'      => $subzona->slots->count(),
            'tersedia'   => $subzona->slots->where('keterangan', 'Tersedia')->count(),
            'terisi'     => $subzona->slots->where('keterangan', 'Terisi')->count(),
            'perbaikan'  => $subzona->slots->where('keterangan', 'Perbaikan')->count(),
        ];

        // Format response
        return response()->json([
            'nama_subzona' => $subzona->nama_subzona,
            'foto'         => $subzona->foto ? asset('storage/' . $subzona->foto) : asset('images/default-subzona.jpg'),
            'camera_id'    => $subzona->camera_id,
            'slots'        => $subzona->slots->map(function($slot) {
                return [
                    'id'          => $slot->id,
                    'nomor_slot'  => $slot->nomor_slot,
                    'keterangan'  => $slot->keterangan,
                    'area'        => [
                        'x1' => $slot->x1,
                        'y1' => $slot->y1,
                        'x2' => $slot->x2,
                        'y2' => $slot->y2,
                        'x3' => $slot->x3,
                        'y3' => $slot->y3,
                        'x4' => $slot->x4,
                        'y4' => $slot->y4,
                    ]
                ];
            }),
            'slotStats' => $slotStats
        ]);
    }

    /**
     * Mendapatkan zona berdasarkan subzona_id
     */
    public function getZonaBySubzona($id)
    {
        try {
            $subzona = SubZona::with('zona')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id'           => $subzona->id,
                    'nama_subzona' => $subzona->nama_subzona,
                    'zona_id'      => $subzona->zona->id,
                    'nama_zona'    => $subzona->zona->nama_zona,
                    'camera_id'    => $subzona->camera_id
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update status slot (Terisi atau Tersedia)
     */
    public function updateSlotStatus(Request $request)
    {
        $request->validate([
            'subzona_id'  => 'required|integer|exists:subzona,id',
            'nomor_slot'  => 'required|integer',
            'keterangan'  => 'required|in:Terisi,Tersedia',
        ]);

        $slot = Slot::where('subzona_id', $request->subzona_id)
                    ->where('nomor_slot', $request->nomor_slot)
                    ->first();

        if ($slot) {
            $slot->keterangan = $request->keterangan;
            $slot->save();

            return response()->json(['message' => 'Status updated'], 200);
        }

        return response()->json(['message' => 'Slot not found'], 404);
    }

    /**
     * Mendapatkan camera_id berdasarkan subzona
     */
    public function getCameraIdBySubzona($subzonaId)
    {
        $subzona = SubZona::find($subzonaId);

        if ($subzona && $subzona->camera_id !== null) {
            return response()->json(['camera_id' => $subzona->camera_id]);
        }

        return response()->json(['error' => 'Camera ID not found'], 404);
    }

    public function getCamera($id)
{
    $subzona = SubZona::find($id);

    if (!$subzona) {
        return response()->json(['error' => 'Subzona tidak ditemukan'], 404);
    }

    return response()->json([
        'camera_id' => $subzona->camera_id
    ]);
}
}
