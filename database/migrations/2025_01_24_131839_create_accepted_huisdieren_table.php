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
        Schema::create('accepted_huisdieren', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('huisdier_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('huisdier_id')->references('id')->on('huisdieren')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accepted_huisdieren');
    }
};