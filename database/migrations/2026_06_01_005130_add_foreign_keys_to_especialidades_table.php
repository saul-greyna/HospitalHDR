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
        Schema::table('especialidades', function (Blueprint $table) {
            $table->foreign(['categoria_id'], 'especialidades_ibfk_1')->references(['id'])->on('categorias_especialidad')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('especialidades', function (Blueprint $table) {
            $table->dropForeign('especialidades_ibfk_1');
        });
    }
};
