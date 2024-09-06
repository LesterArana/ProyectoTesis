@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Puesto</h2>

    <form action="{{ route('puestos.update', $puesto->id) }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $puesto->nombre }}" placeholder="Ingrese el nombre del puesto" required>
        </div>

        <div class="form-group mb-3">
            <label for="salario_mes" class="form-label">Salario por Mes (Q)</label>
            <input type="number" class="form-control" id="salario_mes" name="salario_mes" value="{{ $puesto->salario_mes }}" step="0.01" placeholder="Ingrese el salario mensual">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Actualizar Puesto</button>
        </div>
    </form>
</div>
@endsection
