<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatedTrashVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimated_trash_volumes', function (Blueprint $table) {
            $table->id('dump_id');
            $table->unsignedSmallInteger('organic_waste')->default(0);
            $table->unsignedSmallInteger('construction_waste')->default(0);
            $table->unsignedSmallInteger('municipal_waste')->default(0);
            $table->unsignedSmallInteger('bulk_waste')->default(0); // kosovni odpadki
            $table->unsignedSmallInteger('hazardous_waste')->default(0);
            $table->unsignedSmallInteger('tires')->default(0);
            $table->unsignedSmallInteger('vehicles')->default(0);
            $table->unsignedSmallInteger('asbestos_plates')->default(0);
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
        Schema::dropIfExists('estimated_trash_volumes');
    }
}
