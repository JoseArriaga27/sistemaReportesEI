<?php $__env->startSection('page-title','Nuevo Reporte'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div><h2>Nuevo reporte</h2><p>Registra un nuevo reporte en el sistema</p></div>
    <a href="<?php echo e(route('reportes.index')); ?>" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-file-circle-plus me-2" style="color:var(--primary)"></i>Información del reporte</h4>
    </div>
    <div class="form-body">
        <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <form action="<?php echo e(route('reportes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('titulo')); ?>" placeholder="Describe brevemente el reporte..." required>
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
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalla el problema o situación a reportar..."><?php echo e(old('descripcion')); ?></textarea>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Estado *</label>
                    <select name="estado" class="form-select <?php $__errorArgs = ['estado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="pendiente" <?php echo e(old('estado','pendiente')=='pendiente'?'selected':''); ?>>Pendiente</option>
                        <option value="en_revision" <?php echo e(old('estado')=='en_revision'?'selected':''); ?>>En revisión</option>
                        <option value="resuelto" <?php echo e(old('estado')=='resuelto'?'selected':''); ?>>Resuelto</option>
                        <option value="rechazado" <?php echo e(old('estado')=='rechazado'?'selected':''); ?>>Rechazado</option>
                    </select>
                </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Prioridad *</label>
                    <select name="prioridad" class="form-select <?php $__errorArgs = ['prioridad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="baja" <?php echo e(old('prioridad')=='baja'?'selected':''); ?>>Baja</option>
                        <option value="media" <?php echo e(old('prioridad','media')=='media'?'selected':''); ?>>Media</option>
                        <option value="alta" <?php echo e(old('prioridad')=='alta'?'selected':''); ?>>Alta</option>
                        <option value="critica" <?php echo e(old('prioridad')=='critica'?'selected':''); ?>>Crítica</option>
                    </select>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-4">
                    <label class="form-label-custom">Fecha límite</label>
                    <input type="date" name="fecha_limite" class="form-control" value="<?php echo e(old('fecha_limite')); ?>">
                </div>
                <?php endif; ?>
                <div class="col-md-6">
                    <label class="form-label-custom">Categoría</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Sin categoría</option>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>" <?php echo e(old('categoria_id')==$c->id?'selected':''); ?>><?php echo e($c->nombre); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php if(session('usuarioAdmin')): ?>
                <div class="col-md-6">
                    <label class="form-label-custom">Asignar a usuario</label>
                    <select name="usuario_id" class="form-select">
                        <option value="">Sin asignar</option>
                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($u->id); ?>" <?php echo e(old('usuario_id')==$u->id?'selected':''); ?>>
                                <?php echo e($u->nombre); ?> <?php echo e($u->apellidoPaterno); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <label class="form-label-custom">Notas adicionales</label>
                    <textarea name="notas" class="form-control" rows="2" placeholder="Observaciones, pasos para reproducir, etc."><?php echo e(old('notas')); ?></textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="<?php echo e(route('reportes.index')); ?>" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-primary-custom"><i class="fa-solid fa-check"></i> Crear reporte</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/reportes/create.blade.php ENDPATH**/ ?>