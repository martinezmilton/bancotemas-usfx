
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h3>Editar Tutor</h3>
        <div class="mb-4 custom-form">
        <form action="{{ route('tutores.update', $tutor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" name="dni" class="form-control" value="{{ $tutor->dni }}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" class="form-control" value="{{ $tutor->apellido }}" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $tutor->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" class="form-control" value="{{ $tutor->telefono }}" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" class="form-control" value="{{ $tutor->correo }}" required>
            </div>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" name="materia" class="form-control" value="{{ $tutor->materia }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('tutores.index') }}" class="btn btn-secondary">Volver</a>
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