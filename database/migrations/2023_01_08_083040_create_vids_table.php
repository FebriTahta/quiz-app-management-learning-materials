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
        Schema::create('vids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->unsignedBigInteger('materi_id')->nullable();
            $table->longText('vids_link')->nullable();
            $table->longText('vids_name')->nullable();
            $table->longText('vids_desc')->nullable();
            $table->timestamps();

            // indexing
            $table->index('vids_name', 'vids_name_index');
            $table->index('id', 'vids_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vids');
    }
};
