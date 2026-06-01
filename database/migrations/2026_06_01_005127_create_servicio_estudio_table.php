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
        Schema::create('servicio_estudio', function (Blueprint $table) {
            $table->integer('servicio_id');
            $table->integer('estudio_id')->index('estudio_id');

            $table->primary(['servicio_id', 'estudio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_estudio');
    }
};
