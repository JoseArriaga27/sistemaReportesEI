<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarSesionUsuario
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuarioId')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder al sistema.');
        }

        return $next($request);
    }
}