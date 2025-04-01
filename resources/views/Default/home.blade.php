@extends('layout')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div>
      <img src="{{ asset ('img/logo.jpg') }}" alt="">
      <h2>UD9 Pt1</h2>
      <hr>
      <h3>Práctica para iniciarse en los conceptos básicos de Laravel</h3>
    </div>
@endsection