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
        Schema::create('doctores', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nombre', 150);
            $table->string('profesion', 50)->nullable();
            $table->string('consultorio', 50)->nullable();
            $table->string('imagen')->nullable();
            $table->integer('especialidad_id')->nullable()->index('especialidad_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
