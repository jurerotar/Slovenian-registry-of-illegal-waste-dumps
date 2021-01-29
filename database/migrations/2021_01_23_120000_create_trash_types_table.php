<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trash_types', function (Blueprint $table) {
            $table->foreignId('dump_id')->constrained();
            // Percentage values
            $table->unsignedTinyInteger('organic_waste')->default(0);
            $table->unsignedTinyInteger('construction_waste')->default(0);
            $table->unsignedTinyInteger('municipal_waste')->default(0);
            $table->unsignedTinyInteger('bulk_waste')->default(0); // kosovni odpadki
            $table->unsignedTinyInteger('hazardous_waste')->default(0);
            $table->unsignedTinyInteger('tires')->default(0);
            $table->unsignedTinyInteger('vehicles')->default(0);
            $table->unsignedTinyInteger('asbestos_plates')->default(0);
            // Actual amount of hazardous liquid barrels
            $table->unsignedMediumInteger('hazardous_liquids')->default(0);
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
        Schema::dropIfExists('trash_types');
    }
}
