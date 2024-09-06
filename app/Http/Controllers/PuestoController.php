<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto;

class PuestoController extends Controller
{
    public function index()
    {
        $puestos = Puesto::all();
        return view('puestos.index', compact('puestos'));
    }

    public function create()
    {
        return view('puestos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'salario_hora' => 'nullable|numeric',
            'salario_dia' => 'nullable|numeric',
            'salario_quincena' => 'nullable|numeric',
            'salario_mes' => 'nullable|numeric',
        ]);

        Puesto::create($request->all());

        return redirect()->route('puestos.index')->with('success', 'Puesto creado exitosamente.');
    }

    public function edit($id)
    {
        $puesto = Puesto::findOrFail($id);
        return view('puestos.edit', compact('puesto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'salario_hora' => 'nullable|numeric',
            'salario_dia' => 'nullable|numeric',
            'salario_quincena' => 'nullable|numeric',
            'salario_mes' => 'nullable|numeric',
        ]);

        $puesto = Puesto::findOrFail($id);
        $puesto->update($request->all());

        return redirect()->route('puestos.index')->with('success', 'Puesto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $puesto = Puesto::findOrFail($id);
        $puesto->delete();

        return redirect()->route('puestos.index')->with('success', 'Puesto eliminado exitosamente.');
    }
}


