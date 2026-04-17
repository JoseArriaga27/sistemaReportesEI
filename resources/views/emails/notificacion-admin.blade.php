<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Notificación del sistema</title>
<style>
  body{margin:0;padding:0;background:#F9FAFB;font-family:'Segoe UI',Arial,sans-serif}
  .wrap{max-width:560px;margin:40px auto;background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E5E7EB}
  .header{background:linear-gradient(135deg,#0EA5E9,#4F46E5);padding:36px 40px;text-align:center}
  .header .icon{width:60px;height:60px;background:rgba(255,255,255,.15);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:14px}
  .header h1{color:#fff;font-size:22px;margin:0;font-weight:700}
  .header p{color:rgba(255,255,255,.75);font-size:14px;margin:6px 0 0}
  .body{padding:36px 40px}
  .greeting{font-size:16px;font-weight:600;color:#111827;margin:0 0 8px}
  .message-box{background:#EEF2FF;border:1px solid #C7D2FE;border-radius:10px;padding:18px 20px;margin:16px 0 24px;font-size:14px;color:#3730A3;line-height:1.7}
  .btn-block{text-align:center;margin:28px 0 8px}
  .btn{display:inline-block;background:#4F46E5;color:#fff!important;text-decoration:none;padding:13px 32px;border-radius:10px;font-size:14px;font-weight:600}
  .footer{background:#F9FAFB;border-top:1px solid #E5E7EB;padding:20px 40px;text-align:center;font-size:12px;color:#9CA3AF}
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div class="icon">📢</div>
    <h1>Notificación del sistema</h1>
    <p>Sistema de Reportes</p>
  </div>
  <div class="body">
    <p class="greeting">Hola, {{ $nombreUsuario }}</p>
    <p style="font-size:14px;color:#6B7280;margin:0 0 4px">Tienes un mensaje del administrador del sistema:</p>
    <div class="message-box">{{ $mensaje }}</div>
    <div class="btn-block">
      <a href="{{ $urlSistema }}" class="btn">Ver el sistema →</a>
    </div>
  </div>
  <div class="footer">
    © {{ date('Y') }} Sistema de Reportes · Enviado a: {{ $correoUsuario }}
  </div>
</div>
</body>
</html>
