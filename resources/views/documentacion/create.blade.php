@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Agregar Documentación</h2>
    <form action="{{ route('documentaciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select class="form-control" id="empleado_id" name="empleado_id" required>
                <option value="">Seleccione un empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Documento</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Documento</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
