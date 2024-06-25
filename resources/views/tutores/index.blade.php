@role('admin')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Tutores</h3>
    <!-- Mostrar la lista de tutores registrados -->
    <div class="mb-4">
        <h5>Lista de Tutores Registrados</h5>
        <table class="table custom-table table-striped table-bordered border-success">
            <thead>
                <tr style="background-color: #343A40; color:white">
                    <th>DNI</th>
                    <th>Apellidos</th>
                    <th>Nombre(s)</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tutores as $tutor)
                <tr>
                    <td>{{ $tutor->dni }}</td>
                    <td>{{ $tutor->apellido }}</td>
                    <td>{{ $tutor->nombre }}</td>
                    <td>{{ $tutor->telefono }}</td>
                    <td>{{ $tutor->correo }}</td>
                    <td>{{ $tutor->materia }}</td>
                    <td>
                        <a href="{{ route('tutores.edit', $tutor->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('tutores.destroy', $tutor->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este tutor?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formulario para registrar un nuevo asesor -->
    <div>
        <h5>Registrar Nuevo Tutor</h5>
        <div class="mb-4 custom-form">
            <form action="{{ route('tutores.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dni">DNI:</label>
                        <input type="text" name="dni" class="form-control" placeholder="Agregue el DNI" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Agregue el Apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Agregue el Nombre" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" placeholder="Agregue el Teléfono" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" class="form-control" placeholder="Agregue el Correo" required>
                    </div>
                    <div class="form-group">
                        <label for="materia">Materia:</label>
                        <input type="text" name="materia" class="form-control" placeholder="Agregue la Materia" required>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar Tutor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endrole
<!-- estilos css -->
<style>
    .custom-table {
        background-color: #017BFF;
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

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