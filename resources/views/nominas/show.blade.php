@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Detalles de la Nómina</h2>

    <div class="card">
        <div class="card-header">
            Nómina ID: {{ $nomina->id }}
        </div>
        <div class="card-body">
            <p><strong>Empleado:</strong> {{ $nomina->empleado->nombres }} {{ $nomina->empleado->apellidos }}</p>
            <p><strong>Puesto:</strong> {{ $nomina->puesto->nombre }}</p>
            <p><strong>Horas Trabajadas:</strong> {{ $nomina->horas_trabajadas }}</p>
            <p><strong>Horas Extras:</strong> {{ $nomina->horas_extras }}</p>
            <p><strong>Total Pago:</strong> ${{ $nomina->total_pago }}</p>
            <p><strong>Salario Neto:</strong> ${{ $nomina->salario_neto }}</p>
            <p><strong>Deducciones:</strong></p>
            <ul>
                @foreach($nomina->deducciones as $deduccion)
                    <li>{{ $deduccion->descripcion }}: {{ $deduccion->es_porcentaje ? $deduccion->monto . '%' : '$' . $deduccion->monto }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('nominas.index') }}" class="btn btn-primary">Volver al Listado</a>
        </div>
    </div>
</div>
@endsection
