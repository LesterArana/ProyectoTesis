@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Agregar Nuevo Empleado</h2>
    <form action="{{ url('/empleados') }}" method="POST">
        @csrf    
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title">Llene los datos</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre del empleado" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos del empleado" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="dpi" class="form-label">DPI</label>
                            <input type="text" class="form-control" id="dpi" name="dpi" placeholder="DPI del empleado" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                            <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre" placeholder="Tipo de sangre" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
                            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" placeholder="Tipo de contrato" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="puesto_id" class="form-label">Puesto</label>
                            <select class="form-control" id="puesto_id" name="puesto_id" required>
                                @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
