<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Asesor;
use App\Models\Tutor;
use App\Models\Tema;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EstudiantesImport;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->store('csv_files');

        Excel::import(new EstudiantesImport, $path);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiantes registrados correctamente.');
    }

    public function show($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $asesores = Asesor::all();
        $tutors = Tutor::all();
        $temas = Tema::all();
        return view('estudiantes.edit', compact('estudiante', 'asesores', 'tutors', 'temas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'carrera' => 'required',
            'asesor' => 'required',
            'materia' => 'required',
            'grupo' => 'required',
            'tutor_id' => 'nullable|exists:tutors,id',
            'tema_id' => 'nullable|exists:temas,id',
        ]);

        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Realizar la búsqueda en base al nombre del estudiante
        $estudiantes = Estudiante::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('apellidos', 'like', '%' . $query . '%')
            ->orderBy('nombre')
            ->get();

        return view('estudiantes.search', compact('estudiantes'));
    }
}
