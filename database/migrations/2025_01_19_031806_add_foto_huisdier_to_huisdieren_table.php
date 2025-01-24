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
        Schema::table('huisdieren', function (Blueprint $table) {
            if (!Schema::hasColumn('huisdieren', 'foto_huisdier')) {
                $table->string('foto_huisdier')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('huisdieren', function (Blueprint $table) {
            $table->dropColumn('foto_huisdier');
        });
    }
};