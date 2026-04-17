<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CategoriaController;

// ─── Rutas públicas ────────────────────────────────────────────────────────────

Route::get('/', fn() => view('auth.login'))->name('login');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.post');
Route::get('/registro', [UsuarioController::class, 'registro'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'guardarRegistro'])->name('registro.store');

// ─── Rutas para cualquier usuario autenticado ──────────────────────────────────

Route::middleware('auth.usuario')->group(function () {

    Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

    // CRUD Usuarios (lectura para todos)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    // CRUD Reportes (todos crean/ven/editan; solo admin elimina)
    Route::get('/reportes',                    [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/create',             [ReporteController::class, 'create'])->name('reportes.create');
    Route::post('/reportes',                   [ReporteController::class, 'store'])->name('reportes.store');
    Route::get('/reportes/{reporte}/edit',     [ReporteController::class, 'edit'])->name('reportes.edit');
    Route::put('/reportes/{reporte}',          [ReporteController::class, 'update'])->name('reportes.update');

    // CRUD Categorías (todos crean/ven/editan; solo admin elimina)
    Route::get('/categorias',                      [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create',               [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias',                     [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit',     [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}',          [CategoriaController::class, 'update'])->name('categorias.update');

    // API del clima (Open-Meteo - sin API key, gratuita)
    Route::get('/api/clima', [ReporteController::class, 'clima'])->name('api.clima');
});

// ─── Rutas exclusivas para administrador ──────────────────────────────────────

Route::middleware(['auth.usuario', 'admin.usuario'])->group(function () {

    Route::get('/usuarios/create',          [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios',                [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit',  [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}',       [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}',    [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Segundo correo (equipos de 4)
    Route::post('/usuarios/{usuario}/notificar', [UsuarioController::class, 'enviarNotificacion'])->name('usuarios.notificar');

    // Solo admin puede eliminar reportes y categorías
    Route::delete('/reportes/{reporte}',       [ReporteController::class, 'destroy'])->name('reportes.destroy');
    Route::delete('/categorias/{categoria}',   [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});
