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
        Schema::create('tingkats', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat_name');
            $table->timestamps();

            // indexing
            $table->index('tingkat_name', 'tingkat_name_index');
            $table->index('id', 'tingkat_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tingkats');
    }
};
