@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Listado de Deducciones</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('deducciones.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Agregar Deducción</a>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Es Porcentaje</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deducciones as $deduccion)
                <tr>
                    <td>{{ $deduccion->id }}</td>
                    <td>{{ $deduccion->descripcion }}</td>
                    <td>{{ $deduccion->monto }}</td>
                    <td>{{ $deduccion->tipo }}</td>
                    <td>{{ $deduccion->es_porcentaje ? 'Sí' : 'No' }}</td>
                    <td class="text-center">
                        <a href="{{ route('deducciones.edit', $deduccion->id) }}" class="btn btn-warning btn-sm mx-1">Editar</a>
                        <form action="{{ route('deducciones.destroy', $deduccion->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta deducción?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
