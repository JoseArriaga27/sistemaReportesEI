<?php if(session('mensajeExito')): ?>
<div class="alert-modern success">
    <span class="a-icon"><i class="fa-solid fa-circle-check"></i></span>
    <span><?php echo e(session('mensajeExito')); ?></span>
    <button class="a-close">&times;</button>
</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="alert-modern error">
    <span class="a-icon"><i class="fa-solid fa-circle-xmark"></i></span>
    <span><?php echo e(session('error')); ?></span>
    <button class="a-close">&times;</button>
</div>
<?php endif; ?>
<?php if(session('warning')): ?>
<div class="alert-modern warning">
    <span class="a-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
    <span><?php echo e(session('warning')); ?></span>
    <button class="a-close">&times;</button>
</div>
<?php endif; ?>
<?php if(session('info')): ?>
<div class="alert-modern info">
    <span class="a-icon"><i class="fa-solid fa-circle-info"></i></span>
    <span><?php echo e(session('info')); ?></span>
    <button class="a-close">&times;</button>
</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="alert-modern error">
    <span class="a-icon"><i class="fa-solid fa-circle-xmark"></i></span>
    <div>
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-1 ps-3">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px"><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <button class="a-close">&times;</button>
</div>
<?php endif; ?>
<?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/partials/alerts.blade.php ENDPATH**/ ?>