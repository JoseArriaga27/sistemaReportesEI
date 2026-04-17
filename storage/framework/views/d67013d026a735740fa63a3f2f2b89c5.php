<?php $__env->startSection('page-title','Usuarios'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h2>Usuarios del sistema</h2>
        <p>Gestión de cuentas y permisos</p>
    </div>
    <?php if(session('usuarioAdmin')): ?>
    <a href="<?php echo e(route('usuarios.create')); ?>" class="btn-primary-custom">
        <i class="fa-solid fa-user-plus"></i> Nuevo usuario
    </a>
    <?php endif; ?>
</div>

<div class="card-modern">
    <div class="card-head">
        <h5><i class="fa-solid fa-users me-2" style="color:var(--primary)"></i>Lista de usuarios</h5>
        <span class="badge-pill badge-user">Total: <?php echo e($usuarios->count()); ?></span>
    </div>
    <div style="overflow-x:auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Nacimiento</th><th>Rol</th>
                    <?php if(session('usuarioAdmin')): ?><th style="text-align:center">Acciones</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--text-muted);font-weight:600"><?php echo e($u->id); ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:32px;height:32px;border-radius:50%;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0">
                                <?php echo e(strtoupper(substr($u->nombre,0,1))); ?><?php echo e(strtoupper(substr($u->apellidoPaterno,0,1))); ?>

                            </div>
                            <div>
                                <div style="font-weight:500"><?php echo e($u->nombre); ?> <?php echo e($u->apellidoPaterno); ?> <?php echo e($u->apellidoMaterno); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--text-muted)"><?php echo e($u->correoElectronico); ?></td>
                    <td><?php echo e($u->telefono); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($u->fechaNacimiento)->format('d/m/Y')); ?></td>
                    <td>
                        <span class="badge-pill <?php echo e($u->es_admin ? 'badge-admin' : 'badge-user'); ?>">
                            <?php echo e($u->es_admin ? 'Admin' : 'Usuario'); ?>

                        </span>
                    </td>
                    <?php if(session('usuarioAdmin')): ?>
                    <td style="text-align:center">
                        <div style="display:flex;gap:6px;justify-content:center;align-items:center">
                            <a href="<?php echo e(route('usuarios.edit', $u)); ?>" class="btn-warning-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <!-- Botón enviar notificación (segundo correo) -->
                            <button onclick="abrirModalNotificacion(<?php echo e($u->id); ?>, '<?php echo e(addslashes($u->nombre . ' ' . $u->apellidoPaterno)); ?>')" class="btn-info-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </button>
                            <form method="POST" action="<?php echo e(route('usuarios.destroy', $u)); ?>" class="d-inline" onsubmit="return confirm('¿Eliminar a <?php echo e($u->nombre); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-danger-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-users"></i></div>
                        <p>No hay usuarios registrados</p>
                        <?php if(session('usuarioAdmin')): ?>
                        <a href="<?php echo e(route('usuarios.create')); ?>" class="btn-primary-custom">Crear el primero</a>
                        <?php endif; ?>
                    </div>
                </td></tr>
                <?php endif; ?>
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
            <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/usuarios/index.blade.php ENDPATH**/ ?>