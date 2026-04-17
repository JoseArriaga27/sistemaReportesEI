@extends('layouts.app')
@section('page-title','Editar Reporte')
@section('content')
<div class="page-header">
    <div><h2>Editar reporte</h2><p>#{{ $reporte->id }} — {{ Str::limit($reporte->titulo, 50) }}</p></div>
    <a href="{{ route('reportes.index') }}" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-pen me-2" style="color:var(--warning)"></i>Modificar reporte</h4>
    </div>
    <div class="form-body">
        @include('partials.alerts')
        <form action="{{ route('reportes.update', $reporte) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label-custom">Título *</label>
                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $reporte->titulo) }}" required>
                    @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label-custom">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $reporte->descripcion) }}</textarea>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-4">
                    <label class="form-label-custom">Estado *</label>
                    <select name="estado" class="form-select" required>
                        @foreach(['pendiente','en_revision','resuelto','rechazado'] as $e)
                        <option value="{{ $e }}" {{ old('estado',$reporte->estado)==$e?'selected':'' }}>{{ ucfirst(str_replace('_',' ',$e)) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-md-4">
                    <label class="form-label-custom">Prioridad *</label>
                    <select name="prioridad" class="form-select" required>
                        @foreach(['baja','media','alta','critica'] as $p)
                        <option value="{{ $p }}" {{ old('prioridad',$reporte->prioridad)==$p?'selected':'' }}>{{ ucfirst($p) }}</option>
                        @endforeach
                    </select>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-4">
                    <label class="form-label-custom">Fecha límite</label>
                    <input type="date" name="fecha_limite" class="form-control" value="{{ old('fecha_limite', $reporte->fecha_limite?->format('Y-m-d')) }}">
                </div>
                @endif
                <div class="col-md-6">
                    <label class="form-label-custom">Categoría</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Sin categoría</option>
                        @foreach($categorias as $c)<option value="{{ $c->id }}" {{ old('categoria_id',$reporte->categoria_id)==$c->id?'selected':'' }}>{{ $c->nombre }}</option>@endforeach
                    </select>
                </div>
                @if(session('usuarioAdmin'))
                <div class="col-md-6">
                    <label class="form-label-custom">Asignado a</label>
                    <select name="usuario_id" class="form-select">
                        <option value="">Sin asignar</option>
                        @foreach($usuarios as $u)<option value="{{ $u->id }}" {{ old('usuario_id',$reporte->usuario_id)==$u->id?'selected':'' }}>{{ $u->nombre }} {{ $u->apellidoPaterno }}</option>@endforeach
                    </select>
                </div>
                @endif
                <div class="col-12">
                    <label class="form-label-custom">Notas adicionales</label>
                    <textarea name="notas" class="form-control" rows="2">{{ old('notas', $reporte->notas) }}</textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="{{ route('reportes.index') }}" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-warning-sm" style="padding:9px 18px;font-size:13px"><i class="fa-solid fa-check"></i> Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
