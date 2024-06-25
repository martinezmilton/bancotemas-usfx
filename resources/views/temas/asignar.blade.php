
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Asignar Estudiante a Tema: {{ $tema->nombretema }}</h3>

    <form action="{{ route('temas.asignarEstudiante', $tema->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="estudiante_id">Seleccionar Estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="form-control" required>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Estudiante</button>
    </form>
</div>
@endsection

