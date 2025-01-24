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
        if (!DB::table('roles')->where('name', 'admin')->exists()) {
            DB::table('roles')->insert([
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }


    public function down()
    {
        DB::table('roles')->where('name', 'admin')->delete();
    }
};
