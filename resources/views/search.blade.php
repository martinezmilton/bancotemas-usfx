@role('admin|asesor|tutor|estudiante')
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Banco de Temas de Grado USFX - Facultad de Tecnologia</h3>

    <!-- Campo de búsqueda -->
    <form action="{{ route('search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar tema de grado..." value="{{ request()->get('search') }}">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Etiquetas de búsqueda -->
    <div class="mb-3">
        <a href="{{ route('search', ['tag' => 'Ver todo']) }}" class="badge badge-secondary">Ver todo</a>
        <!-- <a href="{{ route('search', ['tag' => 'Proyecto Terminado']) }}" class="badge badge-success">Proyecto Terminado</a> -->
        <a href="{{ route('search', ['tag' => 'Ingeniería de Sistemas']) }}" class="badge badge-info">Sistemas</a>
        <a href="{{ route('search', ['tag' => 'Ingeniería en Ciencias de la Computación']) }}" class="badge badge-dark">Ciencias de la Computación</a>
        <a href="{{ route('search', ['tag' => 'Ingeniería en Tecnologías de la Información']) }}" class="badge badge-secondary">Tecnologías de la Información</a>
        <a href="{{ route('search', ['tag' => 'tesis de grado']) }}" class="badge badge-info">Tesis de Grado</a>
        <a href="{{ route('search', ['tag' => 'trabajo dirigido']) }}" class="badge badge-dark">Trabajo Dirigido</a>
        <a href="{{ route('search', ['tag' => 'proyecto de grado']) }}" class="badge badge-secondary">Proyecto de Grado</a>
    </div>

    <!-- Tabla de resultados -->
    <table class="table custom-table table-striped table-bordered border-success">
        <thead>
            <tr style="background-color: #343A40; color:white">
                <th>Nombre del Tema</th>
                <th>Modalidad</th>
                <th>Fecha de Registro</th>
                <th>Asesor</th>
                <th>Tutor</th>
                <th>Carrera</th>
                <th>Institución destino</th>
                <th>Estado</th>
                <th>Ver mas detalles</th>
            </tr>
        </thead>
        <tbody>
            @if($temas->isEmpty())
            <tr>
                <td colspan="9" class="text-center">No hay resultados</td>
            </tr>
            @else
            @foreach($temas as $tema)
            <tr>
                <td>{{ $tema->nombretema }}</td>
                <td>{{ $tema->modalidad }}</td>
                <td>{{ $tema->fecha_registro }}</td>
                <td>{{ $tema->asesor->nombre }} {{ $tema->asesor->apellido }}</td>
                <td>
                    @if($tema->tutor)
                    {{ $tema->tutor->nombre }} {{ $tema->tutor->apellido }}
                    @else
                    <span style="color: red;">Sin tutor</span>
                    @endif
                </td>
                <td>{{ $tema->carrera }}</td>
                <td>{{ $tema->institucion }}</td>
                <td>{{ $tema->estado }}</td>
                <td>
                    <a href="{{ route('tema.detalle', ['id' => $tema->id]) }}" class="btn btn-info btn-sm">Ver más</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

<style>
    .custom-table {
        background-color: #017BFF;
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
</style>
@endrole