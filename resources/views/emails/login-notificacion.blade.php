<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Inicio de sesión detectado</title>
<style>
  body{margin:0;padding:0;background:#F9FAFB;font-family:'Segoe UI',Arial,sans-serif}
  .wrap{max-width:560px;margin:40px auto;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E5E7EB}
  .header{background:linear-gradient(135deg,#4F46E5,#7C3AED);padding:36px 40px;text-align:center}
  .header .icon{width:60px;height:60px;background:rgba(255,255,255,.15);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:14px}
  .header h1{color:#fff;font-size:22px;margin:0;font-weight:700}
  .header p{color:rgba(255,255,255,.75);font-size:14px;margin:6px 0 0}
  .body{padding:36px 40px}
  .greeting{font-size:16px;font-weight:600;color:#111827;margin:0 0 8px}
  .message{font-size:14px;color:#6B7280;line-height:1.6;margin:0 0 24px}
  .info-box{background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;padding:18px 20px;margin-bottom:24px}
  .info-row{display:flex;align-items:center;gap:10px;padding:6px 0;font-size:13.5px}
  .info-row .label{color:#6B7280;width:120px;flex-shrink:0}
  .info-row .value{color:#111827;font-weight:500}
  .btn-block{text-align:center;margin:28px 0 8px}
  .btn{display:inline-block;background:#4F46E5;color:#fff!important;text-decoration:none;padding:13px 32px;border-radius:10px;font-size:14px;font-weight:600}
  .warning{background:#FEF3C7;border:1px solid #FCD34D;border-radius:8px;padding:12px 16px;font-size:13px;color:#92400E;margin-top:20px}
  .footer{background:#F9FAFB;border-top:1px solid #E5E7EB;padding:20px 40px;text-align:center;font-size:12px;color:#9CA3AF}
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div class="icon">🔐</div>
    <h1>Inicio de sesión detectado</h1>
    <p>Sistema de Reportes</p>
  </div>
  <div class="body">
    <p class="greeting">Hola, {{ $nombreUsuario }}</p>
    <p class="message">Se ha registrado un nuevo inicio de sesión en tu cuenta del Sistema de Reportes. Si fuiste tú, no necesitas hacer nada.</p>

    <div class="info-box">
      <div class="info-row">
        <span class="label">👤 Usuario</span>
        <span class="value">{{ $nombreUsuario }}</span>
      </div>
      <div class="info-row">
        <span class="label">📧 Correo</span>
        <span class="value">{{ $correoUsuario }}</span>
      </div>
      <div class="info-row">
        <span class="label">📅 Fecha y hora</span>
        <span class="value">{{ $fechaHora }}</span>
      </div>
    </div>

    <div class="btn-block">
      <a href="{{ $urlSistema }}" class="btn">Ir al sistema →</a>
    </div>

    <div class="warning">
      ⚠️ Si <strong>no fuiste tú</strong> quien inició sesión, cambia tu contraseña de inmediato y contacta al administrador.
    </div>
  </div>
  <div class="footer">
    © {{ date('Y') }} Sistema de Reportes · Este es un correo automático, no responder.
  </div>
</div>
</body>
</html>
