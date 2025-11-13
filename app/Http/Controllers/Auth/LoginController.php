<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (Gate::allows('ver-empleado')) {
            return route('empleados.index');
        } elseif (Gate::allows('ver-cargo')) {
            return route('cargos.index');
        } elseif (Gate::allows('ver-departamento')) {
            return route('departamentos.index');
        }elseif (Gate::allows('ver-marca')) {
            return route('marcas.index');
        }elseif (Gate::allows('ver-categoria')) {
            return route('categorias.index');    
        }elseif (Gate::allows('ver-equipo')) {
            return route('equipos.index');
        }elseif (Gate::allows('ver-accesesorio')) {
            return route('accesorios.index');
        }elseif (Gate::allows('ver-telefono')) {
            return route('celulares.index');
        }elseif (Gate::allows('ver-HistorialEquipo')) {
            return route('equiposHistorial.index');
        }elseif (Gate::allows('ver-HistorialAccesesorio')) {
            return route('accesesoriosHistorial.index');
        }elseif (Gate::allows('ver-HistorialTelefono')) {
            return route('telefonosHistorial.index');
        }elseif (Gate::allows('ver-memorando')) {
            return route('memorandos.index');
        }elseif (Gate::allows('ver-software')) {
            return route('softwares.index');
        }elseif (Gate::allows('ver-usuario')) {
            return route('users.index');
        }elseif (Gate::allows('ver-rol')) {
            return route('roles.index');
        }else {
            return route('/empleados.index');
        }
    }

}
