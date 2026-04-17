<?php $__env->startSection('page-title','Reportes'); ?>
<?php $__env->startSection('content'); ?>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#EEF2FF"><i class="fa-solid fa-file-lines" style="color:var(--primary)"></i></div>
            <div><div class="stat-val"><?php echo e($stats['total']); ?></div><div class="stat-lbl">Total reportes</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FEF3C7"><i class="fa-solid fa-clock" style="color:#D97706"></i></div>
            <div><div class="stat-val"><?php echo e($stats['pendientes']); ?></div><div class="stat-lbl">Pendientes</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#DBEAFE"><i class="fa-solid fa-magnifying-glass" style="color:var(--info)"></i></div>
            <div><div class="stat-val"><?php echo e($stats['en_revision']); ?></div><div class="stat-lbl">En revisión</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#D1FAE5"><i class="fa-solid fa-circle-check" style="color:var(--success)"></i></div>
            <div><div class="stat-val"><?php echo e($stats['resueltos']); ?></div><div class="stat-lbl">Resueltos</div></div>
        </div>
    </div>
</div>

<!-- Clima API widget -->
<div id="clima-box" style="background:linear-gradient(135deg,#EEF2FF,#E0E7FF);border:1px solid #C7D2FE;border-radius:12px;padding:16px 20px;margin-bottom:24px">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
        <i class="fa-solid fa-cloud-sun" style="color:var(--primary);font-size:18px"></i>
        <span style="font-size:13px;font-weight:600;color:var(--primary-dark)">Clima actual (Cuernavaca) — API Open-Meteo</span>
        <span id="clima-loading" style="font-size:12px;color:var(--text-muted)">Cargando...</span>
    </div>
    <div id="clima-content" style="display:none">
        <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
            <div>
                <div id="clima-temp" style="font-size:32px;font-weight:700;color:#3730A3"></div>
                <div id="clima-cond" style="font-size:13px;color:#4338CA"></div>
            </div>
            <div style="display:flex;gap:6px;flex-wrap:wrap" id="clima-forecast"></div>
        </div>
    </div>
</div>

<!-- Filtros -->
<form method="GET" action="<?php echo e(route('reportes.index')); ?>" class="filter-bar">
    <i class="fa-solid fa-filter" style="color:var(--text-muted);font-size:13px"></i>
    <select name="estado" class="form-select" style="width:auto">
        <option value="">Todos los estados</option>
        <option value="pendiente" <?php echo e(request('estado')=='pendiente'?'selected':''); ?>>Pendiente</option>
        <option value="en_revision" <?php echo e(request('estado')=='en_revision'?'selected':''); ?>>En revisión</option>
        <option value="resuelto" <?php echo e(request('estado')=='resuelto'?'selected':''); ?>>Resuelto</option>
        <option value="rechazado" <?php echo e(request('estado')=='rechazado'?'selected':''); ?>>Rechazado</option>
    </select>
    <select name="prioridad" class="form-select" style="width:auto">
        <option value="">Toda prioridad</option>
        <option value="baja" <?php echo e(request('prioridad')=='baja'?'selected':''); ?>>Baja</option>
        <option value="media" <?php echo e(request('prioridad')=='media'?'selected':''); ?>>Media</option>
        <option value="alta" <?php echo e(request('prioridad')=='alta'?'selected':''); ?>>Alta</option>
        <option value="critica" <?php echo e(request('prioridad')=='critica'?'selected':''); ?>>Crítica</option>
    </select>
    <select name="categoria_id" class="form-select" style="width:auto">
        <option value="">Todas las categorías</option>
        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>" <?php echo e(request('categoria_id')==$c->id?'selected':''); ?>><?php echo e($c->nombre); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit" class="btn-primary-custom" style="padding:7px 14px"><i class="fa-solid fa-search"></i> Filtrar</button>
    <?php if(request()->hasAny(['estado','prioridad','categoria_id'])): ?>
    <a href="<?php echo e(route('reportes.index')); ?>" class="btn-outline-custom" style="padding:7px 14px">Limpiar</a>
    <?php endif; ?>
    <a href="<?php echo e(route('reportes.create')); ?>" class="btn-primary-custom ms-auto"><i class="fa-solid fa-plus"></i> Nuevo reporte</a>
