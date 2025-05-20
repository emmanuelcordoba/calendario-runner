<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lugares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('localidad_id')->nullable();
            $table->string('lugar')->nullable();
            $table->timestamps();
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('localidad_id')->references('id')->on('localidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugares');
    }
};
