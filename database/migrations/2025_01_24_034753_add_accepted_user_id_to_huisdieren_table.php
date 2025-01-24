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
            $table->unsignedBigInteger('accepted_user_id')->nullable()->after('user_id');
            $table->foreign('accepted_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('huisdieren', function (Blueprint $table) {
            $table->dropForeign(['accepted_user_id']);
            $table->dropColumn('accepted_user_id');
        });
    }
};
