@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Listado de Empleados</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('empleados.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Agregar Empleado</a>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Puesto</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombres }}</td>
                <td>{{ $empleado->apellidos }}</td>
                <td>{{ $empleado->puesto->nombre ?? 'N/A' }}</td>
                <td class="text-center">
                    <!-- Botón para ver detalles del empleado -->
                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm mx-1">Ver</a>

                    <!-- Botón para editar empleado -->
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm mx-1">Editar</a>

                    <!-- Botón para eliminar empleado -->
                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
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
