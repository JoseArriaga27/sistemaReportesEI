<?php $__env->startSection('page-title','Categorías'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div><h2>Categorías</h2><p>Organiza los reportes por categorías</p></div>
    <a href="<?php echo e(route('categorias.create')); ?>" class="btn-primary-custom"><i class="fa-solid fa-plus"></i> Nueva categoría</a>
</div>
<div class="card-modern">
    <div class="card-head">
        <h5><i class="fa-solid fa-tag me-2" style="color:var(--primary)"></i>Lista de categorías</h5>
        <span class="badge-pill badge-user"><?php echo e($categorias->count()); ?> registradas</span>
    </div>
    <div style="overflow-x:auto">
        <table class="table-custom">
            <thead>
                <tr><th>Color</th><th>Nombre</th><th>Descripción</th><th>Reportes</th><th style="text-align:center">Acciones</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <span class="color-swatch">
                            <span class="dot" style="background:<?php echo e($c->color); ?>;width:18px;height:18px"></span>
                            <code style="font-size:11px;color:var(--text-muted)"><?php echo e($c->color); ?></code>
                        </span>
                    </td>
                    <td><strong><?php echo e($c->nombre); ?></strong></td>
                    <td style="color:var(--text-muted);max-width:260px"><?php echo e($c->descripcion ?? '—'); ?></td>
                    <td>
                        <span class="badge-pill badge-user"><?php echo e($c->reportes_count); ?></span>
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex;gap:6px;justify-content:center">
                            <a href="<?php echo e(route('categorias.edit', $c)); ?>" class="btn-warning-sm"><i class="fa-solid fa-pen"></i></a>
                            <?php if(session('usuarioAdmin')): ?>
                            <form method="POST" action="<?php echo e(route('categorias.destroy', $c)); ?>" class="d-inline" onsubmit="return confirm('¿Eliminar categoría «<?php echo e($c->nombre); ?>»?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-danger-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-tags"></i></div>
                        <p>No hay categorías registradas</p>
                        <a href="<?php echo e(route('categorias.create')); ?>" class="btn-primary-custom">Crear la primera</a>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/categorias/index.blade.php ENDPATH**/ ?>