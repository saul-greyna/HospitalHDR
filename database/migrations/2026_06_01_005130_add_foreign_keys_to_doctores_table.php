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
        Schema::table('doctores', function (Blueprint $table) {
            $table->foreign(['especialidad_id'], 'doctores_ibfk_1')->references(['id'])->on('especialidades')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctores', function (Blueprint $table) {
            $table->dropForeign('doctores_ibfk_1');
        });
    }
};
