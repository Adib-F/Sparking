<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;

class ApiSlotController extends Controller
{
     public function updateSlotStatus(Request $request)
    {
        $data = $request->validate([
            'subzona_id' => 'required|integer',
            'slots' => 'required|array',
            'slots.*.nomor_slot' => 'required|integer',
            'slots.*.keterangan' => 'required|in:Tersedia,Terisi,Perbaikan',
        ]);

        foreach ($data['slots'] as $slotData) {
            Slot::where('subzona_id', $data['subzona_id'])
                ->where('nomor_slot', $slotData['nomor_slot'])
                ->update(['keterangan' => $slotData['keterangan']]);
        }

        return response()->json(['message' => 'Slot status updated successfully'], 200);
    }
}
