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
            $table->unsignedBigInteger('asesor_id')->nullable()->change();
            $table->unsignedBigInteger('tutor_id')->nullable(false)->change();
            $table->enum('estado', ['tema libre', 'asignado', 'perfil aprobado', 'proyecto terminado'])
                ->default('tema libre')
                ->after('documento');
            $table->unsignedBigInteger('estudiante_asignado')->nullable()->after('estado');

            $table->foreign('estudiante_asignado')->references('id')->on('estudiantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temas', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropForeign(['estudiante_asignado']);
            $table->dropColumn('estudiante_asignado');

            $table->unsignedBigInteger('asesor_id')->nullable(false)->change();
            $table->unsignedBigInteger('tutor_id')->nullable()->change();
        });
    }
};
