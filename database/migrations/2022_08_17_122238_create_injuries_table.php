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
        Schema::create('injuries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamps();
        });

        DB::table('injuries')->insert([
            ['description' => 'Parvovirus'],
            ['description' => 'Flies/Ticks'],
            ['description' => 'Flu'],
            ['description' => 'Broken Limbs'],
            ['description' => 'Stomach Ache'],
            ['description' => 'Bone Fracture'],
            ['description' => 'Cancer'],
            ['description' => 'Cough'],
            ['description' => 'Rabies'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('injuries');
    }
};
