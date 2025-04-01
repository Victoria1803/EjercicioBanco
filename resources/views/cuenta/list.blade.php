@extends('layout')

@section('title', 'Listado de cuentas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de cuentas</h1>
    <a href="{{ route('cuenta_new') }}">+ Nueva cuenta</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif
        <div>
            <p>
                @isset($codigo) 
                <i> {{ $termino . '...' }} </i> <strong>{{ $codigo }}</strong> <br>
                <i> {{ $dinero . '...' }} </i><strong>{{ $saldo }}
                 @endisset
    
             </p>
    

     <a href="{{ route('cuenta_list')}}">Limpiar código</a>

    </div>

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->codigo }}</td><td>{{ $cuenta->saldo }}</td>
                    
                    <td>

                        @isset($cuenta->cliente)

                            {{ $cuenta->cliente->nombreApellidos()}}
                        
                        @else

                            {{'cuenta sin cliente'}}

                        @endisset
                    </td>
                    @if (Auth::check())
                    <td>
                        <a href="{{ route('cuenta_delete', ['id' => $cuenta->id]) }}">Eliminar</a>
                    </td>
                    <td>
                        <a href="{{ route('cuenta_edit', ['id' => $cuenta->id]) }}">Editar</a>
                    </td>
                @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('cuenta_filtro') }}" method="GET">
        @csrf <!-- Si usas POST, añade @csrf; no es necesario para GET -->
        <label for="buscaCodigo">Buscar por <b>código</b></label>
        <input type="text" id="buscaCodigo" name="buscaCodigo" required><br>
        <label for="saldom">Saldo <b>mínimo</b></label>
        <input type="text" id="saldom" name="saldom" required><br>
        <button type=submit name="filtrar" value="and">Filtro AND</button>
        <button type="submit" name="filtrar" value="or">Filtro OR</button> 
    </form>
    <br>
@endsection
