<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Estadísticas</h1>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Total de cuentas:</strong> {{ $totalCuentas }}
            </li>
            <li class="list-group-item">
                <strong>Cuenta con mayor saldo:</strong> 
                {{ $cuentaMayorSaldo->id ?? 'No disponible' }} - ${{ number_format($cuentaMayorSaldo->saldo ?? 0, 2) }}
            </li>
            <li class="list-group-item">
                <strong>Cuenta con menor saldo:</strong> 
                {{ $cuentaMenorSaldo->id ?? 'No disponible' }} - ${{ number_format($cuentaMenorSaldo->saldo ?? 0, 2) }}
            </li>
            <li class="list-group-item">
                <strong>Promedio de saldo total:</strong> ${{ number_format($promedioSaldo ?? 0, 2) }}
            </li>
        </ul>
    </div>
</body>
</html>