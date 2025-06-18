<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogParkir;
use App\Models\SubZona;
use Carbon\Carbon;

class ApiLogParkirController extends Controller
{
    // Mencatat kendaraan masuk (waktu_mulai)
    public function masuk(Request $request)
    {
        $request->validate([
            'subzona_id' => 'required|exists:subzona,id',
            'nomor_slot' => 'required|integer',
            'waktu_mulai' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $subzona = SubZona::find($request->subzona_id);

        $log = LogParkir::create([
            'zona_id' => $subzona->zona_id,
            'subzona_id' => $request->subzona_id,
            'nomor_slot' => $request->nomor_slot,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => null,
            'durasi' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Log parkir masuk dicatat',
            'data' => $log,
        ]);
    }

    // Mencatat kendaraan keluar (waktu_selesai dan durasi)
    public function keluar(Request $request)
    {
        $request->validate([
            'subzona_id' => 'required|exists:subzona,id',
            'nomor_slot' => 'required|integer',
            'waktu_selesai' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Cari log terakhir yang belum selesai
        $log = LogParkir::where('subzona_id', $request->subzona_id)
            ->where('nomor_slot', $request->nomor_slot)
            ->whereNull('waktu_selesai')
            ->orderBy('waktu_mulai', 'desc')
            ->first();

        if (!$log) {
            return response()->json([
                'status' => 'error',
                'message' => 'Log parkir tidak ditemukan',
            ], 404);
        }

        $waktuSelesai = Carbon::parse($request->waktu_selesai);
        $waktuMulai = Carbon::parse($log->waktu_mulai);
        $durasi = $waktuMulai->diffInSeconds($waktuSelesai);

        $log->update([
            'waktu_selesai' => $waktuSelesai,
            'durasi' => $durasi,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Log parkir keluar dicatat',
            'data' => $log,
        ]);
    }
}
