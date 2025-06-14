<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zona')->insert([
            [
                'nama_zona' => 'Zona A',
                'keterangan' => 'Zona ini berada di dekat RTF',
                'fotozona' => '/data_parkir/zona/Zona1.png',
            ],
            [
                'nama_zona' => 'Zona B',
                'keterangan' => 'Zona ini berada di dekat GU',
                'fotozona' => '/data_parkir/zona/Zona2.png',
            ],
            [
                'nama_zona' => 'Zona C',
                'keterangan' => 'Zona ini berada di dekat Tekno',
                'fotozona' => '/data_parkir/zona/Zona3.png',
            ],
            [
                'nama_zona' => 'Zona D',
                'keterangan' => 'Zona ini berada di dekat TA',
                'fotozona' => '/data_parkir/zona/Zona4.png',
            ],
            [
                'nama_zona' => 'Zona E',
                'keterangan' => 'Zona ini berada di dekat TA',
                'fotozona' => '/data_parkir/zona/Zona5.png',
            ],
        ]);
    }
}
