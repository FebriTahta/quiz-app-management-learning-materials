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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->string('mapel_name');
            $table->string('mapel_slug');
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();

             // indexing
             $table->index('mapel_name', 'mapel_name_index');
             $table->index('id', 'mapel_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapels');
    }
};
