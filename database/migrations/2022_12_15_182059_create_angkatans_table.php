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
        Schema::create('angkatans', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('kelas_id')->nullable();
            // $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->string('angkatan_name');
            $table->string('angkatan_status');
            $table->unsignedBigInteger('tingkat_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angkatans');
    }
};
