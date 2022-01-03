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
        Schema::create('geodetic_information', function (Blueprint $table) {
            $table->foreignId('dump_id')->constrained();
            $table->foreignId('cadastral_municipalities_id')->nullable()->constrained();
            $table->string('portion')->nullable();
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
        Schema::dropIfExists('geodetic_information');
    }
};
