<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cliente;

class Cuenta extends Model
{
    public function cliente(): BelongsTo 
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
/*
    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'cliente_id'); // cliente_id es la clave foránea
}
*/
    public static function buscarCodigo($codigo) 
    {
        $cuentas = Cuenta::where('codigo','like', '%'.$codigo.'%')->get();
   
    return $cuentas;


}

public static function buscarCodigoYSaldo($codigo, $saldo){

    $cuentas = Cuenta::where('codigo','like', '%'.$codigo.'%')
                       ->where('saldo','>',$saldo)
                       ->get();

    return $cuentas;

}

public static function buscarCodigoOSaldo($codigo, $saldo){

    $cuentas = Cuenta::where('codigo','like', '%'.$codigo.'%')
                      ->orWhere('saldo','>',$saldo)
                      ->get();

    return $cuentas;

}

public static function cuentaConMayorSaldo(){

    $cuentas = Cuenta::orderBy('saldo', 'desc')->first();

    return $cuentas;
}


public static function cuentaConMenorSaldo()
{
    return self::orderBy('saldo', 'asc')->first(); // Menor saldo
}


public static function obtenerSaldoPromedio()
{
    // Calcula el saldo promedio de todas las cuentas
    return self::avg('saldo');  // Devuelve el promedio de la columna 'saldo'
}

public static function obtenerCantidadCuentas()
{
    // Cuenta el total de registros en la tabla 'cuentas'
    return self::count();  // Devuelve el número total de cuentas
}


}