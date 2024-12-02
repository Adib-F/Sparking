<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('identitas')->unique();
            $table->string('email')->unique();
            $table->string('nomor_telepon', 16)->unique();
            $table->enum('jenis_pengguna', ['mahasiswa' , 'dosen' , 'karyawan' , 'tamu']);
            $table->string('nama');
            $table->string('password');
            $table->enum('jenis_kendaraan', ['mobil' , 'motor']);
            $table->string('no_plat')->unique();
            $table->string('foto_kendaraan');
            $table->string('foto_pengguna');
            $table->string('qr_code')->nullable();
            $table->enum('role', ['admin', 'pengguna'])->default('pengguna');
            $table->enum('status', ['aktif', 'nonAktif', 'ditolak'])->default('nonAktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
