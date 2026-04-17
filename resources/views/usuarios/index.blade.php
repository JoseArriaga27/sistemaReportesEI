@extends('layouts.app')
@section('page-title','Usuarios')
@section('content')
<div class="page-header">
    <div>
        <h2>Usuarios del sistema</h2>
        <p>Gestión de cuentas y permisos</p>
    </div>
    @if(session('usuarioAdmin'))
    <a href="{{ route('usuarios.create') }}" class="btn-primary-custom">
        <i class="fa-solid fa-user-plus"></i> Nuevo usuario
    </a>
    @endif
</div>

<div class="card-modern">
    <div class="card-head">
        <h5><i class="fa-solid fa-users me-2" style="color:var(--primary)"></i>Lista de usuarios</h5>
        <span class="badge-pill badge-user">Total: {{ $usuarios->count() }}</span>
    </div>
    <div style="overflow-x:auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Nacimiento</th><th>Rol</th>
                    @if(session('usuarioAdmin'))<th style="text-align:center">Acciones</th>@endif
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr>
                    <td style="color:var(--text-muted);font-weight:600">{{ $u->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:32px;height:32px;border-radius:50%;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0">
                                {{ strtoupper(substr($u->nombre,0,1)) }}{{ strtoupper(substr($u->apellidoPaterno,0,1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500">{{ $u->nombre }} {{ $u->apellidoPaterno }} {{ $u->apellidoMaterno }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--text-muted)">{{ $u->correoElectronico }}</td>
                    <td>{{ $u->telefono }}</td>
                    <td>{{ \Carbon\Carbon::parse($u->fechaNacimiento)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge-pill {{ $u->es_admin ? 'badge-admin' : 'badge-user' }}">
                            {{ $u->es_admin ? 'Admin' : 'Usuario' }}
                        </span>
                    </td>
                    @if(session('usuarioAdmin'))
                    <td style="text-align:center">
                        <div style="display:flex;gap:6px;justify-content:center;align-items:center">
                            <a href="{{ route('usuarios.edit', $u) }}" class="btn-warning-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <!-- Botón enviar notificación (segundo correo) -->
                            <button onclick="abrirModalNotificacion({{ $u->id }}, '{{ addslashes($u->nombre . ' ' . $u->apellidoPaterno) }}')" class="btn-info-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </button>
                            <form method="POST" action="{{ route('usuarios.destroy', $u) }}" class="d-inline" onsubmit="return confirm('¿Eliminar a {{ $u->nombre }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-users"></i></div>
                        <p>No hay usuarios registrados</p>
                        @if(session('usuarioAdmin'))
                        <a href="{{ route('usuarios.create') }}" class="btn-primary-custom">Crear el primero</a>
                        @endif
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal segundo correo -->
<div id="modalNotificacion" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:999;align-items:center;justify-content:center">
    <div style="background:#fff;border-radius:14px;padding:28px;width:100%;max-width:440px;margin:20px">
        <h5 style="font-size:16px;font-weight:600;margin:0 0 6px">Enviar notificación</h5>
        <p style="font-size:13px;color:var(--text-muted);margin:0 0 18px">Enviando correo a: <strong id="nombreDestino"></strong></p>
        <form id="formNotificacion" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label-custom">Mensaje personalizado <span style="color:var(--text-muted)">(opcional)</span></label>
                <textarea name="mensaje" class="form-control" rows="3" placeholder="Escribe un mensaje para el usuario..."></textarea>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" onclick="cerrarModal()" class="btn-outline-custom">Cancelar</button>
                <button type="submit" class="btn-primary-custom"><i class="fa-solid fa-paper-plane"></i> Enviar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
function abrirModalNotificacion(id, nombre) {
    document.getElementById('nombreDestino').textContent = nombre;
    document.getElementById('formNotificacion').action = '/usuarios/' + id + '/notificar';
    document.getElementById('modalNotificacion').style.display = 'flex';
}
function cerrarModal() {
    document.getElementById('modalNotificacion').style.display = 'none';
}
</script>
@endpush
