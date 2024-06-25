<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Asesor;
use App\Models\Tutor;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Storage;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::all();
        return view('temas.index', compact('temas'));
    }

    public function create()
    {
        $asesores = Asesor::all();
        $tutors = Tutor::all();
        return view('temas.create', compact('asesores', 'tutors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombretema' => 'required',
            'modalidad' => 'required|in:trabajo dirigido,proyecto de grado,tesis de grado',
            'fecha_registro' => 'required|date',
            'asesor_id' => 'required|exists:asesors,id',
            'tutor_id' => 'nullable|exists:tutors,id',
            'objetivo' => 'required',
            'carrera' => 'required|in:ingeniería de sistemas,ingeniería en ciencias de la computación,ingeniería en tecnologías de la información',
            'institucion' => 'required',
            'documento' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('documento')) {
            $data['documento'] = $request->file('documento')->store('documentos', 'public');
        }

        Tema::create($data);

        return redirect()->route('temas.index')->with('success', 'Tema de grado registrado correctamente.');
    }

    public function show($id)
    {
        $tema = Tema::findOrFail($id);
        return view('temas.show', compact('tema'));
    }

    public function asignarshow($id)
    {
        $tema = Tema::findOrFail($id);
        return view('temas.asignarshow', compact('tema'));
    }

    public function edit($id)
    {
        $tema = Tema::findOrFail($id);
        $asesores = Asesor::all();
        $tutors = Tutor::all();
        return view('temas.edit', compact('tema', 'asesores', 'tutors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombretema' => 'required',
            'modalidad' => 'required|in:trabajo dirigido,proyecto de grado,tesis de grado',
            'fecha_registro' => 'required|date',
            'asesor_id' => 'required|exists:asesors,id',
            'tutor_id' => 'nullable|exists:tutors,id',
            'objetivo' => 'required',
            'carrera' => 'required|in:ingeniería de sistemas,ingeniería en ciencias de la computación,ingeniería en tecnologías de la información',
            'institucion' => 'required',
            'documento' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $tema = Tema::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('documento')) {
            if ($tema->documento) {
                Storage::delete('public/' . $tema->documento);
            }
            $data['documento'] = $request->file('documento')->store('documentos', 'public');
        }

        $tema->update($data);

        return redirect()->route('temas.index')->with('success', 'Tema de grado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $tema = Tema::findOrFail($id);
        if ($tema->documento) {
            Storage::delete('public/' . $tema->documento);
        }
        $tema->delete();
        return redirect()->route('temas.index')->with('success', 'Tema de grado eliminado correctamente.');
    }

    //Funcion para mostrar los detalles del tema en buscar temas
    public function detalle($id)
    {
        $tema = Tema::findOrFail($id); // Asumiendo que el modelo se llama Tema y tiene un campo id

        return view('temas.detalle', compact('tema'));
    }


    //FUNCIONES PARA CAMBIAR ESTADOS DE TEMAS
    public function asignarEstudianteForm($id)
    {
        $tema = Tema::findOrFail($id);
        $estudiantes = Estudiante::whereNull('tema_id')->get();
        return view('temas.asignar', compact('tema', 'estudiantes'));
    }

    public function asignarEstudiante(Request $request, $temaId)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
        ]);

        $tema = Tema::findOrFail($temaId);
        $estudiante = Estudiante::findOrFail($request->input('estudiante_id'));

        // Actualizar el estado del tema y asignar estudiante
        $tema->update([
            'estado' => Tema::ESTADO_ASIGNADO,
            'estudiante_asignado' => $estudiante->id,
        ]);

        // Actualizar el estudiante con el tema y el tutor
        $estudiante->update([
            'tema_id' => $tema->id,
            'tutor_id' => $tema->tutor_id,
        ]);

        return redirect()->route('temas.index')->with('success', 'Tema asignado exitosamente.');
    }


    public function asignarTema(Request $request, $estudianteId)
    {
        $request->validate([
            'tema_id' => 'required|exists:temas,id',
        ]);

        $estudiante = Estudiante::findOrFail($estudianteId);
        $tema = Tema::findOrFail($request->input('tema_id'));

        // Actualizar estado y asignar estudiante
        $tema->update([
            'estado' => 'asignado',
            'estudiante_asignado' => $estudiante->id,
        ]);

        // Actualizar estudiante con tema y tutor
        $estudiante->update([
            'tema_id' => $tema->id,
            'tutor_id' => $tema->tutor_id,
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Tema asignado exitosamente.');
    }

    public function desasignarEstudiante($id)
    {
        $tema = Tema::findOrFail($id);

        if ($tema->estudiante_asignado) {
            $estudiante = Estudiante::findOrFail($tema->estudiante_asignado);

            $tema->estudiante_asignado = null;
            $tema->estado = Tema::ESTADO_LIBRE;
            $tema->save();

            $estudiante->tema_id = null;
            $estudiante->tutor_id = null;
            $estudiante->save();

            return redirect()->route('temas.asignarshow', $tema->id)->with('success', 'Tema desasignado correctamente.');
        } else {
            return redirect()->route('temas.asignarshow', $tema->id)->with('error', 'El tema no tiene estudiante asignado.');
        }
    }

    public function aprobarPerfil($id)
    {
        $tema = Tema::findOrFail($id);
        $tema->estado = Tema::ESTADO_PERFIL_APROBADO;
        $tema->save();

        return redirect()->route('temas.asignarshow', $tema->id)->with('success', 'Perfil del tema aprobado.');
    }


    public function proyectoTerminado(Request $request, $id)
    {
        $request->validate([
            'documento' => 'required|file|mimes:pdf|max:2048',
        ]);

        $tema = Tema::findOrFail($id);

        // Guardar el PDF en el sistema de archivos (public/storage/proyectos)
        $path = $request->file('documento')->store('proyectos', 'public');

        // Asignar la ruta del PDF al campo 'proyecto_terminado_pdf' del modelo Tema
        $tema->proyecto_terminado_pdf = $path;

        // Actualizar el estado del tema a 'ESTADO_PROYECTO_TERMINADO'
        $tema->estado = Tema::ESTADO_PROYECTO_TERMINADO;

        // Guardar los cambios en la base de datos
        $tema->save();

        return redirect()->route('temas.asignarshow', $tema->id)->with('success', 'Proyecto terminado y documento guardado.');
    }
}
