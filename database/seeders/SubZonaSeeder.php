<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubzonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subzonas = [];

        for ($i = 1; $i <= 2; $i++) {
            $subzonas[] = [
                'zona_id' => 1,
                'nama_subzona' => "1.$i",
                'foto' => "/data_parkir/subzona/1.$i.jpg",
                'camera_id' => null,
            ];
        }

        for ($i = 1; $i <= 5; $i++) {
            $subzonas[] = [
                'zona_id' => 2,
                'nama_subzona' => "2.$i",
                'foto' => "/data_parkir/subzona/2.$i.jpg",
                'camera_id' => null,
            ];
        }

        for ($i = 1; $i <= 10; $i++) {
            $subzonas[] = [
                'zona_id' => 3,
                'nama_subzona' => "3.$i",
                'foto' => "/data_parkir/subzona/3.$i.jpg",
                'camera_id' => null,
            ];
        }

        for ($i = 1; $i <= 4; $i++) {
            $subzonas[] = [
                'zona_id' => 4,
                'nama_subzona' => "4.$i",
                'foto' => "/data_parkir/subzona/4.$i.jpg",
                'camera_id' => null,
            ];
        }

        for ($i = 1; $i <= 4; $i++) {
            $subzonas[] = [
                'zona_id' => 5,
                'nama_subzona' => "5.$i",
                'foto' => "/data_parkir/subzona/5.$i.jpg",
                'camera_id' => null,
            ];
        }

        DB::table('subzona')->insert($subzonas);
    }
}
