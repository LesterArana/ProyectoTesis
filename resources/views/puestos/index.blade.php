@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Listado de Puestos</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('puestos.create') }}" class="btn btn-success">Agregar Puesto <i class="fas fa-plus-circle"></i></a>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Salario por Mes (Q)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($puestos as $puesto)
                <tr>
                    <td>{{ $puesto->id }}</td>
                    <td>{{ $puesto->nombre }}</td>
                    <td>Q {{ number_format($puesto->salario_mes, 2) }}</td>
                    <td class="d-flex">
                        <a href="{{ route('puestos.edit', $puesto->id) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                        <form action="{{ route('puestos.destroy', $puesto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este puesto?');" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
