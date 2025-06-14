<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\LogParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        // Set lokal bahasa Indonesia untuk nama hari, dll
        Carbon::setLocale('id');

        // Ambil semua data zona
        $zonas = Zona::all();

        // Tentukan awal dan akhir minggu ini
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();

        // Ambil data log parkir minggu ini yang memiliki waktu_mulai dan durasi
        $dataParkir = LogParkir::whereBetween('waktu_mulai', [$awalMinggu, $akhirMinggu])
            ->whereNotNull('waktu_mulai')
            ->whereNotNull('durasi')
            ->get();

        // Inisialisasi slot jam 4-jam dari jam 05:00 sampai 24:00
        $slotJam = [];
        for ($jam = 5; $jam < 24; $jam += 4) {
            $jamMulai = sprintf('%02d:00', $jam);
            $jamAkhir = sprintf('%02d:00', min($jam + 4, 24));
            $slotJam["$jamMulai - $jamAkhir"] = 0;
        }

        // Inisialisasi nama hari dan data awal
        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $jumlahPerHari = array_fill_keys($daftarHari, 0);
        $jumlahPerSlotPerHari = [];

        foreach ($daftarHari as $hari) {
            foreach ($slotJam as $slot => $jumlah) {
                $jumlahPerSlotPerHari[$hari][$slot] = 0;
            }
        }

        // Hitung jumlah kendaraan untuk setiap hari dan slot jam
        foreach ($dataParkir as $log) {
            $waktuMulai = Carbon::parse($log->waktu_mulai);
            $hari = $waktuMulai->isoFormat('dddd'); // Nama hari
            $jam = (int) $waktuMulai->format('H');   // Jam (dalam angka)

            // Tambahkan ke jumlah kendaraan per hari
            if (isset($jumlahPerHari[$hari])) {
                $jumlahPerHari[$hari]++;
            }

            // Tambahkan ke slot jam yang sesuai
            foreach ($slotJam as $range => $jumlah) {
                [$mulai, $akhir] = explode(' - ', $range);
                $jamMulai = (int) explode(':', $mulai)[0];
                $jamAkhir = (int) explode(':', $akhir)[0];

                if ($jam >= $jamMulai && $jam < $jamAkhir) {
                    $slotJam[$range]++;
                    $jumlahPerSlotPerHari[$hari][$range]++;
                    break;
                }
            }
        }

        // Cari slot jam paling sibuk
        $jamTersibuk = collect($slotJam)->sortDesc()->keys()->first();

        // Cari hari tersibuk (bisa lebih dari 1 jika jumlahnya sama)
        $maksJumlahHari = max($jumlahPerHari);
        $hariTersibuk = collect($jumlahPerHari)
            ->filter(fn($jumlah) => $jumlah == $maksJumlahHari)
            ->keys()
            ->all();

        // Hitung total parkir pada hari tersibuk
        $totalParkirHariTersibuk = $dataParkir->filter(function ($log) use ($hariTersibuk) {
            $hari = Carbon::parse($log->waktu_mulai)->isoFormat('dddd');
            return in_array($hari, $hariTersibuk);
        })->count();

        // Hitung rata-rata durasi parkir
        $rataRataDurasiDetik = round($dataParkir->avg('durasi')); // dalam detik
        $jam = floor($rataRataDurasiDetik / 3600);
        $menit = floor(($rataRataDurasiDetik % 3600) / 60);
        $durasiFormat = sprintf('%02d jam %02d menit', $jam, $menit);

        // Kirim data ke view
        return view('statistik', [
            'title' => "Statistik",
            'zonas' => $zonas,
            'jamSibuk' => $jumlahPerSlotPerHari,
            'jamTersibuk' => $jamTersibuk,
            'hariTersibuk' => $hariTersibuk,
            'totalParkirHariTersibuk' => $totalParkirHariTersibuk,
            'durasiFormat' => $durasiFormat,
        ]);
    }
}
