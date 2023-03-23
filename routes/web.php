<?php

use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('empleados/{id}/pdf',  [App\Http\Controllers\EmpleadoController::class, 'pdf' ])->name('empleados.pdf');
Route::get('equipos/{id}/pdf',  [App\Http\Controllers\CpuEquipoController::class, 'pdf' ])->name('equipos.pdf');
Route::get('accesorios/{id}/pdf',  [App\Http\Controllers\AccesorioController::class, 'pdf' ])->name('accesorios.pdf');



Route::resource('cargos', App\Http\Controllers\CargoController::class)->middleware('auth');
Route::resource('departamentos', App\Http\Controllers\DepartamentoController::class)->middleware('auth');
Route::resource('empleados', App\Http\Controllers\EmpleadoController::class)->middleware('auth');
Route::resource('marcas', App\Http\Controllers\MarcaController::class)->middleware('auth');
Route::resource('equipos', App\Http\Controllers\CpuEquipoController::class)->middleware('auth');
Route::resource('accesorios', App\Http\Controllers\AccesorioController::class)->middleware('auth');
Route::resource('celulares', App\Http\Controllers\TelefonoController::class)->middleware('auth');
Route::resource('softwares', App\Http\Controllers\SoftwareController::class)->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
