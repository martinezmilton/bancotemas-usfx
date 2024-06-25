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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('carrera');
            $table->string('asesor');
            $table->string('materia');
            $table->string('grupo');
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->unsignedBigInteger('tema_id')->nullable();
            $table->timestamps();

            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('set null');
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
