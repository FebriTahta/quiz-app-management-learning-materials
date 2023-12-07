<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soalmultis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id')->nullable();
            $table->longText('soal_kode')->nullable(); // unique untuk edit waktu import ulang soal
            $table->longText('soal_name')->nullable();
            $table->timestamps();

            // indexing
            $table->index('soal_name', 'soal_name_index');
            $table->index('id', 'soal_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soalmultis');
    }
};
