<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SlotLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function statistikHarian()
    {
        $hariIni = Carbon::today();

        $data = SlotLog::select('status', DB::raw('count(*) as jumlah'))
            ->whereDate('created_at', $hariIni)
            ->groupBy('status')
            ->get();

        return response()->json($data);
    }

    public function mingguan($zona_id)
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $data = DB::table('slot_logs')
            ->join('slot', 'slot_logs.slot_id', '=', 'slot.id')
            ->join('subzona', 'slot.subzona_id', '=', 'subzona.id')
            ->join('zona', 'subzona.zona_id', '=', 'zona.id')
            ->selectRaw('DAYNAME(slot_logs.created_at) as hari, COUNT(*) as jumlah')
            ->where('zona.id', $zona_id)
            ->where('slot_logs.status', 'terisi')
            ->whereBetween('slot_logs.created_at', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DAYNAME(slot_logs.created_at)'))
            ->get();

        $labels = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $labelsIndo = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $countPerDay = array_fill(0, 7, 0);
        $hariMap = array_combine($labels, range(0, 6));

        foreach ($data as $row) {
            $i = $hariMap[$row->hari];
            $countPerDay[$i] = $row->jumlah;
        }

        $total = array_sum($countPerDay);
        $avg = round($total / 7);
        $maxIndex = array_keys($countPerDay, max($countPerDay))[0];
        $peakDay = $labelsIndo[$maxIndex];

        return response()->json([
            'labels' => $labelsIndo,
            'data' => $countPerDay,
            'total' => $total,
            'average' => $avg,
            'peak_day' => $peakDay
        ]);
    }

}
