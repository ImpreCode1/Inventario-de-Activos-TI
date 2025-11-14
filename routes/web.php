<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('empleados/{id}/pdf', [App\Http\Controllers\EmpleadoController::class, 'pdf'])->name('empleados.pdf')->middleware('auth');
Route::get('empleados/{id}/activos', [App\Http\Controllers\EmpleadoController::class, 'activos'])->name('empleados.activos')->middleware('auth');
Route::get('equipos/{id}/pdf', [App\Http\Controllers\CpuEquipoController::class, 'pdf'])->name('equipos.pdf')->middleware('auth');
Route::get('accesorios/{id}/pdf', [App\Http\Controllers\AccesorioController::class, 'pdf'])->name('accesorios.pdf')->middleware('auth');
Route::get('celulares/{id}/pdf', [App\Http\Controllers\TelefonoController::class, 'pdf'])->name('celulares.pdf')->middleware('auth');
Route::get('celulares/{id}/numero', [App\Http\Controllers\TelefonoController::class, 'numero'])->name('celulares.numero')->middleware('auth');
Route::get('softwares/{id}/pdf', [App\Http\Controllers\SoftwareController::class, 'pdf'])->name('softwares.pdf')->middleware('auth');
Route::get('memorandos/{id_memorando}-{id_empleado}/pdf', [App\Http\Controllers\MemorandoController::class, 'pdf'])->name('memorandos.pdf')->middleware('auth');
Route::put('destinatarios/{id}', [App\Http\Controllers\CpuEquipoController::class, 'updateDestinatario'])->name('destinatarios.update')->middleware('auth');
Route::put('encargados/{id}', [App\Http\Controllers\MemorandoController::class, 'updateEncargado'])->name('encargado.update')->middleware('auth');

Route::get('cargos/lista', [App\Http\Controllers\CargoController::class, 'datos'])->name('cargos.lista')->middleware('auth');
Route::get('departamentos/lista', [App\Http\Controllers\DepartamentoController::class, 'departamentos'])->name('departamentos.lista')->middleware('auth');
Route::get('marcas/lista', [App\Http\Controllers\MarcaController::class, 'marcas'])->name('marcas.lista')->middleware('auth');
Route::get('categorias/lista', [App\Http\Controllers\CategoriaController::class, 'categorias'])->name('categorias.lista')->middleware('auth');
Route::get('empleados/lista', [App\Http\Controllers\EmpleadoController::class, 'empleados'])->name('empleados.lista')->middleware('auth');
Route::get('equipos/lista', [App\Http\Controllers\CpuEquipoController::class, 'equipos'])->name('equipos.lista');
Route::get('accesesorios/lista', [App\Http\Controllers\AccesorioController::class, 'accesesorios'])->name('accesesorios.lista')->middleware('auth');
Route::get('celulares/lista', [App\Http\Controllers\TelefonoController::class, 'celulares'])->name('celulares.lista')->middleware('auth');
Route::get('historialequipos/lista', [App\Http\Controllers\HistorialEquipoController::class, 'historialEquipos'])->name('historialequipos.lista')->middleware('auth');
Route::get('accesesorioshistorial/lista', [App\Http\Controllers\HistorialAccesorioController::class, 'historialaccesesorio'])->name('accesesorioshistorial.lista')->middleware('auth');
Route::get('historialtelefonos/lista', [App\Http\Controllers\HistorialTelefonoController::class, 'historialTelefonos'])->name('historialtelefonos.lista')->middleware('auth');
Route::get('softwares/lista', [App\Http\Controllers\SoftwareController::class, 'softwares'])->name('softwares.lista')->middleware('auth');
Route::get('memorandos/lista', [App\Http\Controllers\MemorandoController::class, 'memorandos'])->name('memorandos.lista')->middleware('auth');
Route::get('prestamos/lista', [App\Http\Controllers\PrestamoController::class, 'prestamos'])->name('prestamos.lista')->middleware('auth');

Route::post('prestamos/{prestamo}/devolver', [App\Http\Controllers\PrestamoController::class, 'devolver'])->name('prestamos.devolver');

Route::resource('cargos', App\Http\Controllers\CargoController::class)->middleware('auth');
Route::resource('departamentos', App\Http\Controllers\DepartamentoController::class)->middleware('auth');
Route::resource('empleados', App\Http\Controllers\EmpleadoController::class)->middleware('auth');
Route::resource('marcas', App\Http\Controllers\MarcaController::class)->middleware('auth');
Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('equipos', App\Http\Controllers\CpuEquipoController::class)->middleware('auth');
Route::resource('accesorios', App\Http\Controllers\AccesorioController::class)->middleware('auth');
Route::resource('celulares', App\Http\Controllers\TelefonoController::class)->middleware('auth');
Route::resource('softwares', App\Http\Controllers\SoftwareController::class)->middleware('auth');
Route::resource('equiposHistorial', App\Http\Controllers\HistorialEquipoController::class)->middleware('auth');
Route::resource('accesesoriosHistorial', App\Http\Controllers\HistorialAccesorioController::class)->middleware('auth');
Route::resource('telefonosHistorial', App\Http\Controllers\HistorialTelefonoController::class)->middleware('auth');
Route::resource('memorandos', App\Http\Controllers\MemorandoController::class)->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('roles', App\Http\Controllers\RolController::class)->middleware('auth');
Route::resource('prestamos', App\Http\Controllers\PrestamoController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
