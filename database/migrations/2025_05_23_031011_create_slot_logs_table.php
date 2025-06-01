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
        Schema::create('slot_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained('slot')->onDelete('cascade');
            $table->enum('status', ['kosong', 'terisi']);
            $table->timestamp('waktu'); 
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_logs');
    }
};
