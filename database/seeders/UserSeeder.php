<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
        DB::table('pengguna')->insert([
            'identitas' => Str::random(8),
            'email' => Str::random(6) . $i . '@adib.com',
            'jenis_pengguna' => 'mahasiswa',
            'nama' => Str::random(10),
            'password' => Hash::make('password'),
            'jenis_kendaraan' => 'mobil',
            'no_plat' => 'BP '. rand(100, 9999) .' KL',
            'foto_kendaraan' => '/images/mobil.png',
            'foto_pengguna' => '/images/pp.jpeg',
            'role' => 'pengguna',
            'status' => 'aktif',
            'onboarding_step' => 0,
            'onboarding_completed' => 1,
        ]);
         }
    }
}
