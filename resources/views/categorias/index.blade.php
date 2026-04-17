@extends('layouts.app')
@section('page-title','Categorías')
@section('content')
<div class="page-header">
    <div><h2>Categorías</h2><p>Organiza los reportes por categorías</p></div>
    <a href="{{ route('categorias.create') }}" class="btn-primary-custom"><i class="fa-solid fa-plus"></i> Nueva categoría</a>
</div>
<div class="card-modern">
    <div class="card-head">
        <h5><i class="fa-solid fa-tag me-2" style="color:var(--primary)"></i>Lista de categorías</h5>
        <span class="badge-pill badge-user">{{ $categorias->count() }} registradas</span>
    </div>
    <div style="overflow-x:auto">
        <table class="table-custom">
            <thead>
                <tr><th>Color</th><th>Nombre</th><th>Descripción</th><th>Reportes</th><th style="text-align:center">Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($categorias as $c)
                <tr>
                    <td>
                        <span class="color-swatch">
                            <span class="dot" style="background:{{ $c->color }};width:18px;height:18px"></span>
                            <code style="font-size:11px;color:var(--text-muted)">{{ $c->color }}</code>
                        </span>
                    </td>
                    <td><strong>{{ $c->nombre }}</strong></td>
                    <td style="color:var(--text-muted);max-width:260px">{{ $c->descripcion ?? '—' }}</td>
                    <td>
                        <span class="badge-pill badge-user">{{ $c->reportes_count }}</span>
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex;gap:6px;justify-content:center">
                            <a href="{{ route('categorias.edit', $c) }}" class="btn-warning-sm"><i class="fa-solid fa-pen"></i></a>
                            @if(session('usuarioAdmin'))
                            <form method="POST" action="{{ route('categorias.destroy', $c) }}" class="d-inline" onsubmit="return confirm('¿Eliminar categoría «{{ $c->nombre }}»?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-tags"></i></div>
                        <p>No hay categorías registradas</p>
                        <a href="{{ route('categorias.create') }}" class="btn-primary-custom">Crear la primera</a>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
