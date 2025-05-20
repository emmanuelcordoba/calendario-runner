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
        Schema::create('ediciones', function (Blueprint $table) {
            $table->id();
            $table->date('desde');
            $table->date('hasta');
            $table->json('distancias');
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('carrera_id');
            $table->timestamps();
            $table->foreign('carrera_id')->references('id')->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones');
    }
};
