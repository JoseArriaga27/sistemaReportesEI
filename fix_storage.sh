#!/bin/bash
# Ejecuta esto si ves el error "Please provide a valid cache path"
# Desde la raíz del proyecto: bash fix_storage.sh

echo "Creando directorios de storage necesarios..."
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/testing
mkdir -p storage/logs
mkdir -p storage/app/public
mkdir -p bootstrap/cache

echo "Ajustando permisos..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "Limpiando caché de Laravel..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear  2>/dev/null || true
php artisan view:clear   2>/dev/null || true

echo "¡Listo! Ahora ejecuta: php artisan serve"
