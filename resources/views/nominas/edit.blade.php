@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Nómina</h2>

    <form action="{{ route('nominas.update', $nomina->id) }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select name="empleado_id" class="form-control" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}" {{ $empleado->id == $nomina->empleado_id ? 'selected' : '' }}>{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
            <select class="form-control" id="tipo_pago" name="tipo_pago" required>
                <option value="quincena" {{ $nomina->tipo_pago == 'quincena' ? 'selected' : '' }}>Quincenal</option>
                <option value="mes" {{ $nomina->tipo_pago == 'mes' ? 'selected' : '' }}>Mensual</option>
            </select>
        </div>

        <div id="horas_trabajadas_field" class="form-group mb-3" style="display: none;">
            <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
            <input type="number" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="{{ $nomina->horas_trabajadas }}" min="0">
        </div>

        <div id="dias_trabajados_field" class="form-group mb-3" style="display: none;">
            <label for="dias_trabajados" class="form-label">Días Trabajados</label>
            <input type="number" name="dias_trabajados" id="dias_trabajados" class="form-control" value="{{ $nomina->dias_trabajados }}" min="0">
        </div>

        <div class="form-group mb-3">
            <label for="horas_extras" class="form-label">Horas Extras</label>
            <input type="number" name="horas_extras" class="form-control" value="{{ $nomina->horas_extras }}" min="0">
        </div>

        <div class="form-group mb-3">
            <label for="valor_hora_extra" class="form-label">Valor Hora Extra</label>
            <input type="number" name="valor_hora_extra" class="form-control" value="{{ $nomina->valor_hora_extra }}" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="deducciones" class="form-label">Deducciones</label>
            <select name="deducciones[]" class="form-control" multiple>
                @foreach($deducciones as $deduccion)
                    <option value="{{ $deduccion->id }}" {{ in_array($deduccion->id, $nomina->deducciones->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $deduccion->descripcion }} - @if($deduccion->es_porcentaje){{ $deduccion->monto }}%@else{{ 'Q ' . number_format($deduccion->monto, 2) }}@endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $nomina->fecha_inicio }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ $nomina->fecha_fin }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Actualizar Nómina</button>
        </div>
    </form>
</div>

<script>
    function togglePagoFields() {
        const tipoPago = document.getElementById('tipo_pago').value;
        const horasField = document.getElementById('horas_trabajadas_field');
        const diasField = document.getElementById('dias_trabajados_field');

        horasField.style.display = 'none';
        diasField.style.display = 'none';

        if (tipoPago === 'hora') {
            horasField.style.display = 'block';
        } else if (tipoPago === 'dia') {
            diasField.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        togglePagoFields(); // Inicializar los campos cuando la página se carga
    });

    document.getElementById('tipo_pago').addEventListener('change', togglePagoFields);
</script>
@endsection
