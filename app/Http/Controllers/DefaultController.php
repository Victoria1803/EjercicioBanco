<?php 

/*
class DefaultController extends Controller
{ 
  
  function home() 
  { 
    return new Response('Hola que tal'); 
  } 
}
  */



namespace App\Http\Controllers;
use App\Models\Cuenta;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    function home() 
    { 
      return view('default.home');
    }

    function mostrarEstadisticas(Request $request){

      // Llama a los métodos estáticos del modelo
      $cuentaMayorSaldo = Cuenta::cuentaConMayorSaldo();
      $cuentaMenorSaldo = Cuenta::cuentaConMenorSaldo();
    
       // Obtener el saldo promedio de todas las cuentas y la cantidad total de cuentas. 
      // ESTO LO HACE DIRECTAMENTE EN EL METODO mostrarEstadisticas, SIN LLAMAR AL METODO ESTATICO
     // $saldoPromedio = Cuenta::avg('saldo');  // Promedio de los saldos
    // $cantidadCuentas = Cuenta::count();  // Número total de cuentas

    $saldoPromedio = Cuenta::obtenerSaldoPromedio();  // Llamamos al método estático para obtener el saldo promedio
    $cantidadCuentas = Cuenta::obtenerCantidadCuentas();  // Llamamos al método estático para contar las cuentas
    
    return view ('cuenta.estadisticas', [
         'cuentaMayorSaldo' => $cuentaMayorSaldo,
         'cuentaMenorSaldo' => $cuentaMenorSaldo, 
         'saldoPromedio' => number_format($saldoPromedio, 2),  // Redondeamos el promedio a 2 decimales
         'cantidadCuentas' => $cantidadCuentas,
    ]);
    
    }

}




?>