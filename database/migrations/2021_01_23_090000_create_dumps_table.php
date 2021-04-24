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
            $table->boolean('dangerous')->default(false);
            $table->boolean('cleared')->default(false);
            $table->boolean('urgent')->default(false);
            $table->unsignedInteger('area'); // in m**2
            $table->foreignId('user_id')->default(0)->constrained();
            $table->foreignId('volume_id')->constrained(); // prostornina
            $table->foreignId('access_id')->constrained(); // Način dostopa
            $table->foreignId('terrain_id')->constrained(); // Vrsta terena
            $table->timestamps();
            $table->softDeletes();
            $table->index(['cleared', 'updated_at']);
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
};
