<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;
    
    protected $table = 'asesors';

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
