
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
            <td>{{ $tema->asesor->nombre }} {{ $tema->asesor->apellido }}</td>
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
            <td>{{ $tema->estado }}</td>
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

    @if($tema->estado == App\Models\Tema::ESTADO_LIBRE)
    <a href="{{ route('temas.asignarEstudianteForm', $tema->id) }}" class="btn btn-primary">Asignar a Estudiante</a>
    @elseif($tema->estado == App\Models\Tema::ESTADO_ASIGNADO)
    <form action="{{ route('temas.desasignar', $tema->id) }}" method="POST" style="display: inline-block;">
        @csrf
        <button type="submit" class="btn btn-warning" onclick="return confirm('¿Desasignar este tema del estudiante?')">Desasignar</button>
    </form>
    <form action="{{ route('temas.aprobarPerfil', $tema->id) }}" method="POST" style="display: inline-block;">
        @csrf
        <button type="submit" class="btn btn-success">Aprobar Perfil</button>
    </form>
    @elseif($tema->estado == App\Models\Tema::ESTADO_PERFIL_APROBADO)
    <form action="{{ route('temas.proyectoTerminado', $tema->id) }}" method="POST" enctype="multipart/form-data" style="display: inline-block;">
        @csrf
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="documento" name="documento" required>
                <label class="custom-file-label" for="documento">Seleccionar archivo</label>
            </div>
            <div class="input-group-append">
                <button type="submit" class="btn btn-danger">Proyecto Terminado</button>
            </div>
        </div>
    </form>
    @endif

    <a href="{{ route('temas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection

@section('js')
<script>
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });
</script>
@endsection
