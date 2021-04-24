<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('area');
            $table->string('slug')->index();
            $table->unsignedMediumInteger('population');
            $table->unsignedSmallInteger('population_per_area');
            $table->unsignedTinyInteger('villages');
            $table->foreignId('state_inspectorate_id')->constrained();
            $table->foreignId('intermunicipality_inspectorate_id')->nullable()->constrained();
            $table->foreignId('region_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
};
