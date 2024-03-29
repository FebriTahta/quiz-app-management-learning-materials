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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('angkatan_id')->nullable();
            $table->string('siswa_nik');
            $table->string('siswa_name');
            $table->string('siswa_slug');
            $table->string('siswa_status');
            $table->timestamps();

            // indexing
            $table->index('siswa_name', 'siswa_name_index');
            $table->index('siswa_slug', 'siswa_slug_index');
            $table->index('id', 'siswa_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
