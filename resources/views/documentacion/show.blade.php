@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Documentación de {{ $documentacion->empleado->nombres }} {{ $documentacion->empleado->apellidos }}</h2>
    
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Documento</h5>
        </div>
        <div class="card-body">
            @php
                $fileExtension = pathinfo($documentacion->file_path, PATHINFO_EXTENSION);
            @endphp

            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/'.$documentacion->file_path) }}" alt="Documento" class="img-fluid rounded">
                </div>
            @endif

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ asset('storage/'.$documentacion->file_path) }}" target="_blank" class="btn btn-info"><i class="bi bi-eye"></i> Ver documento</a>
                <a href="{{ asset('storage/'.$documentacion->file_path) }}" download class="btn btn-success"><i class="bi bi-download"></i> Descargar documento</a>
            </div>

            <form action="{{ route('documentaciones.destroy', $documentacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este documento?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
