<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LogParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiStatistikController extends Controller
{
    public function getStatistik(Request $request)
    {
        $zonaId = $request->input('zona_id');

        $data = LogParkir::where('zona_id', $zonaId)
            ->whereNotNull('waktu_selesai')
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'total' => 0,
                'avg_per_day' => 0,
                'hari_terpadat' => '-',
                'chart' => [
                    'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    'data' => [0, 0, 0, 0, 0, 0, 0]
                ]
            ]);
        }

        $total = $data->count();

        $avg = $data->groupBy(function($item) {
            return Carbon::parse($item->waktu_mulai)->format('Y-m-d');
        })->map->count()->avg();

        $hariMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        $perHari = $data->groupBy(function($item) {
            return Carbon::parse($item->waktu_mulai)->format('l');
        })->map->count();

        $hariPuncak = $perHari->sortDesc()->keys()->first();

        $orderedLabels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $orderedData = [];

        foreach ($orderedLabels as $hari) {
            $englishDay = array_search($hari, $hariMap);
            $orderedData[] = $perHari[$englishDay] ?? 0;
        }

        return response()->json([
            'total' => $total,
            'avg_per_day' => round($avg, 1),
            'hari_terpadat' => $hariMap[$hariPuncak] ?? '-',
            'chart' => [
                'labels' => $orderedLabels,
                'data' => $orderedData
            ]
        ]);
    }

}
