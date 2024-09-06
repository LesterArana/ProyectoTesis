<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;


class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('puesto')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        
        {
            $puestos = Puesto::all(); // Asegúrate de que el modelo Puesto esté importado y definido
            return view('empleados.create', compact('puestos'));
        }
        
    }

    public function edit($id)
{
    $empleado = Empleado::findOrFail($id);
    $puestos = Puesto::all(); // Si tienes una relación con puestos
    return view('empleados.edit', compact('empleado', 'puestos'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'dpi' => 'required|string|max:20',
        'fecha_contratacion' => 'required|date',
        'email' => 'required|email|max:255',  // Cambia 'correo' por 'email'
        'direccion' => 'required|string|max:255',
        'tipo_sangre' => 'required|string|max:10',
        'tipo_contrato' => 'required|string|max:50',
        'puesto_id' => 'required|exists:puestos,id'
    ]);

    $empleado = Empleado::findOrFail($id);
    $empleado->update($validated);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
}



    public function store(Request $request)
{
    $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'fecha_contratacion' => 'required|date',
        'dpi' => 'required|string|max:20',
        'tipo_sangre' => 'required|string|max:3',
        'email' => 'required|email|max:255',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'tipo_contrato' => 'required|string|max:255',
        'puesto_id' => 'nullable|exists:puestos,id'
    ]);

    $empleado = new Empleado();
    $empleado->nombres = $request->nombres;
    $empleado->apellidos = $request->apellidos;
    $empleado->fecha_contratacion = $request->fecha_contratacion;
    $empleado->dpi = $request->dpi;
    $empleado->tipo_sangre = $request->tipo_sangre;
    $empleado->email = $request->email;
    $empleado->telefono = $request->telefono;
    $empleado->direccion = $request->direccion;
    $empleado->tipo_contrato = $request->tipo_contrato;
    $empleado->puesto_id = $request->puesto_id;

    $empleado->save();

    return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
}


    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    public function show($id)
{
    $empleado = Empleado::findOrFail($id);
    return view('empleados.show', compact('empleado'));
}


}
