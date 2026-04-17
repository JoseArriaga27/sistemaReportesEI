@extends('layouts.app')
@section('page-title','Nuevo Reporte')
@section('content')
<div class="page-header">
    <div><h2>Nuevo reporte</h2><p>Registra un nuevo reporte en el sistema</p></div>
    <a href="{{ route('reportes.index') }}" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-file-circle-plus me-2" style="color:var(--primary)"></i>Información del reporte</h4>
    </div>
    <div class="form-body">
        @include('partials.alerts')
        <form action="{{ route('reportes.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label-custom">Título *</label>
                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" placeholder="Describe brevemente el reporte..." required>
                    @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label-custom">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalla el problema o situación a reportar...">{{ old('descripcion') }}</textarea>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-4">
                    <label class="form-label-custom">Estado *</label>
                    <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                        <option value="pendiente" {{ old('estado','pendiente')=='pendiente'?'selected':'' }}>Pendiente</option>
                        <option value="en_revision" {{ old('estado')=='en_revision'?'selected':'' }}>En revisión</option>
                        <option value="resuelto" {{ old('estado')=='resuelto'?'selected':'' }}>Resuelto</option>
                        <option value="rechazado" {{ old('estado')=='rechazado'?'selected':'' }}>Rechazado</option>
                    </select>
                </div>
                @endif
                <div class="col-md-4">
                    <label class="form-label-custom">Prioridad *</label>
                    <select name="prioridad" class="form-select @error('prioridad') is-invalid @enderror" required>
                        <option value="baja" {{ old('prioridad')=='baja'?'selected':'' }}>Baja</option>
                        <option value="media" {{ old('prioridad','media')=='media'?'selected':'' }}>Media</option>
                        <option value="alta" {{ old('prioridad')=='alta'?'selected':'' }}>Alta</option>
                        <option value="critica" {{ old('prioridad')=='critica'?'selected':'' }}>Crítica</option>
                    </select>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-4">
                    <label class="form-label-custom">Fecha límite</label>
                    <input type="date" name="fecha_limite" class="form-control" value="{{ old('fecha_limite') }}">
                </div>
                @endif
                <div class="col-md-6">
                    <label class="form-label-custom">Categoría</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Sin categoría</option>
                        @foreach($categorias as $c)<option value="{{ $c->id }}" {{ old('categoria_id')==$c->id?'selected':'' }}>{{ $c->nombre }}</option>@endforeach
                    </select>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-6">
                    <label class="form-label-custom">Asignar a usuario</label>
                    <select name="usuario_id" class="form-select">
                        <option value="">Sin asignar</option>
                        @foreach($usuarios as $u)
                            <option value="{{ $u->id }}" {{ old('usuario_id')==$u->id?'selected':'' }}>
                                {{ $u->nombre }} {{ $u->apellidoPaterno }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-12">
                    <label class="form-label-custom">Notas adicionales</label>
                    <textarea name="notas" class="form-control" rows="2" placeholder="Observaciones, pasos para reproducir, etc.">{{ old('notas') }}</textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="{{ route('reportes.index') }}" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-primary-custom"><i class="fa-solid fa-check"></i> Crear reporte</button>
            </div>
        </form>
    </div>
</div>
@endsection
