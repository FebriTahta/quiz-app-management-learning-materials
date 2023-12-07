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
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('uploader_nip')->nullable();
            $table->longText('materi_name')->nullable();
            $table->longText('materi_slug')->nullable();
            $table->timestamps();

            // indexing
            $table->index('materi_name', 'materi_name_index');
            $table->index('materi_slug', 'materi_slug_index');
            $table->index('id', 'materi_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materis');
    }
};
