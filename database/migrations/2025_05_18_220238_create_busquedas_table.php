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
        Schema::create('busquedas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->date('desde')->nullable();
            $table->date('hasta')->nullable();
            $table->string('disciplina')->nullable();
            $table->timestamps();
            $table->foreign('carrera_id')->references('id')->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('busquedas');
    }
};
