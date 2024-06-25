<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'carrera',
        'asesor',
        'materia',
        'grupo',
        'tutor_id',
        'tema_id',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }
}
