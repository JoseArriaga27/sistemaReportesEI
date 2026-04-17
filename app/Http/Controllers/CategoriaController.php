<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount('reportes')->orderBy('nombre')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|max:500',
            'color'       => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        Categoria::create($request->only('nombre', 'descripcion', 'color'));

        return redirect()->route('categorias.index')
            ->with('mensajeExito', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre'      => 'required|max:100|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|max:500',
            'color'       => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $categoria->update($request->only('nombre', 'descripcion', 'color'));

        return redirect()->route('categorias.index')
            ->with('mensajeExito', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        // Solo admin puede eliminar (protegido también en middleware)
        if ($categoria->reportes()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('warning', 'No se puede eliminar una categoría que tiene reportes asociados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('mensajeExito', 'Categoría eliminada correctamente.');
    }
}