</form>

<div class="card-modern">
    <div class="card-head">
        <h5><i class="fa-solid fa-file-lines me-2" style="color:var(--primary)"></i>Lista de reportes</h5>
        <span class="badge-pill badge-user"><?php echo e($reportes->count()); ?> resultado(s)</span>
    </div>
    <div style="overflow-x:auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>#</th><th>Título</th><th>Estado</th><th>Prioridad</th>
                    <th>Categoría</th><th>Fecha límite</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reportes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--text-muted);font-weight:600"><?php echo e($r->id); ?></td>
                    <td>
                        <div style="font-weight:500;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo e($r->titulo); ?></div>
                        <?php if($r->descripcion): ?><div style="font-size:12px;color:var(--text-muted)"><?php echo e(Str::limit($r->descripcion, 60)); ?></div><?php endif; ?>
                    </td>
                    <td><span class="badge-pill <?php echo e($r->getEstadoBadgeClass()); ?>"><?php echo e(ucfirst(str_replace('_',' ',$r->estado))); ?></span></td>
                    <td><span class="badge-pill <?php echo e($r->getPrioridadBadgeClass()); ?>"><?php echo e(ucfirst($r->prioridad)); ?></span></td>
                    <td>
                        <?php if($r->categoria): ?>
                        <span class="color-swatch">
                            <span class="dot" style="background:<?php echo e($r->categoria->color); ?>"></span>
                            <?php echo e($r->categoria->nombre); ?>

                        </span>
                        <?php else: ?><span style="color:var(--text-muted);font-size:12px">—</span><?php endif; ?>
                    </td>
                    <td style="font-size:13px;color:var(--text-muted)">
                        <?php echo e($r->fecha_limite ? $r->fecha_limite->format('d/m/Y') : '—'); ?>

                    </td>
                    <td>
                        <div style="display:flex;gap:6px;align-items:center">
                            <a href="<?php echo e(route('reportes.edit', $r)); ?>" class="btn-warning-sm"><i class="fa-solid fa-pen"></i></a>
                            <?php if(session('usuarioAdmin')): ?>
                            <form method="POST" action="<?php echo e(route('reportes.destroy', $r)); ?>" class="d-inline" onsubmit="return confirm('¿Eliminar este reporte?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-danger-sm"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
                        <p>No hay reportes. ¡Crea el primero!</p>
                        <a href="<?php echo e(route('reportes.create')); ?>" class="btn-primary-custom">Nuevo reporte</a>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
fetch('/api/clima')
    .then(r=>r.json())
    .then(d=>{
        document.getElementById('clima-loading').style.display='none';
        document.getElementById('clima-content').style.display='block';
        document.getElementById('clima-temp').textContent = d.actual.temperatura + '°C';
        document.getElementById('clima-cond').textContent = d.actual.condicion + ' · Humedad: ' + d.actual.humedad + '% · Viento: ' + d.actual.viento + ' km/h';
        let fc = document.getElementById('clima-forecast');
        d.pronostico.forEach(dia=>{
            let el = document.createElement('div');
            el.style.cssText='background:rgba(255,255,255,.6);border-radius:8px;padding:8px 12px;text-align:center;font-size:11px;min-width:72px';
            let fecha = new Date(dia.fecha+'T12:00:00');
            let nombre = fecha.toLocaleDateString('es-MX',{weekday:'short'});
            el.innerHTML='<div style="font-weight:600;color:#3730A3;text-transform:capitalize">'+nombre+'</div><div style="font-size:13px;font-weight:700;color:#1E1B4B">'+Math.round(dia.max)+'°</div><div style="color:#6366F1">'+Math.round(dia.min)+'°</div><div style="color:#4338CA;margin-top:2px">'+dia.condicion.split(' ')[0]+'</div>';
            fc.appendChild(el);
        });
    })
    .catch(()=>{ document.getElementById('clima-loading').textContent='API no disponible'; });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/reportes/index.blade.php ENDPATH**/ ?>