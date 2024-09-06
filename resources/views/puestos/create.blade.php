@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Agregar Nuevo Puesto</h2>

    <form action="{{ route('puestos.store') }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del puesto" required>
        </div>

        <div class="form-group mb-3">
            <label for="salario_quincena" class="form-label">Salario por Quincena</label>
            <input type="number" step="0.01" class="form-control" id="salario_quincena" name="salario_quincena" placeholder="Ingrese el salario quincenal">
        </div>

        <div class="form-group mb-3">
            <label for="salario_mes" class="form-label">Salario por Mes</label>
            <input type="number" step="0.01" class="form-control" id="salario_mes" name="salario_mes" placeholder="Ingrese el salario mensual">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Guardar</button>
        </div>
    </form>
</div>
@endsection
