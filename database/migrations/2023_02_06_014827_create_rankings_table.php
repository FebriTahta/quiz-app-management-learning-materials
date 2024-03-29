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
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('ranking_jenis')->nullable();
            $table->string('ranking_nilai')->nullable();
            $table->string('ranking_rank')->nullable();
            $table->timestamps();

             // indexing
             $table->index('ranking_nilai', 'ranking_nilai_name_index');
             $table->index('id', 'ranking_nilai_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
};
