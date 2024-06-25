<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutors';

    protected $fillable = [

        'dni',
        'apellido',
        'nombre',
        'telefono',
        'correo',
        'materia'
    ];

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }
}
