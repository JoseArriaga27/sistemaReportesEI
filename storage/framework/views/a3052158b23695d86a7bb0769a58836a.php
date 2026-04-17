<?php $__env->startSection('page-title','Nueva Categoría'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div><h2>Nueva categoría</h2><p>Agrupa reportes bajo una misma etiqueta</p></div>
    <a href="<?php echo e(route('categorias.index')); ?>" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Volver</a>
</div>
<div class="form-card">
    <div class="form-head">
        <h4><i class="fa-solid fa-tag me-2" style="color:var(--primary)"></i>Datos de la categoría</h4>
    </div>
    <div class="form-body">
        <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <form action="<?php echo e(route('categorias.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label-custom">Nombre *</label>
                    <input type="text" name="nombre" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nombre')); ?>" required>
                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Color de etiqueta *</label>
                    <div style="display:flex;gap:8px;align-items:center">
                        <input type="color" name="color" id="colorPicker" class="form-control" value="<?php echo e(old('color','#4F46E5')); ?>" style="width:48px;height:42px;padding:2px;cursor:pointer">
                        <input type="text" id="colorText" class="form-control" value="<?php echo e(old('color','#4F46E5')); ?>" readonly style="font-family:monospace">
                    </div>
                    <?php $__errorArgs = ['color'];
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
                    <textarea name="descripcion" class="form-control" rows="2" placeholder="Describe el tipo de reportes que agrupa esta categoría..."><?php echo e(old('descripcion')); ?></textarea>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border)">
                <a href="<?php echo e(route('categorias.index')); ?>" class="btn-outline-custom">Cancelar</a>
                <button type="submit" class="btn-primary-custom"><i class="fa-solid fa-check"></i> Crear categoría</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('colorPicker').addEventListener('input',function(){
    document.getElementById('colorText').value=this.value;
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/categorias/create.blade.php ENDPATH**/ ?>