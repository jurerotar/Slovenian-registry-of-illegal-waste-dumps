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
        Schema::create('dumps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('cleared')->index();
            $table->smallInteger('distance');
            $table->boolean('has_hazardous_liquids');
            $table->point('coordinates')->spatialIndex();
            $table->foreignId('user_id')->default(1)->constrained('users');
            $table->foreignId('volume_estimate_id')->constrained('volume_estimates');
            $table->foreignId('area_estimate_id')->constrained('area_estimates');
            $table->foreignId('access_type_id')->constrained('access_types');
            $table->foreignId('terrain_type_id')->constrained('terrain_types');
            // TODO: Remove nullable once Geopedia fixes their data
            $table->foreignId('municipality_id')->nullable()->constrained('municipalities');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['updated_at']);
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
        Schema::dropIfExists('dumps');
    }
};
