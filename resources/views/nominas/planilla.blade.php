@extends('layouts.index')

@section('content')
<div class="container">
    <h2 class="mt-4">Planilla Generada para el Período {{ request('fecha_inicio') }} - {{ request('fecha_fin') }}</h2>

    @if($planilla->isEmpty())
        <p>No se encontraron registros para este período.</p>
    @else
    <table class="table table-bordered table-striped mt-4">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">#</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th class="text-center">Sueldo Base</th>
                <th class="text-center">Días Trabajados</th>
                <th class="text-center">Horas Extras</th>
                <th class="text-center">Total Horas Extras</th>
                <th class="text-center">Bonificación Incentivo</th>
                <th class="text-center">Bonificación Rendimiento</th>
                <th class="text-center text-danger">Cantidad IGSS</th>
                <th class="text-center text-danger">Otras Deducciones</th>
                <th class="text-center">Pasajes o Viáticos</th>
                <th class="text-center text-success">Salario Líquido</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planilla as $index => $empleado)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $empleado['apellidos'] }}</td>
                <td>{{ $empleado['nombres'] }}</td>
                <td class="text-center">Q {{ number_format($empleado['sueldo_base'], 2) }}</td>
                <td class="text-center">{{ $empleado['dias_trabajados'] }}</td>
                <td class="text-center">{{ $empleado['horas_extras'] }}</td>
                <td class="text-center text-success">Q {{ number_format($empleado['total_horas_extras'], 2) }}</td>
                <td class="text-center text-success">Q {{ number_format($empleado['bonificacion_incentivo'], 2) }}</td>
                <td class="text-center text-success">Q {{ number_format($empleado['bonificacion_rendimiento'], 2) }}</td>
                <td class="text-center text-danger">Q {{ number_format($empleado['cantidad_iggs'], 2) }}</td>
                <td class="text-center text-danger">Q {{ number_format($empleado['deducciones'], 2) }}</td>
                <td class="text-center">Q {{ number_format($empleado['pasajes_viaticos'], 2) }}</td>
                <td class="text-center font-weight-bold text-success">Q {{ number_format($empleado['salario_liquido'], 2) }}</td>
                <td class="text-center">
                    <a href="{{ route('nominas.voucher', ['id' => $empleado['nomina_id']]) }}" class="btn btn-sm btn-primary mb-2">Generar Voucher</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right font-weight-bold">Totales:</td>
                <td class="text-center text-success">Q {{ number_format($planilla->sum('bonificacion_incentivo'), 2) }}</td>
                <td class="text-center text-success">Q {{ number_format($planilla->sum('bonificacion_rendimiento'), 2) }}</td>
                <td class="text-center text-danger">Q {{ number_format($planilla->sum('cantidad_iggs'), 2) }}</td>
                <td class="text-center text-danger">
                    Q {{ number_format($empleado['deducciones'] ?? 0, 2) }}
                </td>
                
                <td class="text-center">Q {{ number_format($planilla->sum('pasajes_viaticos'), 2) }}</td>
                <td class="text-center text-success font-weight-bold">Q {{ number_format($planilla->sum('salario_liquido'), 2) }}</td>
                <td class="text-center"></td> <!-- Espacio vacío para alineación de los totales -->
            </tr>
        </tfoot>
    </table>
    @endif

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('nominas.pdf', ['fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}" class="btn btn-secondary mr-2">Generar PDF</a>
        <a href="{{ route('nominas.index') }}" class="btn btn-primary">Volver al Listado de Nóminas</a>
    </div>
</div>
@endsection
