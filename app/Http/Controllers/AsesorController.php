<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asesor;

class AsesorController extends Controller
{
    public function index()
    {
        $asesores = Asesor::all();
        return view('asesores.index', compact('asesores'));
    }

    public function create()
    {
        return view('asesores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:asesors,dni',
            'apellido' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'materia' => 'required',
        ]);

        Asesor::create($request->all());

        return redirect()->route('asesores.index')
            ->with('success', 'Asesor creado correctamente.');
    }

    public function show($id)
    {
        $asesor = Asesor::findOrFail($id);
        return view('asesores.show', compact('asesor'));
    }

    public function edit($id)
    {
        $asesor = Asesor::findOrFail($id);
        return view('asesores.edit', compact('asesor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required|unique:asesors,dni,' . $id,
            'apellido' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'materia' => 'required',
        ]);

        $asesor = Asesor::findOrFail($id);
        $asesor->update($request->all());

        return redirect()->route('asesores.index')
            ->with('success', 'Asesor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $asesor = Asesor::findOrFail($id);
        $asesor->delete();

        return redirect()->route('asesores.index')
            ->with('success', 'Asesor eliminado correctamente.');
    }
}
