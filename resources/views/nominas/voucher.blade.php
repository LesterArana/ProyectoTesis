<!-- resources/views/nominas/voucher.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voucher de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            font-size: 14px;
        }

        .voucher-container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .voucher-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .voucher-header img {
            width: 100px;
            height: auto;
        }

        .voucher-details {
            margin-bottom: 20px;
        }

        .voucher-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .voucher-details th, .voucher-details td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .voucher-details th {
            background-color: #f2f2f2;
        }

        .voucher-signature {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="voucher-container">
        <div class="voucher-header">
            <img src="{{ public_path('images/Inserpro_logo.jpeg') }}" alt="Logo Inserpro">
            <h2>Voucher de Pago</h2>
        <p>Planilla del mes {{ \Carbon\Carbon::parse($nomina->fecha_inicio)->format('F Y') }} correspondiente al año {{ \Carbon\Carbon::parse($nomina->fecha_inicio)->year }}</p>
    </div>
    </div>
    

        <div class="voucher-details">
            <table>
                <tr>
                    <th>Nombre del Empleado:</th>
                    <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                </tr>
                <tr>
                    <th>Puesto:</th>
                    <td>{{ $puesto->nombre }}</td>
                </tr>
                <tr>
                    <th>Sueldo Base:</th>
                    <td>Q {{ number_format($nomina->total_pago, 2) }}</td>
                </tr>
                <tr>
                    <th>Días Trabajados:</th>
                    <td>{{ $nomina->dias_trabajados }}</td>
                </tr>
                <tr>
                    <th>Bonificación Incentivo:</th>
                    <td>Q {{ number_format($nomina->bonificacion_incentivo, 2) }}</td>
                </tr>
                <tr>
                    <th>Bonificación Rendimiento:</th>
                    <td>Q {{ number_format($nomina->bonificacion_rendimiento, 2) }}</td>
                </tr>
                <tr>
                    <th>IGSS</th>
                    <td>Q {{ number_format($igs_descuento, 2) }}</td>
                </tr>
                <tr>
                    <th>Otras Deducciones:</th>
                    <td>Q {{ number_format($nomina->deducciones, 2) }}</td>
                </tr>
                <tr>
                    <th>Salario Líquido:</th>
                    <td>Q {{ number_format($nomina->salario_liquido, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="voucher-signature">
            <p>Firma: ___________________________</p>
        </div>
    </div>
</body>
</html>
