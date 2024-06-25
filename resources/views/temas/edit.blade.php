@role('admin|tutor')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Editar Tema de Grado</h3>
    <div class="mb-4 custom-form">
        <form action="{{ route('temas.update', $tema->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombretema">Nombre del Tema:</label>
                    <input type="text" name="nombretema" class="form-control" value="{{ $tema->nombretema }}" required>
                </div>
                <div class="form-group">
                    <label for="modalidad">Modalidad:</label>
                    <select name="modalidad" class="form-control" required>
                        <option value="">Seleccione una modalidad</option>
                        <option value="trabajo dirigido" {{ $tema->modalidad == 'trabajo dirigido' ? 'selected' : '' }}>Trabajo Dirigido</option>
                        <option value="proyecto de grado" {{ $tema->modalidad == 'proyecto de grado' ? 'selected' : '' }}>Proyecto de Grado</option>
                        <option value="tesis de grado" {{ $tema->modalidad == 'tesis de grado' ? 'selected' : '' }}>Tesis de Grado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_registro">Fecha de Registro:</label>
                    <input type="date" name="fecha_registro" class="form-control" value="{{ $tema->fecha_registro }}" required>
                </div>
                <div class="form-group">
    <label for="asesor_id">Asesor:</label>
    <select name="asesor_id" class="form-control" {{ $tema->asesor_id ? '' : 'required' }}>
        <option value="">Seleccione un asesor</option>
        @foreach($asesores as $asesor)
        <option value="{{ $asesor->id }}" {{ $tema->asesor_id == $asesor->id ? 'selected' : '' }}>{{ $asesor->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="tutor_id">Tutor:</label>
    <select name="tutor_id" class="form-control" required>
        <option value="">Seleccione un tutor</option>
        @foreach($tutors as $tutor)
        <option value="{{ $tutor->id }}" {{ $tema->tutor_id == $tutor->id ? 'selected' : '' }}>{{ $tutor->nombre }}</option>
        @endforeach
    </select>
</div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="objetivo">Objetivo del Tema:</label>
                    <textarea name="objetivo" class="form-control" rows="5" required>{{ $tema->objetivo }}</textarea>
                </div>
                <div class="form-group">
                    <label for="carrera">Carrera:</label>
                    <select name="carrera" class="form-control" required>
                        <option value="">Seleccione una carrera</option>
                        <option value="ingeniería de sistemas" {{ $tema->carrera == 'ingeniería de sistemas' ? 'selected' : '' }}>Ingeniería de Sistemas</option>
                        <option value="ingeniería en ciencias de la computación" {{ $tema->carrera == 'ingeniería en ciencias de la computación' ? 'selected' : '' }}>Ingeniería en Ciencias de la Computación</option>
                        <option value="ingeniería en tecnologías de la información" {{ $tema->carrera == 'ingeniería en tecnologías de la información' ? 'selected' : '' }}>Ingeniería en Tecnologías de la Información</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="institucion">Institución Destino:</label>
                    <input type="text" name="institucion" class="form-control" value="{{ $tema->institucion }}" required>
                </div>
                <div class="form-group">
                    <label for="documento">Documento del Tema (PDF):</label>
                    <input type="file" name="documento" class="form-control" accept="application/pdf">
                    @if($tema->documento)
                    <a href="{{ Storage::url($tema->documento) }}" target="_blank">Ver Documento Actual</a>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('temas.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>
@endsection
@endrole

<style>
    .custom-form {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #ffffff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group input::placeholder {
        color: #999;
    }
</style>