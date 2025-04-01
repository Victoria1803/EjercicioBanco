@extends('layout')

@section('title', 'Nueva Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nueva Cliente</h1>
    <a href="{{ route('cliente_list') }}">&laquo; Volver</a>

    @if ($errors->any())
    <div style="color:red" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('cliente_new') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="dni">DNI</label>
                <input type="text" name="dni" />
            </div>
            <div>            
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
            </div>
            <div>            
                <label for="apellidos">apellidos</label>
                <input type="text" name="apellidos" />
            </div>
            <div>
                <label for="fechaN">Fecha N</label>
                <input type="date"  name="fechaN" value="{{date('Y-m-d')}}">
                </select>
            </div>
            <div>            
                <label for="imagen">Subir una imagen</label>
                <input type="file" name="imagen" />
            </div>
            <button type="submit">Crear Cliente</button>
        </form>
	</div>
@endsection