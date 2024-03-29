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
        if(!Schema::hasColumn('prompts', 'properties')) {
            Schema::table('prompts', function (Blueprint $table) {
                $table->json('properties')->after('key')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->dropColumn('properties');
        });
    }
};
