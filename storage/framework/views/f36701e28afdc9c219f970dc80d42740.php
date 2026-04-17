<?php $__env->startSection('page-title','Iniciar Sesión'); ?>
<?php $__env->startSection('content'); ?>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-head">
            <div class="auth-logo"><i class="fa-solid fa-chart-bar"></i></div>
            <h3>Bienvenido de nuevo</h3>
            <p>Ingresa tus credenciales para acceder al sistema</p>
        </div>
        <div class="auth-body">
            <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <form action="<?php echo e(route('login.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label-custom">Correo electrónico</label>
                    <input type="email" name="correoElectronico" class="form-control <?php $__errorArgs = ['correoElectronico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="tucorreo@ejemplo.com" value="<?php echo e(old('correoElectronico')); ?>" required>
                    <?php $__errorArgs = ['correoElectronico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary-custom w-100 justify-content-center" style="padding:11px">
                    <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
                </button>
            </form>
            <p style="text-align:center;font-size:13px;color:var(--text-muted);margin-top:20px">
                ¿No tienes cuenta?
                <a href="<?php echo e(route('registro')); ?>" style="color:var(--primary);font-weight:500;text-decoration:none">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/auth/login.blade.php ENDPATH**/ ?>