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
        Schema::create('optionmultis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soalmulti_id')->nullable();
            $table->longtext('option_name')->nullable();
            $table->string('option_true')->nullable(); // diisi 1 / 0 saja
            $table->timestamps();

            // indexing
            $table->index('option_name', 'option_name_index');
            $table->index('id', 'option_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('optionmultis');
    }
};
