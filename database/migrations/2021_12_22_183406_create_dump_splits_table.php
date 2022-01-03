<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDumpSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dump_splits', function (Blueprint $table) {
            $table->foreignId('dump_id')->constrained('dumps');
            $table->unsignedTinyInteger('organic_waste');
            $table->unsignedTinyInteger('construction_waste');
            $table->unsignedTinyInteger('municipal_waste');
            $table->unsignedTinyInteger('bulk_waste');
            $table->unsignedTinyInteger('hazardous_waste');
            $table->unsignedTinyInteger('tires');
            $table->unsignedTinyInteger('vehicles');
            $table->unsignedTinyInteger('asbestos_plates');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('dump_splits');
    }
}
