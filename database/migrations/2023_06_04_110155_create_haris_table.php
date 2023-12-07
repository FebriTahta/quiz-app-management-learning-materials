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
        Schema::create('haris', function (Blueprint $table) {
            $table->id();
            $table->string('hari_ind')->nullable();
            $table->string('hari_eng')->nullable();
            $table->timestamps();

              // indexing
              $table->index('hari_ind', 'hari_ind_index');
              $table->index('id', 'hari_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haris');
    }
};
