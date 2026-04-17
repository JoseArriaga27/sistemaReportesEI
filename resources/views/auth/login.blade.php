@extends('layouts.app')
@section('page-title','Iniciar Sesión')
@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-head">
            <div class="auth-logo"><i class="fa-solid fa-chart-bar"></i></div>
            <h3>Bienvenido de nuevo</h3>
            <p>Ingresa tus credenciales para acceder al sistema</p>
        </div>
        <div class="auth-body">
            @include('partials.alerts')
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label-custom">Correo electrónico</label>
                    <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror"
                           placeholder="tucorreo@ejemplo.com" value="{{ old('correoElectronico') }}" required>
                    @error('correoElectronico')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary-custom w-100 justify-content-center" style="padding:11px">
                    <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
                </button>
            </form>
            <p style="text-align:center;font-size:13px;color:var(--text-muted);margin-top:20px">
                ¿No tienes cuenta?
                <a href="{{ route('registro') }}" style="color:var(--primary);font-weight:500;text-decoration:none">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection
