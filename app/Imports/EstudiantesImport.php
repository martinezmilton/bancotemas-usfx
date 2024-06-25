<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstudiantesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Estudiante([
            'dni' => $row['dni'],
            'nombre' => $row['nombre'],
            'apellidos' => $row['apellidos'],
            'carrera' => $row['carrera'],
            'asesor' => $row['asesor'],
            'materia' => $row['materia'],
            'grupo' => $row['grupo'],
        ]);
    }
}
