<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deduccion;

class DeduccionController extends Controller
{
    public function index()
    {
        $deducciones = Deduccion::all();
        return view('deducciones.index', compact('deducciones'));
    }

    public function create()
    {
        return view('deducciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:191',
            'monto' => 'required|numeric',
            'tipo' => 'required|string|max:191',
            'es_porcentaje' => 'required|boolean',
        ]);

        Deduccion::create($request->all());

        return redirect()->route('deducciones.index')->with('success', 'Deducción creada exitosamente.');
    }

    public function edit($id)
    {
        $deduccion = Deduccion::findOrFail($id);
        return view('deducciones.edit', compact('deduccion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:191',
            'monto' => 'required|numeric',
            'tipo' => 'required|string|max:191',
            'es_porcentaje' => 'required|boolean',
        ]);

        $deduccion = Deduccion::findOrFail($id);
        $deduccion->update($request->all());

        return redirect()->route('deducciones.index')->with('success', 'Deducción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $deduccion = Deduccion::findOrFail($id);
        $deduccion->delete();

        return redirect()->route('deducciones.index')->with('success', 'Deducción eliminada exitosamente.');
    }
}

