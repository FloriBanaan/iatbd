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
            $table->string('naam_dier');
            $table->string('soort_dier');
            $table->date('begindatum_oppassen');
            $table->date('einddatum_oppassen');
            $table->decimal('uurtarief', 8, 2);
            $table->text('belangrijke_zaken')->nullable();
            $table->string('foto_huisdier')->nullable();
            
            if (!Schema::hasColumn('huisdieren', 'user_id')) {
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('huisdieren', function (Blueprint $table) {
            $table->dropColumn(['naam_dier', 'soort_dier', 'begindatum_oppassen', 'einddatum_oppassen', 'uurtarief', 'belangrijke_zaken', 'foto_huisdier']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};