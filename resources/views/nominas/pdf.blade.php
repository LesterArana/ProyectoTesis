<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla Generada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-size: 9px;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .text-danger {
            color: red;
        }
        .text-success {
            color: green;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 style="font-size: 12px;">Planilla Generada para el Período {{ $request->input('fecha_inicio') }} - {{ $request->input('fecha_fin') }}</h1>

    <table>
        <thead>
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
                <<td class="text-center text-danger">Q {{ number_format($empleado['otras_deducciones'], 2) }}</td>
                <td class="text-center">Q {{ number_format($empleado['pasajes_viaticos'], 2) }}</td>
                <td class="text-center font-weight-bold text-success">Q {{ number_format($empleado['salario_liquido'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right font-weight-bold">Totales:</td>
                <td class="text-success">Q {{ number_format($planilla->sum('total_horas_extras'), 2) }}</td>
                <td class="text-success">Q {{ number_format($planilla->sum('bonificacion_incentivo'), 2) }}</td>
                <td class="text-success">Q {{ number_format($planilla->sum('bonificacion_rendimiento'), 2) }}</td>
                <td class="text-danger">Q {{ number_format($planilla->sum('cantidad_iggs'), 2) }}</td>
                <td class="text-danger">Q {{ number_format($planilla->sum('otras_deducciones'), 2) }}</td>
                <td class="text-success">Q {{ number_format($planilla->sum('pasajes_viaticos'), 2) }}</td>
                <td class="text-success">Q {{ number_format($planilla->sum('salario_liquido'), 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
