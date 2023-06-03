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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->unsignedBigInteger('materi_id')->nullable();
            $table->string('ujian_name')->nullable();
            $table->string('ujian_slug')->nullable();
            $table->string('ujian_jenis')->nullable();
            $table->string('ujian_lamapengerjaan')->nullable(); // sekian menit
            $table->string('ujian_datetimestart')->nullable(); // start dari pukul sekian
            $table->string('ujian_datetimeend')->nullable(); // start dari pukul sekian
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
        Schema::dropIfExists('ujians');
    }
};
