@role('admin|asesor')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Detalles del Estudiante</h3>
    <table class="table custom-table table-striped table-bordered border-success">
        <tr>
            <th>DNI:</th>
            <td>{{ $estudiante->dni }}</td>
        </tr>
        <tr>
            <th>Nombre:</th>
            <td>{{ $estudiante->nombre }}</td>
        </tr>
        <tr>
            <th>Apellidos:</th>
            <td>{{ $estudiante->apellidos }}</td>
        </tr>
        <tr>
            <th>Carrera:</th>
            <td>{{ $estudiante->carrera }}</td>
        </tr>
        <tr>
            <th>Asesor:</th>
            <td>{{ $estudiante->asesor }}</td>
        </tr>
        <tr>
            <th>Materia:</th>
            <td>{{ $estudiante->materia }}</td>
        </tr>
        <tr>
            <th>Grupo:</th>
            <td>{{ $estudiante->grupo }}</td>
        </tr>
        <tr>
            <th>Tutor:</th>
            <td>
                @if($estudiante->tutor)
                {{ $estudiante->tutor->nombre }}
                @else
                <span style="color: red;">Sin asignar</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Tema asignado:</th>
            <td>
                @if($estudiante->tema)
                {{ $estudiante->tema->nombretema }}
                @else
                <span style="color: red;">Sin tema asignado</span>
                @endif
            </td>
        </tr>

    </table>

    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Volver</a>
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