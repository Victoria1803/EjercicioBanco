@extends('layout')

@section('title', 'Listado de clientes')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de clientes</h1>
    <a href="{{ route('cliente_new') }}">+ Nueva cliente</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Dni</th><th>Nombre</th><th>Apellidos</th><th>Fecha Nacimiento</th><th>Imagen</th><th>Cantidad de cuentas</th><th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->dni }}</td><td>{{ $cliente->nombre }}</td><td>{{ $cliente->apellidos }}</td><td>{{ $cliente->fechaN->format('d-m-Y') }}</td>
                  
                <td> @isset($cliente->imagen)<img src="{{ asset('uploads/imagenes/'.$cliente->imagen)}}" alt="" width="50" height="50">
                    @endisset
                </td>
                <td style="text-align: center"> {{ $cliente->cuentas_count }} </td>
            @if (Auth::check())
                    <td>
                        <a href="{{ route('cliente_delete', ['id' => $cliente->id]) }}">Eliminar</a>
                    </td>
                    <td>
                        <a href="{{ route('cliente_edit', ['id' => $cliente->id]) }}">Editar</a>
                    </td>
            @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection