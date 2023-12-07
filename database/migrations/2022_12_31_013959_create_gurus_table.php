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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('guru_nip');
            $table->string('guru_name');
            $table->string('guru_slug');
            $table->string('photo')->nullable();
            $table->longText('quote')->nullable();
            $table->string('guru_status')->nullable();
            $table->timestamps();

            // indexing
            $table->index('guru_name', 'guru_name_index');
            $table->index('guru_slug', 'guru_slug_index');
            $table->index('id', 'guru_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
