# Sistema de Reportes — Laravel

Sistema de gestión de reportes con autenticación, roles, correos y API del clima.

## Credenciales de prueba (seeder)
| Rol           | Correo               | Contraseña |
|---------------|----------------------|------------|
| Administrador | admin@sistema.com    | admin123   |
| Usuario       | juan@sistema.com     | user123    |

## Instalación rápida

```bash
# 1. Instalar dependencias
composer install

# 2. Copiar y configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Crear base de datos (MariaDB/MySQL)
# Crea la DB: CREATE DATABASE sistemareportes;

# 4. Ejecutar migraciones + seeder
php artisan migrate:fresh --seed

# 5. Configurar correo en .env (ver instrucciones abajo)

# 6. Iniciar servidor
php artisan serve
```

## Configuración de correo Gmail

1. Activa la **verificación en 2 pasos** en tu cuenta Google
2. Ve a: https://myaccount.google.com/apppasswords
3. Crea una contraseña de app → selecciona "Correo" y "Otro"
4. Copia los 16 dígitos y edita `.env`:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=ssl
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=tucorreo@gmail.com
MAIL_PASSWORD=xxxx_xxxx_xxxx_xxxx
MAIL_FROM_ADDRESS="tucorreo@gmail.com"
MAIL_FROM_NAME="Sistema de Reportes"
```

## Estructura del proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── UsuarioController.php   # CRUD usuarios + login + correos
│   │   ├── ReporteController.php   # CRUD reportes + API clima
│   │   └── CategoriaController.php # CRUD categorías
│   └── Middleware/
│       ├── VerificarSesionUsuario.php  # auth.usuario
│       └── AdminMiddleware.php          # admin.usuario
├── Events/
│   └── UserLoggedIn.php
├── Listeners/
│   └── SendLoginNotification.php
├── Mail/
│   ├── LoginNotificacion.php       # Correo al iniciar sesión
│   └── NotificacionAdmin.php       # Segundo correo (admin → usuario)
└── Models/
    ├── Usuario.php
    ├── Reporte.php
    └── Categoria.php
```

## API del clima

Endpoint: `GET /api/clima?lat=18.9242&lon=-99.2216`

Usa la API pública **Open-Meteo** (sin API key, 100% gratuita).
Se muestra en el dashboard de reportes con pronóstico de 5 días.

## Repositorio
https://github.com/TU_USUARIO/sistemaReportes
