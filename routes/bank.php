<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;

/*
Route::get('/', function () {
    return view('welcome');
})
*/    


Route::get('/', [DefaultController::class, 'home'])->name('home');

Route::get('/estadisticas', [DefaultController::class, 'mostrarEstadisticas'])->name('estadisticas_list');

//// CUENTAS

Route::get('/cuenta/list', [CuentaController::class, 'list'])->name('cuenta_list');

Route::match(['get', 'post'], '/cuenta/new', [CuentaController::class, 'new'])->name('cuenta_new')->middleware('auth');

Route::get('/cuenta/delete/{id}', [CuentaController::class, 'delete'])->name('cuenta_delete')->middleware('auth');

Route::match(['get', 'post'], '/cuenta/edit/{id}', [CuentaController::class, 'edit'])->name('cuenta_edit')->middleware('auth');

Route::get('/cuenta/cuenta_filtro', [CuentaController::class, 'cuenta_filtro'])->name('cuenta_filtro');


//--------------------------------------------------------------------------------------------------
Route::get('/cliente/list', [ClienteController::class, 'verClientes'])->name('cliente_list');

Route::get('/cliente/delete/{id}', [ClienteController::class, 'delete'])->name('cliente_delete')->middleware('auth');

Route::match(['get', 'post'], '/cliente/new', [ClienteController::class, 'new'])->name('cliente_new')->middleware('auth');

Route::match(['get', 'post'], '/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente_edit')->middleware('auth');

?>