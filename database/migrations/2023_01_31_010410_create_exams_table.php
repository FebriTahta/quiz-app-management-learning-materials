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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->string('exam_name')->nullable();
            $table->string('exam_jenis')->nullable();
            $table->string('exam_lamapengerjaan')->nullable(); // sekian menit
            $table->string('exam_datetimestart')->nullable(); // start dari pukul sekian
            $table->string('exam_datetimeend')->nullable(); // start dari pukul sekian
            $table->string('exam_status')->nullable();
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
        Schema::dropIfExists('exams');
    }
};
