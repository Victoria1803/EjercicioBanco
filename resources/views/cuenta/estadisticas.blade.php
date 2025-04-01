@extends('layout')

@section('title', 'Estadísticas')

@section('stylesheets')
    @parent
@endsection

@section('content')
<div class="container">

<h1>Estadísticas</h1>
    <!-- Cuenta con Mayor Saldo -->
    <div class="card mb-4">
        <div class="card-header">
           <h2> Cuenta con saldo máximo </h2><br>
        </div>
        <div class="card-body">
            @if($cuentaMayorSaldo)
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Saldo (€)</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $cuentaMayorSaldo->codigo }}</td>
                            <td>{{ number_format($cuentaMayorSaldo->saldo, 2) }}</td>
                            <td>
                                {{ $cuentaMayorSaldo->cliente->nombre ?? 'N/A' }} 
                                {{ $cuentaMayorSaldo->cliente->apellidos ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>No hay datos disponibles para la cuenta con mayor saldo.</p>
            @endif
        </div>
    </div>


 <!-- Cuenta con Menor Saldo -->
 <div class="card mb-4">
        <div class="card-header">
            <h2>Cuenta con saldo mínimo</h2><br>
        </div>
        <div class="card-body">
            @if($cuentaMenorSaldo)
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Saldo (€)</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $cuentaMenorSaldo->codigo }}</td>
                            <td>{{ number_format($cuentaMenorSaldo->saldo, 2) }}</td>
                            <td>
                                {{ $cuentaMenorSaldo->cliente->nombre ?? 'N/A' }} 
                                {{ $cuentaMenorSaldo->cliente->apellidos ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>No hay datos disponibles para la cuenta con menor saldo.</p>
            @endif
        </div>
    </div>
</div>


<div class="card mb-4">
        <div class="card-header"> 
        <h2>Total cuentas </h2> <br>
             </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Saldo Promedio (€)</th>
                        <th>Cantidad Total de Cuentas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $saldoPromedio }}</td>
                        <td>{{ $cantidadCuentas }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
