@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $empleado->nombres }}" placeholder="Ingrese los nombres del empleado" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $empleado->apellidos }}" placeholder="Ingrese los apellidos del empleado" required>
        </div>

        <div class="form-group mb-3">
            <label for="dpi" class="form-label">DPI</label>
            <input type="text" class="form-control" id="dpi" name="dpi" value="{{ $empleado->dpi }}" placeholder="Ingrese el DPI del empleado" required>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ $empleado->fecha_contratacion }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->email }}" placeholder="Ingrese el correo electrónico" required>
        </div>

        <div class="form-group mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $empleado->direccion }}" placeholder="Ingrese la dirección" required>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
            <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre" value="{{ $empleado->tipo_sangre }}" placeholder="Ingrese el tipo de sangre" required>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" value="{{ $empleado->tipo_contrato }}" placeholder="Ingrese el tipo de contrato" required>
        </div>

        <div class="form-group mb-4">
            <label for="puesto" class="form-label">Puesto</label>
            <select class="form-control" id="puesto" name="puesto_id">
                @foreach($puestos as $puesto)
                    <option value="{{ $puesto->id }}" {{ $empleado->puesto_id == $puesto->id ? 'selected' : '' }}>
                        {{ $puesto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botón de guardar cambios -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
