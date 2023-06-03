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
        Schema::create('examurais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->string('examurai_name')->nullable();
            $table->string('examurai_jenis')->nullable();
            $table->string('examurai_lamapengerjaan')->nullable();
            $table->string('examurai_datetimestart')->nullable();
            $table->string('examurai_datetimeend')->nullable();
            $table->string('examurai_status')->nullable();
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
        Schema::dropIfExists('examurais');
    }
};

