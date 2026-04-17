<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Reporte;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Usuarios ────────────────────────────────────────────────────────
        $admin = Usuario::create([
            'nombre'             => 'Admin',
            'apellidoPaterno'    => 'Sistema',
            'apellidoMaterno'    => 'Principal',
            'correoElectronico'  => 'admin@sistema.com',
            'telefono'           => '7771234567',
            'fechaNacimiento'    => '1990-01-15',
            'password'           => Hash::make('admin123'),
            'es_admin'           => true,
        ]);

        $user = Usuario::create([
            'nombre'             => 'Juan',
            'apellidoPaterno'    => 'García',
            'apellidoMaterno'    => 'López',
            'correoElectronico'  => 'juan@sistema.com',
            'telefono'           => '7779876543',
            'fechaNacimiento'    => '1995-06-20',
            'password'           => Hash::make('user123'),
            'es_admin'           => false,
        ]);

        // ─── Categorías ───────────────────────────────────────────────────────
        $cats = [
            ['nombre' => 'Infraestructura', 'descripcion' => 'Problemas de servidores, redes y hardware', 'color' => '#EF4444'],
            ['nombre' => 'Software',        'descripcion' => 'Bugs y errores en aplicaciones',            'color' => '#3B82F6'],
            ['nombre' => 'Seguridad',       'descripcion' => 'Incidentes de seguridad y accesos',         'color' => '#F59E0B'],
            ['nombre' => 'Usuarios',        'descripcion' => 'Solicitudes y problemas de usuarios',       'color' => '#10B981'],
            ['nombre' => 'General',         'descripcion' => 'Reportes varios sin categoría específica',  'color' => '#6B7280'],
        ];

        foreach ($cats as $cat) {
            Categoria::create($cat);
        }

        // ─── Reportes de ejemplo ─────────────────────────────────────────────
        $reportesData = [
            ['titulo' => 'Servidor caído en producción',       'estado' => 'pendiente',   'prioridad' => 'critica', 'categoria_id' => 1],
            ['titulo' => 'Error 500 al guardar formulario',    'estado' => 'en_revision', 'prioridad' => 'alta',    'categoria_id' => 2],
            ['titulo' => 'Acceso no autorizado detectado',     'estado' => 'pendiente',   'prioridad' => 'critica', 'categoria_id' => 3],
            ['titulo' => 'Usuario no puede iniciar sesión',    'estado' => 'resuelto',    'prioridad' => 'media',   'categoria_id' => 4],
            ['titulo' => 'Actualización de contraseñas',       'estado' => 'resuelto',    'prioridad' => 'baja',    'categoria_id' => 5],
            ['titulo' => 'Rendimiento lento en módulo reportes','estado' => 'en_revision','prioridad' => 'alta',    'categoria_id' => 2],
        ];

        foreach ($reportesData as $i => $data) {
            Reporte::create(array_merge($data, [
                'descripcion' => 'Descripción de ejemplo para el reporte de demostración #' . ($i + 1),
                'usuario_id'  => ($i % 2 === 0) ? $admin->id : $user->id,
                'fecha_limite'=> now()->addDays(rand(3, 30))->format('Y-m-d'),
            ]));
        }
    }
}
