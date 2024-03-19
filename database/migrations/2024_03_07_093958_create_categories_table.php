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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('spi_id');
            $table->boolean('is_active')->default(true);
            $table->string('sip_url')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('active_prompt')->nullable();
            $table->json('attributes')->nullable();
            $table->json('active_attributes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
