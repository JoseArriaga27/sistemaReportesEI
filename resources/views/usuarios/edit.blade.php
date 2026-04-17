@extends('layouts.app')
@section('page-title','Editar Usuario')
@section('content')
<div class="page-header">
    <div>
        <h2>Editar usuario</h2>
        <p>Actualizar información de {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }}</p>
    </div>
    <a href="{{ route('usuarios.index') }}" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>

<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-pen me-2" style="color:var(--warning)"></i>Modificar datos</h4>
        <p>Deja la contraseña en blanco para no modificarla</p>
    </div>
    <div class="form-body">
        @include('partials.alerts')
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label-custom">Nombre *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $usuario->nombre) }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Apellido paterno *</label>
                    <input type="text" name="apellidoPaterno" class="form-control" value="{{ old('apellidoPaterno', $usuario->apellidoPaterno) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Apellido materno</label>
                    <input type="text" name="apellidoMaterno" class="form-control" value="{{ old('apellidoMaterno', $usuario->apellidoMaterno) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Correo electrónico *</label>
                    <input type="email" name="correoElectronico" class="form-control @error('correoElectronico') is-invalid @enderror" value="{{ old('correoElectronico', $usuario->correoElectronico) }}" required>
                    @error('correoElectronico')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Teléfono *</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $usuario->telefono) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Nueva contraseña <span style="color:var(--text-muted)">(opcional)</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Fecha de nacimiento *</label>
                    <input type="date" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento', $usuario->fechaNacimiento) }}" required>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-12">
                    <div style="background:var(--primary-light);border:1px solid #C7D2FE;border-radius:8px;padding:12px 16px;display:flex;align-items:center;gap:12px">
                        <input type="checkbox" name="es_admin" id="es_admin" value="1" {{ $usuario->es_admin ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary)">
                        <label for="es_admin" style="font-size:13.5px;font-weight:500;color:var(--primary-dark);cursor:pointer;margin:0">
                            <i class="fa-solid fa-shield-halved me-1"></i> Permisos de administrador
                        </label>
                    </div>
                </div>
                @endif
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="{{ route('usuarios.index') }}" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-warning-sm" style="padding:9px 18px;font-size:13px"><i class="fa-solid fa-check"></i> Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
