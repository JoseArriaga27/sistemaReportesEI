<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usuario;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $usuarioId = session('usuarioId');

        if (!$usuarioId) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión.');
        }

        $usuario = Usuario::find($usuarioId);

        if (!$usuario || !$usuario->es_admin) {
            return redirect()->route('usuarios.index')
                ->with('warning', 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}