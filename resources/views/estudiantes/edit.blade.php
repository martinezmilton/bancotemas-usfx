
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Editar Estudiante</h3>
    <div class="mb-4 custom-form">
        <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" name="dni" class="form-control" value="{{ $estudiante->dni }}" readonly>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $estudiante->nombre }}" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" class="form-control" value="{{ $estudiante->apellidos }}" required>
            </div>

            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" class="form-control" value="{{ $estudiante->carrera }}" required>
            </div>

            <div class="form-group">
                <label for="asesor">Asesor:</label>
                <input type="text" name="asesor" class="form-control" value="{{ $estudiante->asesor }}" required>
            </div>

            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" name="materia" class="form-control" value="{{ $estudiante->materia }}" required>
            </div>

            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" name="grupo" class="form-control" value="{{ $estudiante->grupo }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection

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