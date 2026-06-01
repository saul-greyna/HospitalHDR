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
        Schema::table('servicio_estudio', function (Blueprint $table) {
            $table->foreign(['servicio_id'], 'servicio_estudio_ibfk_1')->references(['id'])->on('servicios')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['estudio_id'], 'servicio_estudio_ibfk_2')->references(['id'])->on('estudios')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicio_estudio', function (Blueprint $table) {
            $table->dropForeign('servicio_estudio_ibfk_1');
            $table->dropForeign('servicio_estudio_ibfk_2');
        });
    }
};
