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

            Schema::table('servers', function (Blueprint $table) {


                $table->enum('status',['active','stopped','terminated','pending','scheduled','expired','inactive','failed','running'])->change();

            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
