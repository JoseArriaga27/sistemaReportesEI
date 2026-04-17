@extends('layouts.app')
@section('page-title','Registro')
@section('content')
<div class="auth-wrap">
    <div class="auth-card" style="max-width:520px">
        <div class="auth-head">
            <div class="auth-logo"><i class="fa-solid fa-user-plus"></i></div>
            <h3>Crear cuenta</h3>
            <p>Completa tus datos para registrarte en el sistema</p>
        </div>
        <div class="auth-body">
            @include('partials.alerts')
            <form action="{{ route('registro.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label-custom">Nombre</label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Apellido paterno</label>
                        <input type="text" name="apellidoPaterno" class="form-control @error('apellidoPaterno') is-invalid @enderror" value="{{ old('apellidoPaterno') }}" required>
                        @error('apellidoPaterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Apellido materno <span style="color:var(--text-muted)">(opcional)</span></label>
                        <input type="text" name="apellidoMaterno" class="form-control" value="{{ old('apellidoMaterno') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Correo electrónico</label>
                        <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" value="{{ old('correoElectronico') }}" required>
                        @error('correoElectronico')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Teléfono</label>
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" required>
                        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Fecha de nacimiento</label>
                        <input type="date" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" value="{{ old('fechaNacimiento') }}" required>
                        @error('fechaNacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Contraseña</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label-custom">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary-custom w-100 justify-content-center mt-4" style="padding:11px">
                    <i class="fa-solid fa-user-check"></i> Crear cuenta
                </button>
            </form>
            <p style="text-align:center;font-size:13px;color:var(--text-muted);margin-top:20px">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color:var(--primary);font-weight:500;text-decoration:none">Inicia sesión</a>
            </p>
        </div>
    </div>
</div>
@endsection
