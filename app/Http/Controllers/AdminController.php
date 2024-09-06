<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Nomina;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $totalEmpleados = Empleado::count();
    $totalNominas = Nomina::count();
    $totalUsuarios = User::count();
   

    return view('admin.index', compact('totalEmpleados', 'totalNominas', 'totalUsuarios'));
    }
}
