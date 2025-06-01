<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('subzona', function (Blueprint $table) {
            $table->integer('camera_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('subzona', function (Blueprint $table) {
            $table->dropColumn('camera_id'); 
        });
    }

};
