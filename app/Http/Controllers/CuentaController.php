<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CuentaController extends Controller
{
  function list()
  {
    //$cuentas = Cuenta::all();
    $cuentas = Cuenta::orderBy('saldo', 'desc')->get();

    return view('cuenta.list', ['cuentas' => $cuentas]);
  }

  function new(Request $request)
  {
    //cuando vengo de hacer submit, entra en el if"
    if ($request->isMethod('post')) {
      // recogemos los campos del formulario en un objeto cuenta

      $validated = $request->validate([
        'codigo' => 'required|unique:cuentas|max:10',
        'saldo' => 'required',
      ]);

      //justo antes de persistir, de ingresar los datos en la base de datos
      $cuenta = new Cuenta;
      $cuenta->codigo = $request->codigo;
      $cuenta->saldo = $request->saldo;
      $cuenta->cliente_id = $request->cliente_id;
      $cuenta->save();

      return redirect()->route('cuenta_list')->with('status', 'Nueva cuenta ' . $cuenta->codigo . ' creada correctamente!');
    }
    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $clientes = Cliente::all();

    return view('cuenta.new', ['clientes' => $clientes]);
  }

  function delete($id)
  {
    $cuenta = Cuenta::find($id);
    $cuenta->delete();

    return redirect()->route('cuenta_list')->with('status', 'Cuenta ' . $cuenta->codigo . ' eliminada correctamente!');
  }

  function edit(Request $request, $id)
  {
    $cuenta = Cuenta::find($id);

    //dd($request);
    if ($request->isMethod('post')) {


      // $validated = $request->validate([
      $validator = Validator::make($request->all(), [

        'codigo' => [
          'required',
          'max:10',
          Rule::unique('cuentas', 'codigo')->ignore($cuenta->id)
        ],
        'saldo' => ['required'],
      ]);

      if ($validator->fails()) {
        return redirect()
          ->back()
          ->withErrors($validator)
          ->withInput();
      }
      $cuenta->codigo = $request->codigo;
      $cuenta->saldo = $request->saldo;
      $cuenta->cliente_id = $request->cliente_id;
      $cuenta->save();

      return redirect()->route('cuenta_list')->with('status', 'Cuenta ' . $cuenta->codigo . ' editada correctamente!');
    }
    $clientes = Cliente::all();

    return view('cuenta.edit', ['cuenta' => $cuenta, 'clientes' => $clientes]);
  }

  function cuenta_filtro(Request $request){

//  dd($request->all());

//$saldom = $request->saldom ?? null; 
   
     if($request->filtrar=='and'){

      $cuentas = Cuenta::buscarCodigoYsaldo($request->buscaCodigo,$request->saldom);
      return view('cuenta.list', [
        'cuentas' => $cuentas, 
        'termino' => 'Se ha filtrado por código',
        'codigo' => $request->buscaCodigo, 
        'saldo' => $request->saldom,
        'dinero' => 'AND saldo minimo',
      ]);

  } else{

    $cuentas = Cuenta::buscarCodigoOSaldo($request->buscaCodigo,$request->saldom);
    return view('cuenta.list', [
      'cuentas' => $cuentas, 
      'termino' => 'Se ha filtrado por código',
      'codigo' =>$request->buscaCodigo, 
      'saldo'=>$request->saldom, 
      'dinero' => 'OR saldo minimo',
    ]);

  }

  }

function cuenta_ordenar(Request $request){

   $cuentas = Cuenta::orderBy('saldo','desc')->get();
   return view ('cuenta.list', [
        'cuentas' => $cuentas,
   ]);

}

  }




  //siempre que viene de formulario es un post, si no viene de formulario es un GET, viene de un link y le tengo que mandar un formulario

