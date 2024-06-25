@role('admin|asesor|tutor')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Detalles del Tema de Grado</h3>
    <table class="table custom-table table-striped table-bordered border-success">
        <tr>
            <th>Nombre del Tema:</th>
            <td>{{ $tema->nombretema }}</td>
        </tr>
        <tr>
            <th>Modalidad:</th>
            <td>{{ $tema->modalidad }}</td>
        </tr>
        <tr>
            <th>Fecha de Registro:</th>
            <td>{{ $tema->fecha_registro }}</td>
        </tr>
        <tr>
            <th>Asesor:</th>
            <td>
                @if($tema->asesor)
                {{ $tema->asesor->nombre }} {{ $tema->asesor->apellido }}
                @else
                <span style="color: red;">Sin asignar a un asesor</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Tutor:</th>
            <td>
                @if($tema->tutor)
                {{ $tema->tutor->nombre }} {{ $tema->tutor->apellido }}
                @else
                <span style="color: red;">Sin asignar a un tutor</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Objetivo:</th>
            <td>{{ $tema->objetivo }}</td>
        </tr>
        <tr>
            <th>Carrera:</th>
            <td>{{ $tema->carrera }}</td>
        </tr>
        <tr>
            <th>Institución destino:</th>
            <td>{{ $tema->institucion }}</td>
        </tr>
        <tr>
            <th>Documento:</th>
            <td>
                @if($tema->documento)
                <a href="{{ Storage::url($tema->documento) }}" target="_blank">Ver Documento</a>
                @else
                <span style="color: red;">Este tema no cuenta con un documento adicional</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Estado:</th>
            <td>
                @if($tema->estado)
                {{ $tema->estado }}
                @else
                <span style="color: red;">Sin estado asignado</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Estudiante Asignado:</th>
            <td>
                @if($tema->estudiante)
                {{ $tema->estudiante->nombre }} {{ $tema->estudiante->apellidos }}
                @else
                <span style="color: red;">Sin asignar</span>
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('temas.index') }}" class="btn btn-secondary">Volver</a>
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
