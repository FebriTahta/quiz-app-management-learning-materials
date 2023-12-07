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
        Schema::create('nilai_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();

            // indexing
            $table->index('id', 'nilaiexam_index');
            $table->index('nilai', 'nilaiexam_nilai_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_exams');
    }
};
