<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentacion;
use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;


class DocumentacionController extends Controller
{
    public function index()
    {
        $documentaciones = Documentacion::with('empleado')->get();
        return view('documentacion.index', compact('documentaciones'));
    }
    

    public function create()
    {
        $empleados = Empleado::all();
        return view('documentacion.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'file' => 'required|file|mimes:pdf,jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string|max:255', // Validación para el nombre
        ]);
    
        $filePath = $request->file('file')->store('uploads', 'public');
    
        Documentacion::create([
            'empleado_id' => $validated['empleado_id'],
            'file_path' => $filePath,
            'nombre' => $validated['nombre'], // Guardar el nombre
        ]);
    
        return redirect()->route('documentaciones.index')->with('success', 'Documentación agregada exitosamente.');
    }
    

    public function show($id)
    {
        $documentacion = Documentacion::findOrFail($id);
        return view('documentacion.show', compact('documentacion'));
    }

    public function destroy($id)
{
    $documentacion = Documentacion::findOrFail($id);

    // Elimina el archivo del almacenamiento
    Storage::disk('public')->delete($documentacion->file_path);

    // Elimina el registro de la base de datos
    $documentacion->delete();

    return redirect()->route('documentaciones.index')->with('success', 'Documentación eliminada exitosamente.');
}

}
