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
        Schema::create('hari_mapelmaster', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hari_id')->nullable();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->timestamps();

            // indexing
            $table->index('id', 'hari_mapelmaster_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hari_mapelmaster');
    }
};
