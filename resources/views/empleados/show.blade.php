@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detalles del Empleado</h2>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">{{ $empleado->nombres }} {{ $empleado->apellidos }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $empleado->id }}</p>
                    <p><strong>Nombres:</strong> {{ $empleado->nombres }}</p>
                    <p><strong>Apellidos:</strong> {{ $empleado->apellidos }}</p>
                    <p><strong>DPI:</strong> {{ $empleado->dpi }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha de Contratación:</strong> {{ $empleado->fecha_contratacion }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $empleado->email }}</p>
                    <p><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
                    <p><strong>Tipo de Sangre:</strong> {{ $empleado->tipo_sangre }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Tipo de Contrato:</strong> {{ $empleado->tipo_contrato }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Puesto:</strong> {{ $empleado->puesto->nombre ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
