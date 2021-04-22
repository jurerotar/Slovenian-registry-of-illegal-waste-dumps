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
        Schema::create('locations', function (Blueprint $table) {
            $table->foreignId('dump_id')->constrained();
            $table->double('wgs84_longitude');
            $table->double('wgs84_latitude');
            $table->string('portion')->nullable();
            $table->unsignedSmallInteger('cadastral_id')->nullable();
            $table->foreignId('municipality_id')->constrained();
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
        Schema::dropIfExists('locations');
    }
};
