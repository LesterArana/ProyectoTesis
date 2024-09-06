<?php

// app/Http/Controllers/DashboardController.php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Nomina;
use App\Models\Deduccion;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtén el conteo de empleados, nóminas y deducciones
        $totalEmpleados = Empleado::count();
        $totalNominas = Nomina::count();
        $totalDeducciones = Deduccion::count();

        // Retorna la vista del dashboard con los datos
        return view('dashboard.index', compact('totalEmpleados', 'totalNominas', 'totalDeducciones'));
    }
}

