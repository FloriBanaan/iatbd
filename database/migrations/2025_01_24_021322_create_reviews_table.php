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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eigenaar_id'); 
            $table->unsignedBigInteger('oppas_id');   
            $table->text('review');
            $table->timestamps();

            $table->foreign('eigenaar_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('oppas_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
