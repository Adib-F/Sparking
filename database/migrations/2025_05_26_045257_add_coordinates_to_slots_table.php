<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->integer('x1')->default(0)->after('keterangan');
            $table->integer('y1')->default(0)->after('x1');
            $table->integer('x2')->default(0)->after('y1');
            $table->integer('y2')->default(0)->after('x2');
        });
    }

    public function down()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->dropColumn(['x1', 'y1', 'x2', 'y2']);
        });
    }
};
