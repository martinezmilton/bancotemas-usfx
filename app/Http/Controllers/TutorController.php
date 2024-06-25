<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;

class TutorController extends Controller
{

    public function index()
    {
        $tutores = Tutor::all();
        return view('tutores.index', compact('tutores'));
    }

    public function create()
    {
        return view('tutores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:tutors,dni',
            'apellido' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'materia' => 'required',
        ]);

        Tutor::create($request->all());

        return redirect()->route('tutores.index')
            ->with('success', 'Tutor creado correctamente.');
    }

    
    public function show(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.show', compact('tutor'));
    }

    
    public function edit(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.edit', compact('tutor'));
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dni' => 'required|unique:tutors,dni,' . $id,
            'apellido' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'materia' => 'required',
        ]);

        $tutor = Tutor::findOrFail($id);
        $tutor->update($request->all());

        return redirect()->route('tutores.index')
            ->with('success', 'Tutor actualizado correctamente.');
    }

    
    public function destroy(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();

        return redirect()->route('tutores.index')
            ->with('success', 'Tutor eliminado correctamente.');
    }
}
