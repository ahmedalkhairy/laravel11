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
        if(Schema::hasColumn('a_i_requests', 'server_id')) {
            Schema::table('a_i_requests', function (Blueprint $table) {
                $table->dropForeign(['server_id']);
                $table->dropColumn('server_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('a_i_requests', function (Blueprint $table) {
            //
        });
    }
};
