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
        Schema::table('temas', function (Blueprint $table) {
            // Agregar el campo proyecto_terminado_pdf
            $table->string('proyecto_terminado_pdf')->nullable()->after('estudiante_asignado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temas', function (Blueprint $table) {
            // Revertir la migración eliminando el campo proyecto_terminado_pdf
            $table->dropColumn('proyecto_terminado_pdf');
        });
    }
};
