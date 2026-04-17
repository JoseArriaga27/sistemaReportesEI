<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('page-title', 'Sistema de Reportes'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--sidebar-w:240px;--topbar-h:60px;--primary:#4F46E5;--primary-dark:#3730A3;--primary-light:#EEF2FF;--success:#10B981;--warning:#F59E0B;--danger:#EF4444;--info:#3B82F6;--text-main:#111827;--text-muted:#6B7280;--border:#E5E7EB;--bg-page:#F9FAFB;--bg-card:#FFFFFF;--sidebar-bg:#1E1B4B;--sidebar-text:rgba(255,255,255,0.7);--sidebar-active:#FFFFFF;--sidebar-hover:rgba(255,255,255,0.08)}
        *{box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:var(--bg-page);color:var(--text-main);margin:0}
        .sidebar{position:fixed;top:0;left:0;width:var(--sidebar-w);height:100vh;background:var(--sidebar-bg);display:flex;flex-direction:column;z-index:100;overflow-y:auto}
        .sidebar-brand{padding:20px 20px 16px;border-bottom:1px solid rgba(255,255,255,.08)}
        .brand-icon{width:36px;height:36px;border-radius:10px;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;margin-bottom:8px}
        .brand-name{font-size:14px;font-weight:700;color:#fff}
        .brand-sub{font-size:11px;color:var(--sidebar-text)}
        .sidebar-section{padding:16px 12px 4px;font-size:10px;font-weight:600;letter-spacing:.08em;color:rgba(255,255,255,.35);text-transform:uppercase}
        .sidebar-link{display:flex;align-items:center;gap:10px;padding:9px 16px;margin:2px 8px;border-radius:8px;color:var(--sidebar-text);text-decoration:none;font-size:13.5px;font-weight:500;transition:all .15s}
        .sidebar-link:hover{background:var(--sidebar-hover);color:#fff}
        .sidebar-link.active{background:rgba(79,70,229,.35);color:var(--sidebar-active)}
        .sidebar-link .icon{width:18px;text-align:center;font-size:14px}
        .sidebar-user{margin-top:auto;padding:14px 16px;border-top:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px}
        .sidebar-user .avatar{width:32px;height:32px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0}
        .sidebar-user .user-name{font-size:13px;font-weight:600;color:#fff}
        .sidebar-user .user-role{font-size:11px;color:var(--sidebar-text)}
        .main-wrap{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
        .topbar{height:var(--topbar-h);background:var(--bg-card);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 28px;position:sticky;top:0;z-index:50;gap:12px}
        .topbar .page-title{font-size:16px;font-weight:600;flex:1}
        .logout-btn{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;border:1px solid var(--border);background:transparent;color:var(--text-muted);font-size:13px;font-weight:500;cursor:pointer;text-decoration:none;transition:all .15s}
        .logout-btn:hover{background:#FEF2F2;border-color:#FCA5A5;color:var(--danger)}
        .content-area{padding:28px;flex:1}
        .card-modern{background:var(--bg-card);border:1px solid var(--border);border-radius:12px;overflow:hidden}
        .card-modern .card-head{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
        .card-modern .card-head h5{font-size:14px;font-weight:600;margin:0}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:12px;padding:20px;display:flex;align-items:flex-start;gap:14px}
        .stat-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
        .stat-val{font-size:26px;font-weight:700;line-height:1}
        .stat-lbl{font-size:12px;color:var(--text-muted);margin-top:4px}
        .btn-primary-custom{background:var(--primary);color:#fff;border:none;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;text-decoration:none;cursor:pointer;transition:background .15s}
        .btn-primary-custom:hover{background:var(--primary-dark);color:#fff}
        .btn-outline-custom{background:transparent;border:1px solid var(--border);color:var(--text-muted);padding:7px 14px;border-radius:8px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;text-decoration:none;cursor:pointer;transition:all .15s}
        .btn-outline-custom:hover{border-color:#9CA3AF;color:var(--text-main)}
        .btn-danger-sm{background:#FEF2F2;border:1px solid #FCA5A5;color:var(--danger);padding:5px 10px;border-radius:6px;font-size:12px;display:inline-flex;align-items:center;gap:4px;cursor:pointer;transition:all .15s;text-decoration:none}
        .btn-danger-sm:hover{background:var(--danger);color:#fff}
        .btn-warning-sm{background:#FFFBEB;border:1px solid #FCD34D;color:#92400E;padding:5px 10px;border-radius:6px;font-size:12px;display:inline-flex;align-items:center;gap:4px;cursor:pointer;transition:all .15s;text-decoration:none}
        .btn-warning-sm:hover{background:var(--warning);color:#fff}
        .btn-info-sm{background:#EFF6FF;border:1px solid #BFDBFE;color:#1E40AF;padding:5px 10px;border-radius:6px;font-size:12px;display:inline-flex;align-items:center;gap:4px;cursor:pointer;transition:all .15s;text-decoration:none}
        .btn-info-sm:hover{background:var(--info);color:#fff}
        .form-card{background:var(--bg-card);border:1px solid var(--border);border-radius:12px;overflow:hidden;max-width:760px;margin:0 auto}
        .form-card .form-head{padding:18px 24px;border-bottom:1px solid var(--border)}
        .form-card .form-head h4{font-size:16px;font-weight:600;margin:0}
        .form-card .form-head p{font-size:12px;color:var(--text-muted);margin:4px 0 0}
        .form-card .form-body{padding:24px}
        .form-label-custom{font-size:13px;font-weight:500;color:var(--text-main);margin-bottom:6px;display:block}
        .form-control,.form-select{border:1px solid var(--border)!important;border-radius:8px!important;padding:9px 12px!important;font-size:13.5px!important;color:var(--text-main)!important;background:#fff!important;transition:border-color .15s,box-shadow .15s}
        .form-control:focus,.form-select:focus{border-color:var(--primary)!important;box-shadow:0 0 0 3px rgba(79,70,229,.1)!important;outline:none!important}
        .form-control.is-invalid{border-color:var(--danger)!important}
        .invalid-feedback{font-size:12px;color:var(--danger);margin-top:4px}
        .table-custom{width:100%;font-size:13.5px}
        .table-custom thead th{padding:11px 14px;background:var(--bg-page);font-size:11px;font-weight:600;letter-spacing:.04em;color:var(--text-muted);text-transform:uppercase;border-bottom:1px solid var(--border);white-space:nowrap}
        .table-custom tbody td{padding:13px 14px;border-bottom:1px solid var(--border);vertical-align:middle}
        .table-custom tbody tr:last-child td{border-bottom:none}
        .table-custom tbody tr:hover td{background:var(--bg-page)}
        .badge-estado-pendiente{background:#FEF3C7;color:#92400E}
        .badge-estado-revision{background:#DBEAFE;color:#1E40AF}
        .badge-estado-resuelto{background:#D1FAE5;color:#065F46}
        .badge-estado-rechazado{background:#FEE2E2;color:#991B1B}
        .badge-prio-baja{background:#F3F4F6;color:#374151}
        .badge-prio-media{background:#FEF3C7;color:#92400E}
        .badge-prio-alta{background:#FED7AA;color:#9A3412}
        .badge-prio-critica{background:#FEE2E2;color:#991B1B}
        .badge-pill{display:inline-block;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:600}
        .badge-admin{background:var(--primary-light);color:var(--primary-dark)}
        .badge-user{background:#F3F4F6;color:#374151}
        .alert-modern{padding:12px 16px;border-radius:10px;display:flex;align-items:flex-start;gap:10px;margin-bottom:16px;font-size:13.5px}
        .alert-modern.success{background:#D1FAE5;border:1px solid #6EE7B7;color:#065F46}
        .alert-modern.error{background:#FEE2E2;border:1px solid #FCA5A5;color:#991B1B}
        .alert-modern.warning{background:#FEF3C7;border:1px solid #FCD34D;color:#92400E}
        .alert-modern.info{background:#DBEAFE;border:1px solid #93C5FD;color:#1E40AF}
        .alert-modern .a-icon{font-size:15px;margin-top:1px}
        .alert-modern .a-close{margin-left:auto;background:none;border:none;cursor:pointer;color:inherit;opacity:.6;font-size:16px;padding:0}
        .alert-modern .a-close:hover{opacity:1}
        .auth-wrap{min-height:100vh;background:var(--bg-page);display:flex;align-items:center;justify-content:center;padding:24px}
        .auth-card{width:100%;max-width:420px;background:var(--bg-card);border:1px solid var(--border);border-radius:16px;overflow:hidden}
        .auth-card .auth-head{padding:32px 32px 24px;border-bottom:1px solid var(--border);text-align:center}
        .auth-card .auth-logo{width:52px;height:52px;border-radius:14px;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;margin:0 auto 14px}
        .auth-card .auth-head h3{font-size:20px;font-weight:700;margin:0}
        .auth-card .auth-head p{font-size:13px;color:var(--text-muted);margin:6px 0 0}
        .auth-card .auth-body{padding:28px 32px 32px}
        .page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;gap:16px;flex-wrap:wrap}
        .page-header h2{font-size:20px;font-weight:700;margin:0}
        .page-header p{font-size:13px;color:var(--text-muted);margin:4px 0 0}
        .color-swatch{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:500}
        .color-swatch .dot{width:12px;height:12px;border-radius:50%;border:1px solid rgba(0,0,0,.1)}
        .empty-state{text-align:center;padding:56px 20px;color:var(--text-muted)}
        .empty-state .empty-icon{font-size:36px;margin-bottom:12px;opacity:.4}
        .empty-state p{font-size:14px;margin:0 0 16px}
        .filter-bar{background:var(--bg-card);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;flex-wrap:wrap}
        .filter-bar select,.filter-bar input{border:1px solid var(--border);border-radius:7px;padding:7px 10px;font-size:13px;color:var(--text-main);background:#fff}
    </style>
</head>
<body>

<?php if(request()->routeIs('login') || request()->routeIs('registro')): ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php else: ?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-chart-bar"></i></div>
        <div class="brand-name">Sistema de Reportes</div>
        <div class="brand-sub">Panel de control</div>
    </div>
    <div class="sidebar-section">Principal</div>
    <a href="<?php echo e(route('reportes.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('reportes.*') ? 'active' : ''); ?>">
        <span class="icon"><i class="fa-solid fa-file-lines"></i></span> Reportes
    </a>
    <a href="<?php echo e(route('categorias.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('categorias.*') ? 'active' : ''); ?>">
        <span class="icon"><i class="fa-solid fa-tag"></i></span> Categorías
    </a>
    <?php if(session('usuarioAdmin')): ?>
    <div class="sidebar-section">Administración</div>
    <a href="<?php echo e(route('usuarios.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('usuarios.*') ? 'active' : ''); ?>">
        <span class="icon"><i class="fa-solid fa-users"></i></span> Usuarios
    </a>
    <?php endif; ?>
    <div class="sidebar-user">
        <div class="avatar"><?php echo e(strtoupper(substr(session('usuarioNombre','U'),0,1))); ?><?php echo e(strtoupper(substr(session('usuarioApellidoPaterno',''),0,1))); ?></div>
        <div>
            <div class="user-name"><?php echo e(session('usuarioNombre')); ?> <?php echo e(session('usuarioApellidoPaterno')); ?></div>
            <div class="user-role"><?php echo e(session('usuarioAdmin') ? 'Administrador' : 'Usuario'); ?></div>
        </div>
    </div>
</aside>
<div class="main-wrap">
    <header class="topbar">
        <span class="page-title"><?php echo $__env->yieldContent('page-title','Dashboard'); ?></span>
        <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</button>
        </form>
    </header>
    <main class="content-area">
        <?php echo $__env->make('partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.alert-modern .a-close').forEach(b=>b.addEventListener('click',function(){let a=this.closest('.alert-modern');a.style.transition='opacity .3s';a.style.opacity='0';setTimeout(()=>a.remove(),300)}));
setTimeout(()=>{document.querySelectorAll('.alert-modern').forEach(a=>{a.style.transition='opacity .5s';a.style.opacity='0';setTimeout(()=>a.remove(),500)})},4000);
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/josearriaga/Laravel/sistemaReportes/resources/views/layouts/app.blade.php ENDPATH**/ ?>