<?php $__env->startSection('page-title','Editar Reporte'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div><h2>Editar reporte</h2><p>#<?php echo e($reporte->id); ?> — <?php echo e(Str::limit($reporte->titulo, 50)); ?></p></div>
    <a href="<?php echo e(route('reportes.index')); ?>" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-pen me-2" style="color:var(--warning)"></i>Modificar reporte</h4>
    </div>
    <div class="form-body">
        <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <form action="<?php echo e(route('reportes.update', $reporte)); ?>" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label-custom">Título *</label>
                    <input type="text" name="titulo" class="form-control <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('titulo', $reporte->titulo)); ?>" required>
                    <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12">
                    <label class="form-label-custom">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"><?php echo e(old('descripcion', $reporte->descripcion)); ?></textarea>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Estado *</label>
                    <select name="estado" class="form-select" required>
                        <?php $__currentLoopData = ['pendiente','en_revision','resuelto','rechazado']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($e); ?>" <?php echo e(old('estado',$reporte->estado)==$e?'selected':''); ?>><?php echo e(ucfirst(str_replace('_',' ',$e))); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Prioridad *</label>
                    <select name="prioridad" class="form-select" required>
                        <?php $__currentLoopData = ['baja','media','alta','critica']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p); ?>" <?php echo e(old('prioridad',$reporte->prioridad)==$p?'selected':''); ?>><?php echo e(ucfirst($p)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Fecha límite</label>
                    <input type="date" name="fecha_limite" class="form-control" value="<?php echo e(old('fecha_limite', $reporte->fecha_limite?->format('Y-m-d'))); ?>">
                </div>
                <?php endif; ?>
                <div class="col-md-6">
                    <label class="form-label-custom">Categoría</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Sin categoría</option>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>" <?php echo e(old('categoria_id',$reporte->categoria_id)==$c->id?'selected':''); ?>><?php echo e($c->nombre); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-6">
                    <label class="form-label-custom">Asignado a</label>
                    <select name="usuario_id" class="form-select">
                        <option value="">Sin asignar</option>
                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($u->id); ?>" <?php echo e(old('usuario_id',$reporte->usuario_id)==$u->id?'selected':''); ?>><?php echo e($u->nombre); ?> <?php echo e($u->apellidoPaterno); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <label class="form-label-custom">Notas adicionales</label>
                    <textarea name="notas" class="form-control" rows="2"><?php echo e(old('notas', $reporte->notas)); ?></textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="<?php echo e(route('reportes.index')); ?>" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-warning-sm" style="padding:9px 18px;font-size:13px"><i class="fa-solid fa-check"></i> Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/reportes/edit.blade.php ENDPATH**/ ?>