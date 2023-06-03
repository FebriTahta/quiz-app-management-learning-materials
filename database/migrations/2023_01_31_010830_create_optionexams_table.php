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
        Schema::create('optionexams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soalexam_id')->nullable();
            $table->longtext('optionexam_name')->nullable();
            $table->string('optionexam_true')->nullable(); // diisi 1 / 0 saja
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
        Schema::dropIfExists('optionexams');
    }
};
