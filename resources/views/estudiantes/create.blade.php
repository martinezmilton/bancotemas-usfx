
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Registrar Estudiantes</h3>
    <div class="mb-4 custom-form">
        <form action="{{ route('estudiantes.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="csv_file">Archivo:</label>
                <input type="file" name="csv_file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir y Guardar</button>
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
</style>