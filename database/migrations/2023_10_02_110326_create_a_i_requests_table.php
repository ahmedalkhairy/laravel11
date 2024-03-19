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
        Schema::create('a_i_requests', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->json('response')->nullable();
            $table->json('request')->nullable();
            $table->enum('status',['success', 'pending','failed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_requests');
    }
};
