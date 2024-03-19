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
        if(!Schema::hasColumn('a_i_requests', 'category')) {
            Schema::table('a_i_requests', function (Blueprint $table) {
                $table->string('category')->nullable();
            });
        }

        if(!Schema::hasColumn('a_i_requests', 'image')) {
            Schema::table('a_i_requests', function (Blueprint $table) {
                $table->string('image')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('a_i_requests', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('image');
        });
    }
};
