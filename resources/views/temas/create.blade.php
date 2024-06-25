@role('admin|tutor')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Registrar Nuevo Tema de Grado</h3>
    <div class="mb-4 custom-form">
    <form action="{{ route('temas.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-md-6">
        <div class="form-group">
            <label for="nombretema">Nombre del Tema:</label>
            <input type="text" name="nombretema" class="form-control" placeholder="Agregue el Nombre del tema" required>
        </div>
        <div class="form-group">
            <label for="modalidad">Modalidad:</label>
            <select name="modalidad" class="form-control" required>
                <option value="">Seleccione una modalidad</option>
                <option value="trabajo dirigido">Trabajo Dirigido</option>
                <option value="proyecto de grado">Proyecto de Grado</option>
                <option value="tesis de grado">Tesis de Grado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_registro">Fecha de Registro:</label>
            <input type="date" name="fecha_registro" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asesor_id">Asesor:</label>
            <select name="asesor_id" class="form-control" required>
                <option value="">Seleccione un asesor</option>
                @foreach($asesores as $asesor)
                <option value="{{ $asesor->id }}">{{ $asesor->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tutor_id">Tutor:</label>
            <select name="tutor_id" class="form-control">
                <option value="">Seleccione un tutor</option>
                @foreach($tutors as $tutor)
                <option value="{{ $tutor->id }}">{{ $tutor->nombre }}</option>
                @endforeach
            </select>
        </div>
        </div>
                <div class="col-md-6">
        <div class="form-group">
            <label for="objetivo">Objetivo del Tema:</label>
            <textarea name="objetivo" class="form-control" rows="5" placeholder="Agregue la descripcion del objetivo del tema" required></textarea>
        </div>
        <div class="form-group">
            <label for="carrera">Carrera:</label>
            <select name="carrera" class="form-control" required>
                <option value="">Seleccione una carrera</option>
                <option value="ingeniería de sistemas">Ingeniería de Sistemas</option>
                <option value="ingeniería en ciencias de la computación">Ingeniería en Ciencias de la Computación</option>
                <option value="ingeniería en tecnologías de la información">Ingeniería en Tecnologías de la Información</option>
            </select>
        </div>
        <div class="form-group">
            <label for="institucion">Institución Destino:</label>
            <input type="text" name="institucion" class="form-control" placeholder="Agregue la institucion destino" required>
        </div>
        <div class="form-group">
            <label for="documento">Documento del Tema (PDF):</label>
            <input type="file" name="documento" class="form-control" accept="application/pdf">
        </div>
        </div>
                <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
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