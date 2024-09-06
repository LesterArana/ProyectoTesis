@extends('layouts.index')

@section('content')
<div class="container">
    <h2>@isset($deduccion) Editar Deducción @else Crear Deducción @endisset</h2>

    <form action="@isset($deduccion) {{ route('deducciones.update', $deduccion->id) }} @else {{ route('deducciones.store') }} @endisset" method="POST">
        @csrf
        @isset($deduccion) @method('PUT') @endisset

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $deduccion->descripcion ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" step="0.01" name="monto" class="form-control" value="{{ old('monto', $deduccion->monto ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Deducción</label>
            <select name="tipo" class="form-control" required>
                <option value="fijo" @isset($deduccion) {{ $deduccion->tipo === 'fijo' ? 'selected' : '' }} @endisset>Fijo</option>
                <option value="porcentaje" @isset($deduccion) {{ $deduccion->tipo === 'porcentaje' ? 'selected' : '' }} @endisset>Porcentaje</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="es_porcentaje" class="form-label">¿Es un Porcentaje?</label>
            <select name="es_porcentaje" class="form-control" required>
                <option value="0" @isset($deduccion) {{ $deduccion->es_porcentaje == 0 ? 'selected' : '' }} @endisset>No</option>
                <option value="1" @isset($deduccion) {{ $deduccion->es_porcentaje == 1 ? 'selected' : '' }} @endisset>Sí</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">@isset($deduccion) Actualizar @else Guardar @endisset Deducción</button>
    </form>
</div>
@endsection
