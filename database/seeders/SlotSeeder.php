<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subzonaIds = DB::table('subzona')->pluck('id');

        $slots = [];

        foreach ($subzonaIds as $subzonaId) {
            for ($i = 1; $i <= 5; $i++) {
                $slots[] = [
                    'subzona_id' => $subzonaId,
                    'nomor_slot' => $i,
                    'keterangan' => 'Tersedia',
                    'x1' => rand(0, 500),
                    'y1' => rand(0, 500),
                    'x2' => rand(501, 1000),
                    'y2' => rand(0, 500),
                    'x3' => rand(501, 1000),
                    'y3' => rand(501, 1000),
                    'x4' => rand(0, 500),
                    'y4' => rand(501, 1000),
                ];
            }
        }
        DB::table('slot')->insert($slots);
    }
}
