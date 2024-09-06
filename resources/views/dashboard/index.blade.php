<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <!-- Tarjeta de Total Empleados -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalEmpleados }}</h3>
                    <p>Total de Empleados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('empleados.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Total Nóminas -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalNominas }}</h3>
                    <p>Total de Nóminas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <a href="{{ route('nominas.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Tarjeta de Total Deducciones -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalDeducciones }}</h3>
                    <p>Total de Deducciones</p>
                </div>
                <div class="icon">
                    <i class="fas fa-minus-circle"></i>
                </div>
                <a href="{{ route('deducciones.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="row mt-4">
        <div class="col-md-12">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Incluir la librería Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Empleados', 'Nóminas', 'Deducciones'],
        datasets: [{
            label: '# de Registros',
            data: [{{ $totalEmpleados }}, {{ $totalNominas }}, {{ $totalDeducciones }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
