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
        Schema::create('consultinfo', function (Blueprint $table) {
            $table->integer('consultation_id')->unsigned();
            $table->foreign('consultation_id')->references('id')->on('consultation')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('injury_id')->unsigned();
            $table->foreign('injury_id')->references('id')->on('injuries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultinfo');
    }
};
