
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Temas de Grado</h3>
    <!-- <a href="{{ route('temas.create') }}" class="btn" style="background-color: #5A6268; color: white; border-color: #5A6268; margin-bottom: 15px;">Registrar Nuevo Tema</a> -->
    <table class="table custom-table table-striped table-bordered border-success">
        <thead>
            <tr style="background-color: #343A40; color:white">
                <th>Nombre del Tema</th>
                <th>Modalidad</th>
                <th>Fecha de Registro</th>
                <!-- <th>Tutor</th> -->
                <th>Asesor</th>
                <!-- <th>Documento</th> -->
                <th>Carrera</th>
                <th>Institución destino</th>
                <th>Estado</th>
                <th>Estudiante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temas as $tema)
            <tr>
                <td>{{ $tema->nombretema }}</td>
                <td>{{ $tema->modalidad }}</td>
                <td>{{ $tema->fecha_registro }}</td>
                <!-- <td>
                    @if($tema->tutor)
                    {{ $tema->tutor->nombre }} {{ $tema->tutor->apellido }}
                    @else
                    <span style="color: red;">Sin asignar</span>
                    @endif
                </td> -->
                <td>
                    @if($tema->asesor)
                    {{ $tema->asesor->nombre }} {{ $tema->asesor->apellido }}
                    @else
                    <span style="color: red;">Sin asignar</span>
                    @endif
                </td>
                <!-- <td>
                    @if($tema->documento)
                    <a href="{{ Storage::url($tema->documento) }}" target="_blank">Ver Documento</a>
                    @else
                    <span style="color: red;">Sin documento</span>
                    @endif
                </td> -->
                <td>{{ $tema->carrera }}</td>
                <td>{{ $tema->institucion }}</td>
                <td>{{ $tema->estado }}</td>
                <td>
                    @if($tema->estudiante)
                    {{ $tema->estudiante->nombre }} {{ $tema->estudiante->apellidos }}
                    @else
                    <span style="color: red;">Sin asignar</span>
                    @endif
                </td>
                <td>
                    <div class="text-left">
                        <a href="{{ route('temas.show', $tema->id) }}" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye"></i></a>
                        
                        <a href="{{ route('temas.edit', $tema->id) }}" class="btn btn-primary btn-sm mb-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('temas.destroy', $tema->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este tema?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        
                       
                        <a href="{{ route('temas.asignarshow', $tema->id) }}" class="btn badge badge-dark btn-sm mb-1">Asignar</a>
                        
                    </div>
                </td>
            </tr>
            @endforeach
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
