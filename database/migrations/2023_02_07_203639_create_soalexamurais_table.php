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
        Schema::create('soalexamurais', function (Blueprint $table)  {
            $table->id();
            $table->unsignedBigInteger('examurai_id')->nullable();
            $table->longText('soalexam_name')->nullable();
            $table->timestamps();

            // indexing
            $table->index('soalexam_name', 'soalexamurai_name_index');
            $table->index('id', 'soalexamurai_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soalexamurais');
    }
};
