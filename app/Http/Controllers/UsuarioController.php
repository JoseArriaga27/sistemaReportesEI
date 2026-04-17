<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Mail\NotificacionAdmin;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'correoElectronico' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = Usuario::where('correoElectronico', $request->correoElectronico)->first();

                
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            session()->put('usuarioId', $usuario->id);
            session()->put('usuarioNombre', $usuario->nombre);
            session()->put('usuarioApellidoPaterno', $usuario->apellidoPaterno);
            session()->put('usuarioAdmin', $usuario->es_admin);

            // Disparar evento → listener envía correo de notificación
            event(new UserLoggedIn($usuario));

            return redirect()->route('usuarios.index')
                ->with('info', '¡Bienvenido de vuelta, ' . $usuario->nombre . '!');
        }

        return back()->with('error', 'No se pudo acceder al sistema. Credenciales incorrectas.');
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:80',
            'apellidoPaterno' => 'required|max:80',
            'apellidoMaterno' => 'nullable|max:80',
            'correoElectronico' => 'required|email|max:120|unique:usuarios,correoElectronico',
            'telefono' => 'required|max:20',
            'fechaNacimiento' => 'required|date',
            'password' => 'required|min:3|max:255',
        ]);

        $datos = $request->all();
        $datos['password'] = Hash::make($datos['password']);
        $datos['es_admin'] = $request->has('es_admin');

        Usuario::create($datos);

        return redirect()->route('usuarios.index')
            ->with('mensajeExito', 'Usuario creado correctamente');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|max:80',
            'apellidoPaterno' => 'required|max:80',
            'apellidoMaterno' => 'nullable|max:80',
            'correoElectronico' => 'required|email|max:120|unique:usuarios,correoElectronico,' . $usuario->id,
            'telefono' => 'required|max:20',
            'fechaNacimiento' => 'required|date',
            'password' => 'nullable|min:3|max:255',
        ]);

        $datos = $request->all();

        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        } else {
            unset($datos['password']);
        }

        // Solo el admin puede cambiar el rol
        if (session('usuarioAdmin')) {
            $datos['es_admin'] = $request->has('es_admin') ? 1 : 0;
        } else {
            unset($datos['es_admin']);
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')
            ->with('mensajeExito', 'Usuario actualizado correctamente');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('mensajeExito', 'Usuario eliminado correctamente');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['usuarioId', 'usuarioNombre', 'usuarioAdmin']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('info', 'Sesión cerrada correctamente');
    }
    public function registro()
    {
        return view('auth.registro');
    }

    public function guardarRegistro(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:80',
            'apellidoPaterno' => 'required|max:80',
            'apellidoMaterno' => 'nullable|max:80',
            'correoElectronico' => 'required|email|max:120|unique:usuarios,correoElectronico',
            'telefono' => 'required|max:20',
            'fechaNacimiento' => 'required|date',
            'password' => 'required|confirmed|min:3|max:255',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellidoPaterno' => $request->apellidoPaterno,
            'apellidoMaterno' => $request->apellidoMaterno,
            'correoElectronico' => $request->correoElectronico,
            'telefono' => $request->telefono,
            'fechaNacimiento' => $request->fechaNacimiento,
            'password' => Hash::make($request->password),
            'es_admin' => 0,
        ]);

        return redirect()->route('login')
            ->with('mensajeExito', 'Usuario registrado correctamente. Ahora puedes iniciar sesión.');
    }

    public function enviarNotificacion(Request $request, Usuario $usuario)
    {
        $request->validate([
            'mensaje' => 'nullable|max:500',
        ]);

        Mail::to($usuario->correoElectronico)
            ->send(new NotificacionAdmin(
                $usuario->nombre . ' ' . $usuario->apellidoPaterno,
                $usuario->correoElectronico,
                $request->mensaje ?? ''
            ));

        return redirect()->route('usuarios.index')
            ->with('mensajeExito', 'Notificación enviada a ' . $usuario->nombre . ' correctamente.');
    }
}