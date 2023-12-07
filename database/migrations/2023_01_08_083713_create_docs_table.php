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
        Schema::create('docs', function (Blueprint $table) { 
            $table->id();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->unsignedBigInteger('materi_id')->nullable();
            $table->longText('docs_file')->nullable();
            $table->longText('docs_name')->nullable();
            $table->longText('docs_desc')->nullable();
            $table->timestamps();

            // indexing
            $table->index('docs_name', 'docs_name_index');
            $table->index('id', 'docs_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docs');
    }
};
