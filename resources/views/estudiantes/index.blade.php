@role('admin|asesor')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Lista de Estudiantes</h3>
    <!-- <a href="{{ route('estudiantes.create') }}" class="btn btn-success mb-3">Registrar Estudiantes</a> -->
    <table class="table custom-table table-striped table-bordered border-success">
        <thead>
            <tr style="background-color: #343A40; color:white">
                <th>DNI</th>
                <th>Apellidos</th>
                <th>Nombre(s)</th>
                <th>Carrera</th>
                <th>Asesor</th>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Tutor</th>
                <th>Tema</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->dni }}</td>
                <td>{{ $estudiante->apellidos }}</td>
                <td>{{ $estudiante->nombre }}</td>
                <td>{{ $estudiante->carrera }}</td>
                <td>{{ $estudiante->asesor }}</td>
                <td>{{ $estudiante->materia }}</td>
                <td>{{ $estudiante->grupo }}</td>
                <td>{{ optional($estudiante->tutor)->nombre ?? 'Sin asignar' }}</td>
                <td>{{ optional($estudiante->tema)->nombretema ?? 'Sin tema asignado' }}</td>
                <td>
                    <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este estudiante?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@endrole

<style>
    .custom-table {
        background-color: #017BFF;
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
</style>