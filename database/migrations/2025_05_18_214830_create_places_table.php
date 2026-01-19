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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('race_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('locality_id')->nullable();
            $table->string('place')->nullable();
            $table->timestamps();
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('locality_id')->references('id')->on('localities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
