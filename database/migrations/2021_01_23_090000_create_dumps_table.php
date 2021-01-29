<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDumpsTable extends Migration
{
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
            $table->boolean('dangerous')->default(false);
            $table->boolean('cleared')->default(false);
            $table->unsignedSmallInteger('distance');
            $table->boolean('urgent')->default(false);
            $table->unsignedInteger('area'); // in m**2
            $table->foreignId('user_id')->constrained(); // id uporabnika
            $table->foreignId('volume_id')->constrained(); // prostornina
            $table->foreignId('access_id')->constrained(); // Način dostopa
            $table->foreignId('terrain_id')->constrained(); // Vrsta terena
            $table->foreignId('irsop_id')->constrained(); // podatki o inšpektoratu
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('dumps');
    }
}
