@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
    <div class="text-center mb-4">
        <h3 class="text-gray-800 fw-semibold">Acceso al Sistema Inventario TI</h3>
    </div>
@endsection

@section('auth_body')
    <form action="{{ route('login') }}" method="post" class="space-y-3">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label text-gray-700">Correo electrónico</label>
            <input type="email" name="email" class="form-control rounded-pill p-2" placeholder="nombre.apellido@impresistem.com" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-gray-700">Contraseña</label>
            <input type="password" name="password" class="form-control rounded-pill p-2" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm fw-semibold">
            <i class="fas fa-sign-in-alt me-2"></i> Ingresar
        </button>
    </form>
@endsection

@section('auth_footer')
    <div class="text-center mt-4">
        <a href="{{ route('password.request') }}" class="text-muted small">¿Olvidaste tu contraseña?</a>
    </div>
@endsection
