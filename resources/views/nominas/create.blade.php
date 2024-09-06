@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Crear Nueva Nómina</h2>

    <form action="{{ route('nominas.store') }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf

        <div class="form-group mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select name="empleado_id" class="form-control" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
            <select class="form-control" id="tipo_pago" name="tipo_pago" required>
                <option value="quincena">Quincenal</option>
                <option value="mes">Mensual</option>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="bonificacion_incentivo" class="form-label">Días Trabajados</label>
            <input type="number" name="dias_trabajados" class="form-control" value="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="horas_extras" class="form-label">Horas Extras</label>
            <input type="number" name="horas_extras" class="form-control" value="0" step="0.01" min="0">
        </div>
        
        <div class="form-group mb-3">
            <label for="valor_hora_extra" class="form-label">Valor Hora Extra</label>
            <input type="number" name="valor_hora_extra" class="form-control" value="0" step="0.01" min="0">
        </div>
        
        <div class="form-group mb-3">
            <label for="bonificacion_incentivo" class="form-label">Bonificación Incentivo</label>
            <input type="number" name="bonificacion_incentivo" class="form-control" value="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="bonificacion_rendimiento" class="form-label">Bonificación Rendimiento</label>
            <input type="number" name="bonificacion_rendimiento" class="form-control" value="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="cantidad_iggs" class="form-label">IGSS (%)</label>
            <input type="number" name="cantidad_iggs" class="form-control" value="0" step="0.01">
        </div>
        

        <div class="form-group mb-3">
            <label for="pasajes_viaticos" class="form-label">Pasajes o Viáticos</label>
            <input type="number" name="pasajes_viaticos" class="form-control" value="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="deducciones" class="form-label">Deducciones</label>
            <select name="deducciones[]" class="form-control" multiple>
                @foreach($deducciones as $deduccion)
                    <option value="{{ $deduccion->id }}">{{ $deduccion->descripcion }} - @if($deduccion->es_porcentaje){{ $deduccion->monto }}%@else{{ 'Q ' . number_format($deduccion->monto, 2) }}@endif</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Crear Nómina</button>
        </div>
    </form>
</div>
@endsection
