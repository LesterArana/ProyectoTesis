@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Documentación</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('documentaciones.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Agregar Documentación</a>
    </div>

    @foreach ($documentaciones->groupBy('empleado_id') as $empleado_id => $documentos)
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">{{ $documentos->first()->empleado->nombres }} {{ $documentos->first()->empleado->apellidos }}</h5>
            </div>
            <div class="card-body">
                <h6><strong>Documentos:</strong></h6>
                <ul class="list-group">
                    @foreach ($documentos as $documento)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $documento->nombre }}</span>
                            <div class="d-flex">
                                <a href="{{ route('documentaciones.show', $documento->id) }}" class="btn btn-info btn-sm mr-2">Ver</a>

                                <form action="{{ route('documentaciones.destroy', $documento->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach

</div>
@endsection
