<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DateTime;
use Illuminate\Support\Facades\Input;


class ClienteController extends Controller

{
    
    public function verClientes() {

       // $clientes = Cliente::all();
      //  return view('cliente.list' , ['clientes' => $clientes]);
     // Obtener todos los clientes con el número de cuentas asociadas

    $clientes = Cliente::withCount('cuentas')->get();

  return view('cliente.list', compact('clientes'));


  /*
  ✅ Usar withCount('cuentas') en el controlador para que Laravel haga la cuenta en la BD.
✅ En la vista Blade, usar {{ $cliente->cuentas_count }} para mostrar la cantidad de cuentas.
✅ Es más eficiente que contar los elementos de la colección con count() en PHP.

*/
    }

    function new(Request $request)

    {
      $cliente = new Cliente();

      if ($request->isMethod('post')) {    
        // recogemos los campos del formulario en un objeto cuenta

   // si venimos de hacer submit, aplicamos validaciones
        $validated = $request->validate([
          'dni' => 'required|unique:clientes,dni|max:9',
          'nombre' => 'required',
          'apellidos' => 'required',
          'fechaN' => [
          'required',
          'date',
          'before_or_equal:' . (new DateTime())->format('Y-m-d'), // Validar fecha de nacimiento
        ],
      ]);

      $cliente->dni = $request->dni;
      $cliente->nombre = $request->nombre;
      $cliente->apellidos= $request->apellidos;
      $cliente->fechaN= $request->fechaN;

      if($request->file('imagen')){
        $file = $request->file('imagen');
        $extension = $file->getClientOriginalExtension();
        $idAleatorio = uniqid();
        $filename = $cliente->nombre.'_'.$cliente->apellidos.'_'.$idAleatorio.'.'.$extension;
        //dd($filename);
        // guardamos en una variable $filename el nombre que pondremos al fichero
        $file->move(public_path('uploads/imagenes'), $filename);
        $cliente->imagen = $filename;
      }
    
    
        $cliente->save();

        return redirect()->route('cliente_list')->with('status', 'Nuevo cliente '.$cliente->nombre. ' ' . $cliente->apellidos . ' creada!');
      }
return view('cliente.new');

}

public function delete($id) 
{
    $cliente= Cliente::find($id);
    $cliente ->delete();

    return redirect()->route ('cliente_list')->with('status','Cliente' . $cliente ->id . 'eliminado correctamente!');
}


function edit(Request $request,$id) 
{  
  $cliente = Cliente::find($id);

  if ($request->isMethod('post')) {  
  
  
    $validator = Validator::make($request->all(), [
  
    'dni' => ['required',
                'max:9', 
                Rule::unique('clientes','dni')->ignore($cliente->id)],
    'nombre' => ['required'],
    'apellidos' => ['required'],
    'fechaN' => ['required'],
    'fechaN' => [
                'required',
                'date',
                'before_or_equal:' . (new DateTime())->format('Y-m-d'), // Validar fecha de nacimiento
            ],
        ]);

/*
if ($validator->fails()) {
  return redirect()
      ->back() // Redirige de vuelta al formulario
      ->withErrors($validator) // Envía los errores
      ->withInput(); // Mantén los datos ingresados por el usuario
}
      */

  $cliente->dni = $request->dni;
  $cliente->nombre = $request->nombre;
  $cliente->apellidos = $request->apellidos;
  $cliente->fechaN= $request->fechaN;
  

  if($request->file('imagen')){
    $file = $request->file('imagen');
    $extension = $file->getClientOriginalExtension();
    $idAleatorio = uniqid();
    $filename = $cliente->nombre.'_'.$cliente->apellidos.'_'.$idAleatorio.'.'.$extension;
    //dd($filename);
    // guardamos en una variable $filename el nombre que pondremos al fichero
    $file->move(public_path('uploads/imagenes'), $filename);
    $cliente->imagen = $filename;
  }


  $cliente->save();
  
  return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->id.' editada correctamente!');
}


return view('cliente.edit', ['cliente' => $cliente]);


}


}