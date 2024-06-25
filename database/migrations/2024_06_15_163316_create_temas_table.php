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
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->string('nombretema');
            $table->enum('modalidad', ['trabajo dirigido', 'proyecto de grado', 'tesis de grado']);
            $table->date('fecha_registro');
            $table->unsignedBigInteger('asesor_id');
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->text('objetivo');
            $table->enum('carrera', ['ingeniería de sistemas', 'ingeniería en ciencias de la computación', 'ingeniería en tecnologías de la información']);
            $table->string('institucion');
            $table->string('documento')->nullable();
            $table->timestamps();

            $table->foreign('asesor_id')->references('id')->on('asesors')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temas');
    }
};
