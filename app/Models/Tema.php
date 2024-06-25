<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    const ESTADO_LIBRE = 'tema libre';
    const ESTADO_ASIGNADO = 'asignado';
    const ESTADO_PERFIL_APROBADO = 'perfil aprobado';
    const ESTADO_PROYECTO_TERMINADO = 'proyecto terminado';

    protected $fillable = [
        'nombretema',
        'modalidad',
        'fecha_registro',
        'asesor_id',
        'tutor_id',
        'objetivo',
        'carrera',
        'institucion',
        'documento',
        'estado',
        'estudiante_asignado',
        'proyecto_terminado_pdf',
    ];

    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_asignado');
    }
}
