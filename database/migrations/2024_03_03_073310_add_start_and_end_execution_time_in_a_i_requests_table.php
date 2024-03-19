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
        if(!Schema::hasColumns('a_i_requests', ['start_execution_time', 'end_execution_time'])) {
            Schema::table('a_i_requests', function (Blueprint $table) {
                $table->after('category', function ($table) {
                    $table->dateTime('start_execution_time')->nullable();
                    $table->dateTime('end_execution_time')->nullable();
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('a_i_requests', function (Blueprint $table) {
            $table->dropColumn(['start_execution_time', 'end_execution_time']);
        });
    }
};
