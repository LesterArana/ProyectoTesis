<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Deduccion;
use Barryvdh\DomPDF\Facade\Pdf;

class NominaController extends Controller
{
    public function index(Request $request)
    {
        $query = Nomina::query();

        // Filtrar por fechas si están presentes en la solicitud
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $nominas = $query->with('empleado', 'puesto')->get();

        // Si se solicita generar la planilla
        if ($request->filled('generar_planilla')) {
            return $this->generarPlanillaDesdeIndex($nominas, $request->fecha_inicio, $request->fecha_fin);
        }

        return view('nominas.index', compact('nominas'));
    }

    public function pdf(Request $request)
    {
        $nominas = Nomina::whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])->get();

        $planilla = $nominas->map(function($nomina) {
            return [
                'nomina_id' => $nomina->id,
                'apellidos' => $nomina->empleado->apellidos,
                'nombres' => $nomina->empleado->nombres,
                'sueldo_base' => ($nomina->tipo_pago == 'quincena') ? $nomina->puesto->salario_quincena : $nomina->puesto->salario_mes,
                'dias_trabajados' => $nomina->dias_trabajados,
                'horas_extras' => $nomina->horas_extras,
                'total_horas_extras' => $nomina->valor_hora_extra * $nomina->horas_extras,
                'bonificacion_incentivo' => $nomina->bonificacion_incentivo,
                'bonificacion_rendimiento' => $nomina->bonificacion_rendimiento,
                'cantidad_iggs' => $nomina->cantidad_iggs,
                'otras_deducciones' => $nomina->deducciones ?? 0, // Asegúrate de que esta columna exista en tu base de datos
                'pasajes_viaticos' => $nomina->pasajes_viaticos,
                'salario_liquido' => $nomina->salario_liquido,
            ];
        });

        $pdf = Pdf::loadView('nominas.pdf', compact('planilla', 'request'))->setPaper('a4', 'landscape');
        return $pdf->stream('planilla.pdf');
    }

    public function show($id)
    {
        $nomina = Nomina::with('empleado', 'puesto', 'deducciones')->findOrFail($id);
        return view('nominas.show', compact('nomina'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $deducciones = Deduccion::all();
        return view('nominas.create', compact('empleados', 'deducciones'));
    }

    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'tipo_pago' => 'required|in:quincena,mes',
            'horas_extras' => 'nullable|numeric',
            'valor_hora_extra' => 'nullable|numeric',
            'deducciones' => 'nullable|array',
            'deducciones.*' => 'exists:deducciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'bonificacion_incentivo' => 'nullable|numeric',
            'bonificacion_rendimiento' => 'nullable|numeric',
            'cantidad_iggs' => 'nullable|numeric',
            'pasajes_viaticos' => 'nullable|numeric',
            'dias_trabajados' => 'required|numeric|min:0',
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id);
        $puesto = $empleado->puesto;

        // Cálculo del salario base según tipo de pago
        $salario_base = ($request->tipo_pago == 'quincena') ? $puesto->salario_quincena : $puesto->salario_mes;

        $total_pago = $salario_base;

        // Agregar bonificaciones
        $total_pago += $request->bonificacion_incentivo ?? 0;
        $total_pago += $request->bonificacion_rendimiento ?? 0;

        // Agregar pago por horas extras
        if ($request->horas_extras && $request->valor_hora_extra) {
            $total_pago += $request->valor_hora_extra * $request->horas_extras;
        }

        // Calcular el IGSS (aplicando el porcentaje sobre el salario base)
        $iggs = 0;
        if ($request->filled('cantidad_iggs')) {
            $iggs = ($request->cantidad_iggs / 100) * $salario_base;
        }

        // Calcular el total de deducciones (excluyendo IGSS)
        $deducciones_totales = 0;
        if ($request->has('deducciones')) {
            foreach ($request->deducciones as $deduccion_id) {
                $deduccion = Deduccion::findOrFail($deduccion_id);
                if ($deduccion->es_porcentaje) {
                    $deducciones_totales += ($total_pago * ($deduccion->monto / 100));
                } else {
                    $deducciones_totales += $deduccion->monto;
                }
            }
        }

        // Agregar pasajes/viáticos
        $total_pago += $request->pasajes_viaticos ?? 0;

        // Calcular el salario neto
        $salario_neto = $total_pago - $deducciones_totales - $iggs;

        // Crear la nómina
        $nomina = Nomina::create([
            'empleado_id' => $request->empleado_id,
            'puesto_id' => $puesto->id,
            'tipo_pago' => $request->tipo_pago,
            'dias_trabajados' => $request->dias_trabajados,
            'horas_extras' => $request->horas_extras,
            'valor_hora_extra' => $request->valor_hora_extra,
            'total_pago' => $total_pago,
            'deducciones' => $deducciones_totales, // Sólo las deducciones, sin IGSS
            'salario_neto' => $salario_neto,
            'bonificacion_incentivo' => $request->bonificacion_incentivo,
            'bonificacion_rendimiento' => $request->bonificacion_rendimiento,
            'cantidad_iggs' => $iggs, // Se guarda IGSS aquí
            'pasajes_viaticos' => $request->pasajes_viaticos,
            'total_descuentos' => $iggs, // Exclusivo para IGSS
            'salario_liquido' => $salario_neto,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        if ($request->has('deducciones')) {
            $nomina->deducciones()->attach($request->deducciones);
        }

        return redirect()->route('nominas.index')->with('success', 'Nómina creada exitosamente.');
    }

    public function destroy($id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->delete();

        return redirect()->route('nominas.index')->with('success', 'Nómina eliminada exitosamente.');
    }

    protected function generarPlanillaDesdeIndex($nominas, $fechaInicio, $fechaFin)
{
    $planilla = $nominas->map(function($nomina) {
        return [
            'nomina_id' => $nomina->id,
            'apellidos' => $nomina->empleado->apellidos,
            'nombres' => $nomina->empleado->nombres,
            'sueldo_base' => ($nomina->tipo_pago == 'quincena') ? $nomina->puesto->salario_quincena : $nomina->puesto->salario_mes,
            'dias_trabajados' => $nomina->dias_trabajados,
            'horas_extras' => $nomina->horas_extras,
            'total_horas_extras' => $nomina->valor_hora_extra * $nomina->horas_extras,
            'bonificacion_incentivo' => $nomina->bonificacion_incentivo,
            'bonificacion_rendimiento' => $nomina->bonificacion_rendimiento,
            'cantidad_iggs' => $nomina->cantidad_iggs,
            'deducciones' => $nomina->deducciones ?? 0,
            'pasajes_viaticos' => $nomina->pasajes_viaticos,
            'salario_liquido' => $nomina->salario_liquido,
        ];
    });

    return view('nominas.planilla', compact('planilla', 'fechaInicio', 'fechaFin'));
}


public function voucher($id)
{
    set_time_limit(120); // Aumenta el límite de tiempo de ejecución a 120 segundos

    try {
        $nomina = Nomina::with('empleado')->findOrFail($id);

        // Puedes agregar más relaciones si lo necesitas
        $empleado = $nomina->empleado;
        $puesto = $empleado->puesto;

        $igs_descuento = $nomina->cantidad_iggs; // Asegúrate de que este campo está en la base de datos y en el modelo

        $pdf = PDF::loadView('nominas.voucher', compact('nomina', 'empleado', 'puesto', 'igs_descuento'));
        return $pdf->download('voucher_'.$nomina->id.'.pdf');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors('Error al generar el voucher: ' . $e->getMessage());
    }
}

}

