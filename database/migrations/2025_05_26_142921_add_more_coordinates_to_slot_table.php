<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->integer('x3')->default(0)->after('y2');
            $table->integer('y3')->default(0)->after('x3');
            $table->integer('x4')->default(0)->after('y3');
            $table->integer('y4')->default(0)->after('x4');
        });
    }

    public function down()
    {
        Schema::table('slot', function (Blueprint $table) {
            $table->dropColumn(['x3', 'y3', 'x4', 'y4']);
        });
    }
};
