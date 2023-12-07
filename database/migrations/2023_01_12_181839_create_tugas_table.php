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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapelmaster_id')->nullable();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('uploader_nip')->nullable();
            $table->longText('tugas_name')->nullable();
            $table->longText('tugas_desc')->nullable();
            $table->timestamps();

            // indexing
            $table->index('tugas_name', 'tugas_name_index');
            $table->index('id', 'tugas_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
};
